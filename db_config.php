<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

$host = "localhost";
$username = "root";
$password = "";
$database = "droppoint";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
