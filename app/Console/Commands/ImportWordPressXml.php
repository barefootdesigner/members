<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\Girl;
use Illuminate\Support\Str;

class ImportWordPressXml extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:wordpress {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Girls and Images from WordPress XML export';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File not found: $filePath");
            return;
        }

        $xmlString = file_get_contents($filePath);
        // Remove namespaces for easier parsing or just handle them.
        // Simple regex replace to remove namespaces from tags for easier SimpleXML usage
        $xmlString = str_replace('wp:', 'wp_', $xmlString);
        $xmlString = str_replace('content:encoded', 'content_encoded', $xmlString);

        $xml = simplexml_load_string($xmlString);

        if ($xml === false) {
            $this->error("Failed to parse XML");
            return;
        }

        $this->info("Scanning for attachments...");

        // Map Attachment ID -> URL
        $attachments = [];
        foreach ($xml->channel->item as $item) {
            $postType = (string) $item->wp_post_type;
            if ($postType === 'attachment') {
                $id = (string) $item->wp_post_id;
                $url = (string) $item->wp_attachment_url;
                $attachments[$id] = $url;
            }
        }

        $this->info("Found " . count($attachments) . " attachments.");

        $this->info("Importing Girls...");

        foreach ($xml->channel->item as $item) {
            $postType = (string) $item->wp_post_type;

            // Check if it's a "Girl" post. Based on categories.
            $categories = [];
            foreach ($item->category as $cat) {
                $categories[] = (string) $cat;
            }

            if ($postType === 'post' && in_array('Girls', $categories)) {
                $this->importGirl($item, $categories, $attachments);
            }
        }

        $this->info("Import Complete!");
    }

    protected function importGirl($item, $categories, $attachments)
    {
        $title = (string) $item->title;
        $link = (string) $item->link;
        $this->info("Processing: $title");

        // Availability Mapping
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $availability = [];
        foreach ($categories as $cat) {
            if (in_array($cat, $days)) {
                $availability[] = $cat;
            }
        }

        // Meta Data (Images, Stats, Specialities)
        $intro = (string) $item->content_encoded;
        $statsRaw = '';
        $specialitiesRaw = '';

        foreach ($item->wp_postmeta as $meta) {
            $key = (string) $meta->wp_meta_key;
            $value = (string) $meta->wp_meta_value;

            if ($key === 'stats') {
                $statsRaw = $value;
            }

            if ($key === 'specialities') {
                $specialitiesRaw = $value;
            }
        }

        // Parse Stats
        $stats = $this->parseStats($statsRaw);

        // Parse Specialities (Services)
        $services = array_filter(array_map('trim', explode(',', $specialitiesRaw)));

        // SCRAPING IMAGES FROM LIVE SITE
        // XML is missing attachment posts, so we scrape the HTML of the live page.
        $this->comment("Scraping images from: $link");
        $images = $this->scrapeImagesFromUrl($link);

        // Filter images (exclude logos, icons, etc)
        $validImages = collect($images)->filter(function ($url) {
            return str_contains($url, '/wp-content/uploads/')
                && !str_contains($url, 'logo')
                && !str_contains($url, 'icon')
                && !str_contains($url, 'single.jpg');
        })->unique()->values();

        $this->info("Found " . $validImages->count() . " potential images.");

        // Download Images
        $galleryPaths = [];
        $featuredImagePath = null;

        foreach ($validImages as $index => $url) {
            // First image is featured
            $folder = $index === 0 ? 'girls' : 'girls/gallery';
            $path = $this->downloadImage($url, $folder);

            if ($path) {
                if ($index === 0) {
                    $featuredImagePath = $path;
                } else {
                    $galleryPaths[] = $path;
                }
            }
        }

        // Create or Update
        Girl::updateOrCreate(
            ['slug' => Str::slug($title)],
            [
                'name' => $title,
                'intro' => $intro,
                'is_active' => true,
                'availability' => $availability,
                'featured_image' => $featuredImagePath,
                'gallery_images' => $galleryPaths,
                'age' => $stats['Age'] ?? null,
                'height' => $stats['Height'] ?? null,
                'dress_size' => $stats['Dress Size'] ?? null,
                'bust_size' => $stats['Bust Size'] ?? null,
                'eyes' => $stats['Eyes'] ?? null,
                'hair' => $stats['Hair'] ?? null,
                'nationality' => $stats['Nationality'] ?? null,
                'services' => $services,
            ]
        );
    }

    protected function parseStats($html)
    {
        $data = [];
        if (empty($html))
            return $data;

        // Extract <li> labels and values
        // HTML looks like: <li>Age <strong>30s</strong></li>
        preg_match_all('/<li>([^<]+)(?:<[^>]+>)*\s*<strong>([^<]+)<\/strong><\/li>/i', $html, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $label = trim($match[1]);
            $value = trim($match[2]);
            $data[$label] = $value;
        }

        // Fallback for messy HTML (Carly has multiple strong tags)
        if (empty($data)) {
            $stripped = strip_tags($html, '<li>');
            preg_match_all('/<li>([^:]+)\s+(.+)<\/li>/i', $stripped, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $label = trim($match[1]);
                $value = trim($match[2]);
                $data[$label] = $value;
            }
        }

        return $data;
    }

    protected function scrapeImagesFromUrl($url)
    {
        try {
            $response = Http::get($url);
            if (!$response->successful())
                return [];

            $html = $response->body();

            // Regex to find all jpg/png in wp-content/uploads
            // Matches both standard href/src and CSS url()
            preg_match_all('/https:\/\/brooklynsbabes\.com\/wp-content\/uploads\/[^"\')\s>]*\.(?:jpg|jpeg|png)/i', $html, $matches);

            return $matches[0] ?? [];

        } catch (\Exception $e) {
            $this->error("Failed to scrape $url: " . $e->getMessage());
            return [];
        }
    }

    protected function downloadImage($url, $folder)
    {
        try {
            if (empty($url))
                return null;

            $this->comment("Downloading: $url");

            $contents = file_get_contents($url);
            if (!$contents)
                return null;

            $name = basename($url);
            // clean name
            $name = preg_replace('/[^\w\-\.]/', '', $name);
            $path = $folder . '/' . $name;

            Storage::disk('public')->put($path, $contents);

            return $path;

        } catch (\Exception $e) {
            $this->error("Failed to download $url: " . $e->getMessage());
            return null;
        }
    }
}
