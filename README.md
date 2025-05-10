# HJ Gownshop

A web-based gown rental management system with user authentication, including Google OAuth integration.

## Features

- User authentication (email/password and Google OAuth)
- Gown inventory management
- Booking and rental management
- Payment integration
- Admin dashboard
- Email notifications system
- Conflict booking auto checker

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- XAMPP (or similar local development environment)

## Installation

1. Clone the repository:
git clone https://github.com/yourusername/hj-gownshop.git
cd hj-gownshop

2. Install dependencies:
composer install

3. Create a `.env` file in the root directory with the following variables:
DB_HOST=localhost
DB_NAME=hj_gownshop_db
DB_USER=your_database_user
DB_PASS=your_database_password
APP_BOOKING_SYSTEM=
EMAIL_ADMIN=HJ_Gownshop@gmail.com
EMAIL_PASS=your_gmail_app_password
GOOGLE_CLIENT_ID=your_google_client_secret
GOOGLE_CLIENT_SECRET=https://localhost/hj-gownshop/google-callback.php

4. Import the database schema:
mysql -u your_database_user -p your_database_name < import.sql

5. Configure Google OAuth:

- Go to the [Google Cloud Console](https://console.cloud.google.com/)
- Create a new project or select an existing one
- Enable the Google+ API
- Create OAuth 2.0 credentials
- Add the redirect URL: `http://localhost/hj-gownshop/googleAuth/google-callback.php`


## Usage

1. Start your local server (XAMPP, etc.)
2. Navigate to `http://localhost/hj-gownshop/`
3. Register a new account or log in with Google

## Project Structure

- `assets/` - Images, CSS and JavaScript files
- `admin/` - Admin dashboard files
- `includes/` - Database connection and utilities
- `google-auth/` - Google OAuth integration
- `mail/` - Email notification system
- `views/` - Main application pages
- `styles/` - CSS stylesheets
- `vendor/` - Composer dependencies

## License

MIT License

## Contact

For any questions or issues, please contact erwin.lanzaderas@gmail.com

