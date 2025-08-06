<?php
session_start();
include 'db_config.php';
if (!isset($_SESSION['user'])) {
  header("Location: login.html");
  exit;
}
$user = $_SESSION['user'];
?>
