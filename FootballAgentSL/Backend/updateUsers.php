<?php
include 'db.php';

$id = $_GET['id'] ?? 0;
$data = json_decode(file_get_contents("php://input"), true);

if (!$id) die(json_encode(["error" => "User ID required."]));

$fields = [];
$params = [];

if (isset($data['full_name'])) { $fields[] = "full_name=?"; $params[] = $data['full_name']; }
if (isset($data['email'])) { $fields[] = "email=?"; $params[] = $data['email']; }
if (isset($data['password'])) { $fields[] = "password=?"; $params[] = password_hash($data['password'], PASSWORD_DEFAULT); }
if (isset($data['phone'])) { $fields[] = "phone=?"; $params[] = $data['phone']; }
if (isset($data['country'])) { $fields[] = "country=?"; $params[] = $data['country']; }
if (isset($data['profile'])) { $fields[] = "profile=?"; $params[] = $data['profile']; }

$sql = "UPDATE users SET " . implode(",", $fields) . " WHERE id=?";
$params[] = $id;

$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat("s", count($params) - 1) . "i", ...$params);

if ($stmt->execute()) {
  echo json_encode(["message" => "User updated successfully."]);
} else {
  echo json_encode(["error" => "Failed to update user."]);
}

$conn->close();
?>
