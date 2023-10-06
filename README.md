# Laravel Rider Tracking App

This Laravel application is designed to track rider locations and find the nearest rider to a given restaurant.

## Installation

1. **Clone the repository:**

    ```bash
    https://github.com/nadimsajib/food-delivery-app.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd food-delivery-app
    ```

3. **Install dependencies using Composer:**

    ```bash
    composer install
    ```

4. **Create a copy of the `.env.example` file and rename it to `.env`:**

    ```bash
    cp .env.example .env
    ```

5. **Generate an application key:**

    ```bash
    php artisan key:generate
    ```

6. **Configure your database in the `.env` file:**

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

7. **Run migrations to create database tables:**

    ```bash
    php artisan migrate
    ```

8. **Seed the database with sample data:**

    ```bash
    php artisan db:seed --class=RestaurantsTableSeeder
    ```
    ```bash
    php artisan db:seed --class=RiderTrackingsTableSeeder
    ```

## API Guidelines

### 1. Save Rider Information (POST)

Endpoint: `/api/save-rider-info`

- **Method:** POST
- **Request Body:**
  - `rider_id` (required): Rider's ID.
  - `lat` (required): Latitude of the rider's location.
  - `long` (required): Longitude of the rider's location.
  - `timestamp` (required): Timestamp of the rider's location.

Example:

```bash
curl -X POST http://your-app-url/api/save-rider-info \
  -d "rider_id=1" \
  -d "lat=40.7128" \
  -d "long=-74.0060" \
  -d "timestamp=2023-10-06 12:00:00"
```
### 2. Find Nearest Rider (GET)

Endpoint: `/api/nearest-rider/{restaurant_id}`

- **Method:** GET
- **Parameters:**
  - `restaurant_id (required): ID of the restaurant to find the nearest rider.

Example:

```bash
curl -X GET http://your-app-url/api/nearest-rider/1 \
```
Replace your-app-url with the actual URL where your Laravel app is hosted.


## ther also a test case . To run this test command below :L

    ```bash
    php artisan test
    ```
