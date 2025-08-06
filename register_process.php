<?php
session_start();
include 'db_config.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$student_id = $_POST['student_id'];
$contact = $_POST['contact'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Validate student ID (must contain '115')
if (!str_contains($student_id, '115')) {
  echo "<script>alert('Invalid Student ID: CSE IDs must contain 115'); window.location='register.html';</script>";
  exit;
}

// Save user
$sql = "INSERT INTO users (name, email, student_id, contact, password) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $email, $student_id, $contact, $password);

if ($stmt->execute()) {
  echo "<script>alert('Registration successful! Please login.'); window.location='login.html';</script>";
} else {
  echo "<script>alert('Error: Could not register.'); window.location='register.html';</script>";
}
?>
