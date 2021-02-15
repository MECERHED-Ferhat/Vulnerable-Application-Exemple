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

$sql = "INSERT INTO MyUser (firstname, lastname, email,is_admin)
VALUES ('John', 'Doe', 'john@example.com',0);";
$sql .= "INSERT INTO MyUser (firstname, lastname, email,is_admin)
VALUES ('Mary', 'Moe', 'mary@example.com',1);";
$sql .= "INSERT INTO MyUser (firstname, lastname, email,is_admin)
VALUES ('Julie', 'Dooley', 'julie@example.com',0)";

//'News','Sport','Culture','Music','Météo','Futur','Technologie'

if ($conn->multi_query($sql) === TRUE) {
  echo "New records created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>