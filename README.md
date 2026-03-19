# Quadque Dashboard

The admin management dashboard for **Quadque Technologies**. Built with Laravel 8 and Vue 3, this application provides a comprehensive back-office interface for managing platform operations, content, users, and business workflows through an intuitive dashboard experience.

Part of the **Quadque digital platform ecosystem**.

---

## Features

- Comprehensive admin dashboard with real-time data views
- Vue 3 single-page application frontend with Vuex state management
- Rich text content editing with Vue Quill editor
- Multi-select form inputs with Vueform Multiselect
- Tailwind CSS and Bootstrap hybrid styling approach
- User-friendly alerts and notifications via SweetAlert2
- Laravel Sanctum API authentication for secure admin access
- Image processing with Intervention Image
- Laravel Breeze lightweight authentication scaffolding
- Database migrations and seeders for structured data management
- Laravel Mix build pipeline with SASS preprocessing

## Tech Stack

| Layer        | Technology                                          |
|--------------|------------------------------------------------------|
| Backend      | PHP 7.3+/8.0, Laravel 8                             |
| Frontend     | Vue 3, Vuex 4, Alpine.js                             |
| Auth         | Laravel Sanctum, Laravel Breeze                      |
| Styling      | Tailwind CSS 2, Bootstrap 5                          |
| Rich Text    | Vue Quill                                            |
| Forms        | Vueform Multiselect                                  |
| Alerts       | SweetAlert2                                          |
| Images       | Intervention Image                                   |
| Build        | Laravel Mix 6, Webpack, SASS                         |
| Testing      | PHPUnit 9, Mockery, Faker                            |

## Getting Started

### Prerequisites

- PHP >= 7.3
- Composer
- Node.js >= 14
- MySQL

### Installation

```bash
git clone https://github.com/mhmalvi/quadque-dashboard.git
cd quadque-dashboard
composer install
npm install
```

### Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials and application settings.

### Database Setup

```bash
php artisan migrate
php artisan db:seed
```

### Development

```bash
php artisan serve
npm run dev
```

### Production Build

```bash
npm run production
```

## Project Structure

```
quadque-dashboard/
├── app/                 # Application logic (Models, Controllers, Middleware)
├── bootstrap/           # Framework bootstrap
├── config/              # Configuration files
├── database/
│   ├── factories/       # Model factories
│   ├── migrations/      # Database migrations
│   └── seeders/         # Database seeders
├── public/              # Compiled assets and entry point
├── resources/
│   ├── js/              # Vue 3 components and stores
│   ├── views/           # Blade templates
│   ├── css/             # Tailwind and custom styles
│   └── lang/            # Localization files
├── routes/
│   ├── api.php          # API routes
│   └── web.php          # Web routes
├── storage/             # Logs, cache, and uploads
├── tailwind.config.js   # Tailwind CSS configuration
├── tests/               # Test suites
└── webpack.mix.js       # Laravel Mix configuration
```

## License

Proprietary — Quadque Technologies. All rights reserved.
