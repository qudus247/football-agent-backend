<?php
include 'db.php';

// Insert roles
$roles = [
  ['Admin', 'Full access to the system'],
  ['Player', 'Registered football player'],
  ['Agent', 'Manages players and finds opportunities'],
  ['Club Manager', 'Manages club and scouting']
];

foreach ($roles as $role) {
  $stmt = $conn->prepare("INSERT IGNORE INTO roles (name, description) VALUES (?, ?)");
  $stmt->bind_param("ss", $role[0], $role[1]);
  $stmt->execute();
}

// Fetch role IDs
$role_map = [];
$result = $conn->query("SELECT id, name FROM roles");
while ($row = $result->fetch_assoc()) {
  $role_map[$row['name']] = $row['id'];
}

// Insert sample users
$users = [
  ['Super Admin', 'admin@footballagentsl.com', password_hash('Admin123', PASSWORD_DEFAULT), $role_map['Admin'], '+23270000001', 'Sierra Leone', 'System admin'],
  ['Mohamed Kamara', 'player1@example.com', password_hash('Player123', PASSWORD_DEFAULT), $role_map['Player'], '+23270000002', 'Sierra Leone', 'Right winger'],
  ['Ibrahim Conteh', 'agent1@example.com', password_hash('Agent123', PASSWORD_DEFAULT), $role_map['Agent'], '+23270000003', 'Sierra Leone', 'Local football agent'],
  ['John Bangura', 'manager1@club.com', password_hash('Manager123', PASSWORD_DEFAULT), $role_map['Club Manager'], '+23270000004', 'Sierra Leone', 'Club manager']
];

foreach ($users as $u) {
  $stmt = $conn->prepare("INSERT IGNORE INTO users (full_name, email, password, role_id, phone, country, profile) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssisss", $u[0], $u[1], $u[2], $u[3], $u[4], $u[5], $u[6]);
  $stmt->execute();
}

echo "✅ Sample roles and users inserted successfully.";

$conn->close();
?>
