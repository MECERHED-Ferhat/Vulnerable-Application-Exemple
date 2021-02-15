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


$sql = "CREATE TABLE MyArticle (
id_a INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
auteur VARCHAR(30) NOT NULL,
article_type VARCHAR(30) NOT NULL,
article_content TEXT,
id_us INT(6) UNSIGNED,
article_date date,
constraint ck_article_type check (article_type in ('News','Sport','Culture','Music','Météo','Futur','Technologie')),
constraint fk_id_U foreign key (id_us) references MyUser(id_u) on delete cascade )";

if ($conn->query($sql) === TRUE) {
  echo "Table MyArticle created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>