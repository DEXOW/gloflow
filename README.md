# Gloflow CRM System

![Gloflow](public/assets/images/logo.svg)

## Overview

Introducing the Gloflow CRM (Customer Relationship Management) System, a tailored solution meticulously crafted to meet the distinctive demands encountered by distributor agencies. Harnessing the formidable capabilities of Laravel, Bootstrap, and SQLite, this platform offers an all-encompassing answer that elevates customer interaction, optimizes operational workflows, and guarantees adherence to regulatory requirements.

In an ever-evolving business landscape, Gloflow CRM stands as the quintessential tool for distributor agencies seeking to fortify their customer relationships, operational efficiency, and compliance standards.

## Features

### 1.0 Customer Relationship Management (CRM):

- Comprehensive customer profiles with contact information, purchase history, and communication logs.

### 2.0 Analytics and Reporting:

- Advanced analytics tools for sales forecasting, trend analysis, and performance monitoring.
- Customizable reports and real-time dashboards to visualize key metrics.

### 3.0 User Management and Access Control:

- Role-based user access control for enhanced security and data protection.
- Simple user onboarding and management to tailor access permissions.

### 4.0 Support and Documentation:

- Customer support systems.
- In-app help resources and documentation for user guidance.

### 5.0 Inventory Management:

- Inventory tracking with real-time updates on stock levels and order status.
- Automated alerts for low stock and reordering.

### 6.0 Communication Management:

- Centralized communication history with customers, including emails, calls, and messages.
- Automated communication workflows for timely follow-ups and responses.

## Technologies Used

- Laravel: A powerful PHP framework for building web applications.
- Bootstrap: A utility-first CSS framework for creating responsive and customizable UI components.
- SQLite: A lightweight and easy-to-use database engine.

## Installation

Follow these steps to set up the Respawn Entertainment CRM system on your local machine:

1. Clone this repository to your local machine:

    ```shell
    git clone https://github.com/DEXOW/gloflow.git
    ```

2. Change to the project directory:

    ```shell
    cd gloflow
    ```

3. Install Composer dependencies:

    ```shell
    composer install
    ```

4. Install NPM dependencies:

    ```shell
    npm install
    ```

5. Create a copy of the `.env.example` file and rename it to `.env`:

    ```shell
    cp .env.example .env
    ```

6. Generate an application key:

    ```shell
    php artisan key:generate
    ```

7. Configure your database connection in the `.env` file:

    ```shell
    DB_CONNECTION=sqlite
    DB_DATABASE=database.sqlite
    ```

8. Migrate the database:

    ```shell
    php artisan migrate
    ```

9. Build the frontend:
    ```shell
    npm run build
    ```
10. Start the development server:

    ```shell
    php artisan serve
    ```

11. Visit `http://localhost:8000` or `http://127.0.0.1:8000` in your web browser to access the CRM system.

---

With these steps, you'll have the Gloflow CRM system up and running on your local environment.