<?php
session_start();
include 'db_config.php';

$student_id = $_POST['student_id'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();
  if ($user['password'] === $password) {
    $_SESSION['user'] = $user;
    header("Location: dashboard.php");
    exit();
  } else {
    echo "<script>alert('Incorrect password!'); window.location='login.html';</script>";
  }
} else {
  echo "<script>alert('Student ID not found!'); window.location='login.html';</script>";
}
?>
