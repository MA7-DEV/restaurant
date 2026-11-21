# Restaurant Management System

A full-stack restaurant web application built with Laravel, designed to provide customers with a smooth food-ordering experience and administrators with an easy-to-use management dashboard.

## Live Demo

- **Live Website:** https://restaurant.ethiodeploy.app
- **GitHub Repository:** https://github.com/MA7-DEV/restaurant

## Features

### Customer Features
- Browse meals and explore food categories.
- View meal details and prices.
- Add meals to the shopping cart.
- Update cart items and quantities.
- Proceed through the checkout process.
- User authentication and profile management.

### Admin Features
- Admin dashboard.
- Manage meals (Create, Read, Update, Delete).
- Manage food categories.
- View and manage restaurant data.

## Technologies Used

- **Backend:** PHP, Laravel
- **Frontend:** Blade, HTML, CSS, JavaScript
- **Database:** MySQL
- **Build Tools:** Vite, NPM
- **Deployment:** EthioDeploy

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/MA7-DEV/restaurant.git
cd restaurant
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Update your `.env` file with your local database credentials.

### 4. Set Up the Database

Create a MySQL database, then run:

```bash
php artisan migrate
```

### 5. Build Frontend Assets

```bash
npm run build
```

### 6. Start the Application

```bash
php artisan serve
```

Open `http://127.0.0.1:8000` in your browser.

## Project Structure

```text
app/
  Http/Controllers/
  Models/
  Services/
database/
  migrations/
  seeders/
resources/
  views/
  css/
  js/
routes/
  web.php
```

## Developer

**Mahmoud Wael Mohamed Mahmoud**

- GitHub: [MA7-DEV](https://github.com/MA7-DEV)

## Internship

Developed as part of the **Full Stack Development Internship** at **Codveda Technologies**.

---

© 2026 Restaurant Management System. All rights reserved.