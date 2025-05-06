<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

// Get database credentials
$HOSTNAME = $_ENV['HOSTNAME'] ?? 'localhost'; 
$DB_USERNAME = $_ENV['DB_USER'] ?? 'root';    
$DB_PASSWORD = $_ENV['DB_PASSWORD'] ?? '';    
$DB_NAME = $_ENV['DB_NAME']; 

//connection
$conn = mysqli_connect($HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error()); 
} 

mysqli_set_charset($conn, "utf8");



?>