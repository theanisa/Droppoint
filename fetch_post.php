<?php
include 'db_config.php';
$sql = "SELECT posts.*, users.name FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC";
$result = $conn->query($sql);

$posts = [];
while ($row = $result->fetch_assoc()) {
  $posts[] = $row;
}

header('Content-Type: application/json');
echo json_encode($posts);
?>
