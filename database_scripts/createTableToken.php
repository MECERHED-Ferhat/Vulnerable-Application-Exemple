<?php

// Create connection
require "../connexion_api.php";

// Check connection
if ($connexion->connect_error) {
  die("Connection failed: " . $connexion->connect_error);
}


$sql = "CREATE TABLE MyToken (
id_t INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_us INT(6) UNSIGNED,
user_token VARCHAR(10) NOT NULL,
constraint fk_user_token foreign key (id_us) references MyUser(id_u) on delete cascade )";

if ($connexion->query($sql) === TRUE) {
  echo "Table MyToken created successfully";
} else {
  echo "Error creating table: " . $connexion->error;
}

$connexion->close();
?>