<?php // Define database constants 
define("DB_SERVER", "localhost"); 
define("DB_USERNAME", "root"); 
define("DB_PASSWORD", "");
 define("DB_NAME", "hj_gownshop"); 
 
 // Create connection
  $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  // Check connection 
  if (!$conn) { die("Connection failed: " . mysqli_connect_error()); } 
  // Set character set to utf8 (optional but recommended) 
  mysqli_set_charset($conn, "utf8"); ?>