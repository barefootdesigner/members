# Members Club

Laravel + Filament application for managing a members club website.

## Features

- Public-facing website with girls profiles, news articles, and contact form
- Admin panel powered by Filament for content management
- Image galleries with carousel functionality
- Responsive design with Tailwind CSS
- Alpine.js for interactive components

## Tech Stack

- Laravel 12
- Filament 3.2 (Admin Panel)
- Tailwind CSS 4
- Alpine.js
- Splide.js (Carousels)
- Vite (Asset Bundling)

## Local Development

### Requirements

- PHP 8.4+
- Composer
- Node.js & NPM
- SQLite (for local development)

### Setup

```bash
# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Build assets and start server
npm run build
php artisan serve
```

Visit http://localhost:8000

### Admin Panel

Access at `/admin` - create a user first:

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password')
]);
```

## Production Deployment (Cloudways)

### Live Site

https://phpstack-1492311-6115276.cloudwaysapps.com

### GitHub Repository

https://github.com/barefootdesigner/members

### Deployment Steps

1. **Build assets locally:**
   ```bash
   npm run build
   git add .
   git commit -m "Build assets"
   git push
   ```

2. **In Cloudways Dashboard:**
   - Create PHP 8.4 application
   - Deploy from GitHub (`barefootdesigner/members`, `main` branch)
   - Set Webroot to: `public_html/public`
   - Get database credentials from Access Details

3. **SSH into server:**
   ```bash
   cd applications/[app-name]/public_html

   # Install dependencies
   composer install --no-dev --optimize-autoloader

   # Configure environment
   cp .env.example .env
   nano .env  # Update with production settings

   # Generate key
   php artisan key:generate

   # Create storage link
   php artisan storage:link

   # Run migrations
   php artisan migrate --force

   # Cache for production
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

4. **Production .env settings:**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-domain.com

   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_DATABASE=[from Cloudways]
   DB_USERNAME=[from Cloudways]
   DB_PASSWORD=[from Cloudways]
   ```

### TODO: Database Import

**Note:** The production database currently only has the schema (empty tables).

You will need to import the existing data from the local SQLite database or WordPress XML export.

Options:
1. Export local SQLite data and convert to MySQL format
2. Import from WordPress XML using the custom import command
3. Manually recreate content via Filament admin panel

## Project Structure

```
app/
├── Filament/Resources/     # Admin panel resources
│   ├── GirlResource.php
│   ├── NewsResource.php
│   └── SiteSettingResource.php
├── Http/Controllers/       # Public-facing controllers
│   ├── HomeController.php
│   ├── GirlController.php
│   ├── NewsController.php
│   └── ContactController.php
└── Models/                 # Database models

resources/views/            # Blade templates
├── layouts/app.blade.php
├── home.blade.php
├── girls/
├── news/
└── contact.blade.php

database/migrations/        # Database schema
```

## License

Proprietary - All rights reserved
