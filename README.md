# MAJĀA — E-Commerce Store

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red?logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue?logo=php)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.4-38bdf8?logo=tailwindcss)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

MAJĀA is an elegant e-commerce web application dedicated to modest women's fashion —
abayas, hijabs, kimonos and accessories. Built with Laravel 10 and Tailwind CSS, it
offers a refined shopping experience from product discovery to checkout, along with a
back-office dashboard for managing the catalog.

## Features

- 🛍️ **Catalog** — Browse collections (Abayas, Hijabs, Kimonos, Accessories) with
  filtering by size/color and sorting options, with AJAX pagination.
- 🛒 **Cart** — Add, update and remove items; persistent cart session.
- ❤️ **Wishlist** — Save favorite products for later.
- 💳 **Checkout** — Secure order processing with Stripe, plus success confirmation.
- ✉️ **Order emails** — Automatic order confirmation and business notification emails.
- 👤 **Authentication** — Sign up, log in and log out.
- 📊 **Dashboard** — Back-office to manage products (store new items).
- 🧾 **Product detail** — Rich product pages with composition details and
  "Précommander" (pre-order) support.
- 🚧 **Suspended mode** — Site-wide maintenance page via middleware.
- 🔔 **Stock notifications** — "Notify me" requests for out-of-stock products.

## Tech Stack

- **Backend:** Laravel 10 (PHP 8.1+), Eloquent ORM, Sanctum
- **Frontend:** Blade templates, Tailwind CSS, Vite, Axios
- **Database:** MySQL
- **Payments:** Stripe (stripe-php)
- **Image optimization:** Spatie Laravel Image Optimizer
- **Mail:** SMTP (Mailpit-friendly for local dev)

## Getting Started

### Prerequisites

- PHP 8.1+
- Composer
- Node.js & npm
- MySQL

### Installation

```bash
git clone https://github.com/sohaib-bkt/MAJA-ECOME-STORE.git
cd MAJA-ECOME-STORE

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Environment
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database, mail and Stripe credentials:

```env
DB_DATABASE=maja_store
DB_USERNAME=root
DB_PASSWORD=

STRIPE_KEY=your_stripe_public_key
STRIPE_SECRET=your_stripe_secret_key
```

```bash
# Run migrations and seeders
php artisan migrate --seed

# Build frontend assets
npm run build
# or for development
npm run dev

# Start the server
php artisan serve
```

The app will be available at `http://localhost:8000`.

## Project Structure

```
app/
├── Http/Controllers/   # HomeController, CartController, CheckoutController, ...
├── Models/             # Product, Order, User, ProductNotification
├── Mail/               # OrderConfirmation, OrderBusinessNotification
└── Http/Middleware/    # SuspendSite, ...
resources/
├── views/              # Blade templates (index, shop/*, checkout, panier, ...)
├── css/                # Tailwind entry
└── js/                 # Vite entry
database/
├── migrations/
└── seeders/            # ProductSeeder
routes/
└── web.php
```

## Main Routes

| Method | URI | Name |
|--------|-----|------|
| GET | `/` | home |
| GET | `/collections/abayas` | collections.abayas |
| GET | `/collections/hijabs` | collections.hijabs |
| GET | `/collections/accessoires` | collections.accessoires |
| GET | `/collections/kimonos` | collections.kimonos |
| GET | `/shop/{id}` | showProduct |
| GET | `/panier` | panier |
| GET | `/checkout` | checkout |
| GET | `/wishlist` | wishlist |
| GET | `/about` | about |
| GET | `/dashboard` | dashboard |

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---