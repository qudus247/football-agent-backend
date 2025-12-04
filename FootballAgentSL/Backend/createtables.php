<?php
include 'db.php';

$sql_roles = "CREATE TABLE IF NOT EXISTS roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) UNIQUE NOT NULL,
  description TEXT
)";

$sql_users = "CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role_id INT NOT NULL,
  phone VARCHAR(20),
  country VARCHAR(50),
  profile TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (role_id) REFERENCES roles(id)
)";

if ($conn->query($sql_roles) === TRUE && $conn->query($sql_users) === TRUE) {
  echo "✅ Tables created successfully.";
} else {
  echo "Error creating tables: " . $conn->error;
}

$conn->close();
?>
