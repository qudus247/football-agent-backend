<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['full_name'], $data['email'], $data['password'], $data['role'])) {
  die(json_encode(["error" => "Missing fields"]));
}

$role_query = $conn->prepare("SELECT id FROM roles WHERE name = ?");
$role_query->bind_param("s", $data['role']);
$role_query->execute();
$role_result = $role_query->get_result()->fetch_assoc();

if (!$role_result) die(json_encode(["error" => "Invalid role."]));

$hashed = password_hash($data['password'], PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (full_name, email, password, role_id, phone, country, profile) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssisss", $data['full_name'], $data['email'], $hashed, $role_result['id'], $data['phone'], $data['country'], $data['profile']);

if ($stmt->execute()) {
  echo json_encode(["message" => "User created successfully."]);
} else {
  echo json_encode(["error" => "Failed to create user or email already exists."]);
}

$conn->close();
?>
