<?php
include 'db.php';

$sql = "SELECT users.id, users.full_name, users.email, roles.name AS role, users.phone, users.country, users.profile, users.created_at 
        FROM users 
        JOIN roles ON users.role_id = roles.id";
$result = $conn->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
  $users[] = $row;
}

echo json_encode($users, JSON_PRETTY_PRINT);

$conn->close();
?>
