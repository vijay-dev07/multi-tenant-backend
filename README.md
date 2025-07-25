# Multi-Tenant Backend App

A Laravel 12 backend application supporting user authentication and multi-company (multi-tenant) management. Each user can create, manage, and switch between multiple companies. All data and actions are scoped to the active company.

## Features

- User registration, login, logout (via Laravel Breeze)
- CRUD operations for companies (name, address, industry)
- User-specific company access and ownership
- Active company switching (scoped session)
- Pagination and search for company listings
- Blade views with Tailwind CSS

---

## Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/multi-tenant-backend-app.git
   cd multi-tenant-backend-app


2. **Install Dependencies**
```bash
composer install
npm install && npm run dev


cp .env.example .env
php artisan key:generate

- Configure Database
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password

- Run Migrations
php artisan migrate

- Serve the Application
php artisan serve

