<?php
include 'db_config.php';
$post_id = $_GET['post_id'];

$sql = "SELECT comments.*, users.name FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = ? ORDER BY comments.id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];
while ($row = $result->fetch_assoc()) {
  $comments[] = $row;
}

header('Content-Type: application/json');
echo json_encode($comments);
?>
