# Product Catalog

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
![PHP Version](https://img.shields.io/badge/PHP-8.1-blue)
![Laravel Version](https://img.shields.io/badge/Laravel-10-orange)

## Requirements

- PHP >= 8.1
- Laravel >= 10
- Composer


## Installation and Setup

Follow these steps to set up the project on your local machine:

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/muflifadla38/product-catalog.git
   cd product-catalog

2. **Install Dependencies:**
   ```bash
   composer install

3. **Configure Environment:**
   ```bash
   cp .env.example .env

4. **Generate Application Key:**
   ```bash
   php artisan key:generate

5. **Generate JWT Secret Key:**
   ```bash
   php artisan jwt:secret

6. **Linking Storage:**
   ```bash
   php artisan storage:link

7. **Run Database Migrations & Seeders:**
   ```bash
   php artisan migrate
   php artisan db:seed

8. **Start the Development Server:**
   ```bash
   php artisan serve


## Usage
This dashboard provides a foundation for product catalog. You can extend it by adding your own components, modules, and features.


## Contributing
Contributions are welcome! If you have suggestions, bug reports, or want to contribute to this project, please create an issue or submit a pull request.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
