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
$pass = "pass";
$pasHach = md5($pass);
$sql = "INSERT INTO User (firstname, lastname, email,is_admin,password,pass_quality)
VALUES ('John', 'Doe', 'john@example.com',0,'$pasHach','medioum');";
$sql .= "INSERT INTO User (firstname, lastname, email,is_admin,password,pass_quality)
VALUES ('Mary', 'Moe', 'mary@example.com',1,'$pasHach','Strong');";
$sql .= "INSERT INTO User (firstname, lastname, email,is_admin,password,pass_quality)
VALUES ('Julie', 'Dooley', 'julie@example.com',0,'$pasHach','medioum')";

//'News','Sport','Culture','Music','Météo','Futur','Technologie'

if ($conn->multi_query($sql) === TRUE) {
  echo "New records created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>