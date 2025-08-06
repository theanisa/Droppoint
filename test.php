<?php
// Force PHP to show all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to DB
$host = "localhost";
$username = "root";
$password = "";
$database = "droppoint";

$conn = new mysqli($host, $username, $password, $database);

// Test connection
if ($conn->connect_error) {
  die("❌ Connection failed: " . $conn->connect_error);
} else {
  echo "✅ Connected to database successfully!";
}
?>
