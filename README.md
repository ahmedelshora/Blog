# Project Summary: Blog Platform

The **Blog Platform** is a Laravel-based application designed to manage blog posts and comments. It offers a simple and efficient way to interact with posts and their associated comments through a clean interface and RESTful APIs.

## Key Features

- **Post Management**  
  Create, view, and manage blog posts.

- **Comment Management**  
  Add and view comments on individual blog posts.

- **Authentication**  
  Secure user authentication implemented using **Laravel Sanctum**.

- **RESTful API**  
  Well-structured API endpoints to interact with posts and comments programmatically.

- **Testing**  
  Automated tests included to ensure core functionalities work as expected.

# Project Installation Guide

This guide will help you set up and run the Laravel project locally.

## 🚀 Prerequisites

Before you begin, ensure you have the following installed on your system:

- **PHP** >= 8.1
- **PostgreSQL** >= 12
- **Composer** >= 2.x
- **Git** (for cloning the repository)

---

## 📦 Installation Steps

1. **Clone the Project**

   ```bash
   git clone https://github.com/ahmedelshora/Blog.git
   cd Blog
   ```

2. **Create `.env` File**

   Copy the `.env.example` file to create your environment configuration:

   ```bash
   cp .env.example .env
   ```
   and update your database configuration
   ```
   DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=db_name
    DB_USERNAME=db_user
    DB_PASSWORD=secret
   ```

3. **Install Dependencies**

   Run the following command to install PHP dependencies:

   ```bash
   composer install
   ```

4. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**

   Set your PostgreSQL credentials in the `.env` file, then run:

   ```bash
   php artisan migrate
   ```

6. **Run Tests (Optional)**

   To ensure everything is working correctly:

   ```bash
   php artisan test
   ```

7. **Serve the Application**

   Start the development server:

   ```bash
   php artisan serve
   ```

   The application will be accessible at [http://localhost:8000](http://localhost:8000)

---

## 🧩 Troubleshooting

- Make sure your database is running and credentials in `.env` are correct.
- Ensure all necessary PHP extensions are installed (e.g., `pdo_pgsql`, `mbstring`, `bcmath`, `zip`, etc.).

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).
