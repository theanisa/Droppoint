<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user'])) {
  header("Location: login.html");
  exit;
}

$user_id = $_POST['user_id'];
$type = $_POST['type'];
$description = $_POST['description'];
$location = $_POST['location'];
$item_date = $_POST['item_date'];
$image = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
  $targetDir = "uploads/";
  $image = $targetDir . basename($_FILES["image"]["name"]);
  move_uploaded_file($_FILES["image"]["tmp_name"], $image);
}

$sql = "INSERT INTO posts (user_id, type, description, location, item_date, image) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssss", $user_id, $type, $description, $location, $item_date, $image);
$stmt->execute();

header("Location: dashboard.php");
exit;
?>
