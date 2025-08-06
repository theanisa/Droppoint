<?php
include 'db_config.php';

$term = $_GET['term'];
$type = $_GET['type'];

$sql = "SELECT posts.*, users.name FROM posts JOIN users ON posts.user_id = users.id WHERE (description LIKE ? OR location LIKE ?) AND type LIKE ? ORDER BY posts.id DESC";
$stmt = $conn->prepare($sql);
$searchTerm = "%$term%";
$typeFilter = $type === 'all' ? '%' : $type;
$stmt->bind_param("sss", $searchTerm, $searchTerm, $typeFilter);
$stmt->execute();
$result = $stmt->get_result();

$results = [];
while ($row = $result->fetch_assoc()) {
  $results[] = $row;
}

header('Content-Type: application/json');
echo json_encode($results);
?>
