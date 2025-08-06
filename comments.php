<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user'])) {
  header("Location: login.html");
  exit;
}

$user_id = $_SESSION['user']['id'];
$post_id = $_POST['post_id'];
$comment = $_POST['comment'];

$sql = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $post_id, $user_id, $comment);
$stmt->execute();

header("Location: dashboard.php");
?>
