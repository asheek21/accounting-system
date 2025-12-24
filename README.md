# Accounting Management System

A comprehensive account management platform built with Laravel 11, featuring transaction tracking, financial reporting, and detailed analytics.

## Features

- **Dashboard** - Overview of financial activities with stats by account and category
- **Account Management** - Manage multiple financial accounts
- **Transaction Tracking** - Record and track income/expense transactions
- **Category Organization** - Organize transactions by custom categories
- **Financial Reports** - Detailed income and expense reports with filtering
- **Data Export** - Export filtered data to CSV
- **Real-time Search & Filters** - Dynamic datatables with advanced filtering

## Tech Stack

- **Backend:** Laravel 12
- **Frontend:** Blade Templates, Alpine.js, Tailwind CSS
- **Database:** MySQL

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL

### Setup Instructions

1. **Clone the repository**

```bash
git clone https://github.com/asheek21/accounting-system.git
cd accounting-system
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Install Node dependencies**

```bash
npm install
```

4. **Environment setup**

```bash
cp .env.example .env
```

5. **Generate application key**

```bash
php artisan key:generate
```

6. **Configure your database**

Edit `.env` file and update database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=accounting_system
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. **Run migrations and seed database**

```bash
php artisan migrate --seed
```

This will create all necessary tables and populate them with sample data including:
- User accounts
- Categories
- Accounts
- Sample transactions

8. **Build frontend assets**

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

9. **Start the development server**

```bash
php artisan serve
```

## Default Login Credentials

After seeding the database, you can login with:

- **Email:** `testuser@gmail.com`
- **Password:** `password`

## Key Features Explained

### DataTable Component

Reusable component with built-in features:
- Server-side pagination
- Real-time search
- Dynamic filters (dropdowns, date ranges)
- CSV export
- Sorting capabilities

Usage example:

```blade
<x-data-table 
    id="transactions-table"
    type="transaction"
    :columns="[...]"
    :filters="[...]"
    :searchable="true"
    :exportable="true"
    :per-page="15">
    Table Title
</x-data-table>
```

### Stat Card Component

Reusable statistics card:

```blade
<x-stat-card 
    title="Total Income"
    value="${{ number_format($amount, 2) }}"
    color="success"
    subtitle="All time"
    trend="+12.5% from last month"
    trend-direction="up"
    :icon="'<svg>...</svg>'"
/>
```

### Reports

The reporting system provides:
- Income vs Expense analysis
- Statistics by account
- Statistics by category
- Top spending categories
- Monthly trends
- Filterable data exports

## Development

### Running Tests

```bash
php artisan test
```

### Code Style

This project follows Laravel coding standards. To check code style:

```bash
./vendor/bin/pint
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

**Happy Accounting! 📊**