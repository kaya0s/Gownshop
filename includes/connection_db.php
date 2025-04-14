<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

// Get database credentials
$HOSTNAME = $_ENV['HOSTNAME'] ?? 'localhost'; // Default to localhost if not set
$DB_USERNAME = $_ENV['DB_USER'] ?? 'root';    // Default to root if not set
$DB_PASSWORD = $_ENV['DB_PASSWORD'] ?? '';    // Default to empty password
$DB_NAME = $_ENV['DB_NAME'] ?? 'hj_gownshop'; // Default to your DB name

// Create connection
$conn = mysqli_connect($HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error()); 
} 

mysqli_set_charset($conn, "utf8");