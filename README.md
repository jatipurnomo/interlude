# Interlude

**Interlude** is a literary and book publishing platform built with modern web technologies. It serves as a comprehensive book catalog, digital reading experience, and content management system with an admin dashboard.

![Laravel](https://img.shields.io/badge/Laravel-13-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=flat-square&logo=tailwindcss)
![Vite](https://img.shields.io/badge/Vite-8.0-646CFF?style=flat-square&logo=vite)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql)
![Redis](https://img.shields.io/badge/Redis-7.0-DC382D?style=flat-square&logo=redis)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+F7DF1E?style=flat-square&logo=javascript)

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Architecture](#architecture)
- [Installation](#installation)
- [Project Structure](#project-structure)
- [Routes](#routes)
- [Admin Panel](#admin-panel)
- [Configuration](#configuration)
- [Deployment](#deployment)
- [License](#license)

## Features

### User-Facing
- **Book Catalog** — Browse and search through a curated collection of books
- **Book Details & Purchase** — View detailed book information and purchase flow
- **Wishlist** — Add books to a personal wishlist
- **Blog** — Read articles and literary content
- **Gallery** — Interactive gallery with YouTube video integration
- **Search** — Full-text search across books and content
- **Authentication** — User login and registration system
- **Profile Management** — Edit and update user profiles

### Admin Dashboard
- **Book Management** — Full CRUD for books (create, read, update, delete)
- **Category Management** — Manage book categories and metadata
- **Dashboard Statistics** — Overview of platform metrics and analytics
- **Search Feature** — Advanced search and filtering

## Technologies Used

### Backend
- **[Laravel 13](https://laravel.com)** — PHP framework for server-side logic
- **[PHP 8.3](https://www.php.net)** — Programming language with modern features
- **[MySQL](https://www.mysql.com)** — Relational database management system
- **[Redis](https://redis.io)** — In-memory data store for caching and queues

### Frontend
- **[Vite](https://vitejs.dev)** — Next-generation frontend build tool
- **[Tailwind CSS 4.0](https://tailwindcss.com)** — Utility-first CSS framework
- **[Alpine.js](https://alpinejs.dev)** — JavaScript framework for reactive UI components
- **[Poppins Font](https://fonts.google.com/specimen/Poppins)** — Google Fonts for typography

### DevOps & Tooling
- **[Composer](https://getcomposer.org)** — PHP dependency management
- **[NPM](https://www.npmjs.com)** — Node.js package management
- **[PHPUnit](https://phpunit.de)** — Testing framework
- **[Pint](https://github.com/laravel/pint)** — Code style fixer

## Architecture

The project follows the **MVC (Model-View-Controller)** pattern:

```
┌─────────────┐     ┌──────────────┐     ┌─────────────┐
│   Frontend   │────▶│    Routes    │────▶│  Controllers │
│  (Blade +    │     │  (web.php)   │     │  (PHP)       │
│  Tailwind)   │◀────│              │◀────│   Models     │
└─────────────┘     └──────────────┘     └─────────────┘
```

- **Model** — Eloquent ORM for database interactions (`app/Models/`)
- **View** — Blade templates with Tailwind CSS styling (`resources/views/`)
- **Controller** — Request handling and business logic (`app/Http/Controllers/`)

## Installation

### Prerequisites
- PHP 8.3+
- MySQL 8.0+
- Redis
- Node.js 18+
- Composer
- NPM

### Steps

```bash
# Clone the repository
git clone https://github.com/jatipurnomo/interlude.git
cd interlude

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Copy and configure environment file
cp .env.example .env
php artisan key:generate

# Configure database in .env (DB_CONNECTION, DB_HOST, DB_DATABASE, etc.)

# Run migrations
php artisan migrate

# Build frontend assets
npm run build

# Start development server
php artisan serve

# Start Vite dev server (in another terminal)
npm run dev
```

## Project Structure

```
interlude/
├── app/                  # Application code (Models, Controllers, etc.)
│   ├── Models/           # Eloquent models (User, Book, Category, etc.)
│   ├── Http/Controllers/ # Route controllers
│   └── Providers/        # Service providers
├── bootstrap/            # Application bootstrap files
├── config/               # Laravel configuration files
├── database/             # Migrations and seeders
├── public/               # Publicly accessible files
├── resources/
│   ├── views/            # Blade templates
│   │   ├── layouts/      # Main layout files
│   │   ├── components/   # Reusable UI components
│   │   ├── admin/        # Admin panel views
│   │   ├── auth/         # Authentication views
│   │   └── ...           # Page views (home, blog, dashboard, etc.)
│   ├── css/              # Stylesheets (app.css, dashboard.css, etc.)
│   └── js/               # JavaScript assets
├── routes/               # Route definitions
├── storage/              # Cached files, logs, uploads
├── tests/                # Test suites
├── vendor/               # Composer dependencies
├── vite.config.js        # Vite build configuration
├── composer.json         # PHP dependencies
├── package.json          # Node.js dependencies
└── .env                  # Environment configuration
```

## Routes

### Public Routes
| Route | Controller | Description |
|-------|-----------|-------------|
| `/` | `HomeController@index` | Homepage |
| `/blog` | `BlogController@index` | Blog page |
| `/galeri` | `YouTubeController@index` | Gallery page |
| `/search` | `SearchController@index` | Search page |
| `/buku/{book}` | `BookController@show` | Book detail page |
| `/beli/{book}` | `BookController@buy` | Purchase page |
| `/wishlist/{book}` | `BookController@wishlist` | Add to wishlist |
| `/login` | `AuthController@showLogin` | Login page |

### Authenticated Routes
| Route | Controller | Description |
|-------|-----------|-------------|
| `/dashboard` | `DashboardController@index` | User dashboard |
| `/profile` | `ProfileController@show/update` | User profile |
| `/admin/books` | `AdminBookController` | Book management (CRUD) |
| `/admin/categories` | `CategoryController` | Category management (CRUD) |
| `/logout` | `AuthController@logout` | Logout |

## Admin Panel

The admin panel provides full content management capabilities:

- **Books**: Create, read, update, and delete book entries with cover image uploads
- **Categories**: Manage book categories for organizing content
- **Dashboard**: View platform statistics and analytics
- **Search**: Advanced search functionality across all content

## Configuration

Key configuration files:

- **`.env`** — Environment variables (database, cache, mail, etc.)
- **`config/app.php`** — Application settings
- **`config/database.php`** — Database connections
- **`config/cache.php`** — Cache driver configuration
- **`config/queue.php`** — Queue driver configuration
- **`config/mail.php`** — Email settings
- **`vite.config.js`** — Frontend build configuration

## Deployment

For production deployment, refer to the deployment checklist:

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Configure production database credentials
3. Set up Redis for caching and queues
4. Configure SMTP mailer settings
5. Run `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`
6. Run `php artisan storage:link` for file storage
7. Set up HTTPS/SSL certificate
8. Configure queue workers

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch and open a Pull Request

## License

This project is licensed under the MIT License.
