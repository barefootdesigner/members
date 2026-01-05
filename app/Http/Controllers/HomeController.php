<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $overview = \App\Models\SiteSetting::where('key', 'overview')->value('value');
        $news = \App\Models\News::where('is_active', true)->latest()->first();

        $today = date('l');
        $todaysGirls = \App\Models\Girl::where('is_active', true)
            ->get()
            ->filter(fn($girl) => in_array($today, $girl->availability ?? []))
            ->take(20);

        // Featured girls
        $featuredGirls = \App\Models\Girl::where('is_active', true)
            ->where('is_featured', true)
            ->limit(20)
            ->get();

        // If no featured girls, show random girls
        if ($featuredGirls->isEmpty()) {
            $featuredGirls = \App\Models\Girl::where('is_active', true)
                ->inRandomOrder()
                ->limit(20)
                ->get();
        }

        // All active girls
        $allGirls = \App\Models\Girl::where('is_active', true)
            ->inRandomOrder()
            ->limit(20)
            ->get();

        return view('home', compact('overview', 'news', 'todaysGirls', 'featuredGirls', 'allGirls'));
    }
}
