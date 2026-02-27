# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

A Laravel 8.75 product catalog management system with:
- Role-based access control (admin / user roles)
- Product and category CRUD with image uploads
- PDF catalog export (1 or 2 items per page layouts)
- Company settings management
- Social sharing integration

## Commands

```bash
# Dependencies
composer install
npm install

# Database
php artisan migrate
php artisan migrate:fresh --seed

# Development server
php artisan serve                 # http://127.0.0.1:8000

# Asset compilation
npm run dev                       # Development with source maps
npm run watch                     # Watch mode
npm run production                # Minified build

# Testing
./vendor/bin/phpunit              # All tests
./vendor/bin/phpunit tests/Feature/SomeTest.php  # Single test file

# Useful artisan
php artisan route:list            # Show all routes
php artisan tinker                # Interactive shell
```

## Architecture

### Request Lifecycle
All routes require authentication (`auth` middleware). Admin-only routes additionally require `admin` middleware, which checks `User::isAdmin()` via `app/Http/Middleware/IsAdmin.php`.

### Route Organization (`routes/web.php`)
- **Authenticated users**: `/` (dashboard), `/search-product`, `/export-product`, `/filter-category`, `/share-product`
- **Admin only**: `/products`, `/categories`, `/company-settings`, `/users` — and their respective store/edit/delete/update sub-routes

### Modal-Based Admin UI Pattern
Admin CRUD uses a consistent pattern:
1. `GET /delete-{entity}/{id}` → controller returns JSON with entity data for the confirmation modal
2. `POST /remove-{entity}` → controller performs the actual deletion
3. `GET /edit-{entity}/{id}` → controller returns JSON for the edit modal
4. `PUT /update-{entity}` → controller saves the update

### Image Storage
Product images are stored in `public/images/` named `{SKU}.{extension}`. The SKU field on the Product model doubles as the image filename identifier.

### PDF Export
Route `GET /export-product` accepts `category_id`, `print_type` (1 or 2 items per page), and `cat_title`. Uses `barryvdh/laravel-dompdf` with Blade templates in `resources/views/print/`.

### Key Models & Relations
- `Category` has many `Product`s (cascade delete)
- `Product` belongs to `Category`; has `out_of_stock` (boolean) and `quantity` fields
- `CompanySetting` is a single-record settings table — always accessed via `CompanySetting::first()`
- `User` has a `role` column (`'admin'` or `'user'`)

## Environment
Database: MySQL, database name `cataloge`, default credentials `root/root` (see `.env`).
