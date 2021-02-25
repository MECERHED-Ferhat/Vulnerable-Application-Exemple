<?php
// Create connection
require "../connexion_api.php";

// Check connection
if ($connexion->connect_error) {
  die("Connection failed: " . $connexion->connect_error);
}

// sql to create table
$sql = "CREATE TABLE MyUser (
id_u INT(6) UNSIGNED PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
is_admin INT(1) NOT NULL,
email VARCHAR(50),
password VARCHAR(60),
password_quality VARCHAR(20),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($connexion->query($sql) === TRUE) {
  echo "Table User created successfully";
} else {
  echo "Error creating table: " . $connexion->error;
}

$connexion->close();
?>