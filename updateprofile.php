<?php
include 'db_config.php';
session_start();
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];

$sql = "UPDATE users SET name=?, email=?, contact=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $email, $contact, $id);

if ($stmt->execute()) {
  $_SESSION['user']['name'] = $name;
  $_SESSION['user']['email'] = $email;
  $_SESSION['user']['contact'] = $contact;
  header("Location: profile.php");
} else {
  echo "<script>alert('Update failed.'); window.location='profile.php';</script>";
}
?>
