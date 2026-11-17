# RTMS – Route-to-Market System  
**Sales Tracking Dashboard (Finance Version) – Laravel**

A full-featured web dashboard and API for managing field sales operations, route planning, outlet visits, and sales tracking. Built for multi-organization environments with team-based access control. Works with the companion Android mobile apps.

---

## Overview

**RTMS (Route-to-Market System)** helps sales teams and managers track field activities in real time:

- Sales representatives clock in/out and check in/out at outlets with GPS
- Managers monitor visits, sales (deals), route compliance, and performance
- Finance-focused version with strong sales tracking, analytics, targets, and reporting

Supports multiple organizations and teams, with role-based visibility (including view-only restrictions for team leads).

---

## Key Features

### Dashboard & Analytics
- Real-time overview of sales, visits, outlets, products, POS audits, competitors, and feedback
- Charts for sales trends (monthly & weekly)
- Top sellers, top products, and top outlets
- Recent activity feeds and maps

### Sales Management
- Record and track sales (deals) linked to visits and outlets
- Sale items with quantities and values
- Status workflow: Pending → Complete / Cancel
- Sales analytics, targets, and filtering
- PDF order notes (DomPDF)

### Field Operations
- Clock-in / Clock-out with GPS coordinates
- Outlet (Customer) management with location, contact details, and maps
- Visits – check-in / check-out tracking
- Route plans – create and manage daily routes
- Off-plan requests for deviations from planned routes

### Market Intelligence
- POS audits (point-of-sale audits with items)
- Competitor analysis (brand visibility & pricing)
- Customer feedback and follow-ups

### Organization & Team Management
- Multi-organization support
- Teams, territories, regions, and target groups
- User management with role-based access
- Soft deletes and organization-level data scoping

### Mobile API
- Full REST API protected by Laravel Sanctum
- Endpoints for clock-in/out, visits, sales, outlets, feedback, POS audits, route plans, etc.
- Designed to work with the companion Android apps

---

## Tech Stack

| Layer          | Technology                          |
|----------------|-------------------------------------|
| Backend        | PHP 8.1+ · Laravel 10               |
| Authentication | Laravel Sanctum                     |
| Database       | MySQL / MariaDB                     |
| Frontend       | Blade · Vite · Yajra DataTables     |
| PDF            | DomPDF                              |
| Monitoring     | Sentry                              |
| Other          | Google API Client, League Glide     |

---

## Installation

### Prerequisites
- PHP ≥ 8.1
- Composer
- MySQL / MariaDB
- Node.js & npm (for frontend assets)

### Setup Steps

```bash
# 1. Clone the repository
git clone https://github.com/JavisOtieno/RTMS-Route-to-Market-System-Sales-Tracking-Dashboard-Finance-Version-Laravel-Based.git
cd RTMS-Route-to-Market-System-Sales-Tracking-Dashboard-Finance-Version-Laravel-Based

# 2. Install PHP dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Configure your database in .env
# DB_DATABASE=rtmis
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Import the database (optional – includes sample data)
mysql -u root -p rtmis < rtmis_db1.sql

# OR run migrations (if you prefer a clean install)
# php artisan migrate

# 7. Install frontend dependencies and build assets
npm install
npm run build

# 8. Start the development server
php artisan serve
