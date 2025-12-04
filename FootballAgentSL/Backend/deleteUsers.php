<?php
include 'db.php';

$id = $_GET['id'] ?? 0;

if (!$id) die(json_encode(["error" => "User ID required."]));

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  echo json_encode(["message" => "User deleted successfully."]);
} else {
  echo json_encode(["error" => "User not found."]);
}

$conn->close();
?>
