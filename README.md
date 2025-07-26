# Multi-Tenant Backend App

A Laravel 12 backend application supporting user authentication and multi-company (multi-tenant) management. Each user can create, manage, and switch between multiple companies. All data and actions are scoped to the active company.

## Features

- User registration, login, logout (via Laravel Breeze)
- CRUD operations for companies (name, address, industry)
- User-specific company access and ownership
- Active company switching (scoped session)
- Pagination 
- Blade views with Tailwind CSS

## Multi-Tenant Logic

- Each user can create and manage multiple companies.

- Only companies created by the authenticated user are visible and editable by them.

- A user can switch their active company from the dashboard using a dropdown.

- All future data operations (e.g., invoices, projects) will be scoped to the current active company.

- The active company is tracked using a user_active_companies pivot table.

## Tech Stack

- Laravel 12
- Laravel Breeze (Blade)
- MySQL
- Tailwind CSS
- Vite

---

## Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/vijay-dev07/multi-tenant-backend.git
   cd multi-tenant-backend-app


2. **Install Dependencies**
```bash
composer install
- need version 18 + for node
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

