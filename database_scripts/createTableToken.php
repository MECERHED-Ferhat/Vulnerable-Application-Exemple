<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DBA";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE TABLE MyToken (
id_t INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_us INT(6) UNSIGNED,
user_token VARCHAR(10) NOT NULL,
constraint fk_user_token foreign key (id_us) references MyUser(id_u) on delete cascade )";

if ($conn->query($sql) === TRUE) {
  echo "Table MyToken created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>