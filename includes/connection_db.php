<?php // Define database constants 

//ENV
use Dotenv\Dotenv as Dotenv;
$dotenv  = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();


    $HOSTNAME = $_ENV['HOSTNAME'];
    $DB_USERNAME=$_ENV['DB_USER'];
    $DB_PASSWORD=$_ENV['DB_PASSWORD'];
    $DB_NAME=$_ENV['DB_NAME'];

 // Create connection
  $conn = mysqli_connect($HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
  // Check connection 
  if (!$conn) { die("Connection failed: " . mysqli_connect_error()); } 
  // Set character set to utf8 (optional but recommended) 
  mysqli_set_charset($conn, "utf8");
  
  
  
  ?>

