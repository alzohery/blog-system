<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-red" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.3-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/Architecture-HMVC-success" alt="Architecture">
  <img src="https://img.shields.io/badge/Queue-Database-orange" alt="Queue Driver">
</p>

---

# Blog Management System – Laravel Backend Task

## Overview

This project is a **Blog Management System** built with **Laravel** as a backend technical task.  
It demonstrates clean architecture, scalability, and real-world backend practices.

The system provides an **Admin Dashboard** to manage blog posts, categories, users, and scheduled publishing using Laravel Queue Jobs.

---

## Features

### Authentication & Users
- Multi Authentication system:
  - **Admins**
  - **Users**
- Separate guards for each user type
- Admin-only access to dashboard and management features

---

### Architecture & Code Structure
- **HMVC Architecture**
- Clear separation of concerns
- **DTO (Data Transfer Objects)**
- **Service Layer** for business logic
- Thin controllers (no business logic inside controllers)

---

### Posts Management (Admin Only)
- Full CRUD operations
- Post statuses:
  - Draft
  - Scheduled
  - Published
- Schedule posts for future publishing
- Automatic publishing using Laravel Queue Jobs

---

### Categories Management
- Create, update, and delete categories
- Each post belongs to one category

---

### Queue & Scheduling
- Database queue driver
- Scheduled posts are published automatically at the specified time
- Queue tested using `php artisan queue:work`

---

### Activity Log
- Logs all post actions:
  - Create
  - Update
  - Delete
  - Status Change
- Polymorphic activity logging
- Admin attribution for each action

---

### Advanced Filtering
- Filter posts by:
  - Category
  - Title (search)
  - Status
- Optimized queries
- Eager loading to prevent N+1 issues
- Pagination support

---

### Admin Dashboard
- Dashboard statistics:
  - Total users
  - Total posts
  - Published posts
  - Scheduled posts
  - Categories count
- Clean UI using **Blade + Tailwind CSS**

---

### User Management (Admin)
- Admin can:
  - Create users
  - Update users
  - Activate / deactivate users
  - Delete users
- User authentication prepared for future frontend usage

---

## Technologies Used

- Laravel 12.44.0
- PHP 8.3
- MySQL
- Blade Templates
- Tailwind CSS 4.1
- Laravel Queue (Database Driver)

---

## Project Structure (Simplified)

```text
app/
 └── Modules/
     ├── Admin
     ├── Posts
     ├── Categories
     ├── Users
     ├── ActivityLog
```

---

## Prerequisites

- PHP >= 8.2
- Composer
- MySQL (or any Laravel-supported database)
- Node.js (optional)

---

## Installation & Setup

### Clone the Repository
```bash
git clone https://github.com/alzohery/blog-system.git
cd blog-system
```

### Install Dependencies
```bash
composer install
```

### Environment Setup
```bash
cp .env.example .env
```

Update database credentials in `.env`.

### Generate App Key
```bash
php artisan key:generate
```

### Run Migrations
```bash
php artisan migrate
```

### Storage Link
```bash
php artisan storage:link
```

---

## Run the Application
```bash
php artisan serve
```

Application will be available at:
```
http://127.0.0.1:8000
```

---

## Queue Worker
```bash
php artisan queue:work
```

---

## Admin Panel
```
/admin
```

---

## Author

**Mohamed Alzohery**  
📧 mohamedmohasenalzohery@gmail.com

---

## License

This project is created for technical evaluation purposes.
