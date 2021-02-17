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

$sql = "INSERT INTO MyArticle ( auteur, article_type,article_title,article_content,id_us,article_date)
VALUES ('John Doe','Sport','sportNews', 'Manchester City extended their winning run to 15 games and their lead at the top of the Premier League to seven points as they easily defeated Tottenham at Etihad Stadium.',3,'2021-02-10');";

$sql .= "INSERT INTO MyArticle ( auteur, article_type,article_title,article_content,id_us,article_date)
VALUES ('Jo Do','Culture','CultureNews', 'From The Equalizer to Snowfall and the return of The Family Man, Eddie Mullan picks the programmes worth seeing this month.',1,'2021-02-11');";

$sql .= "INSERT INTO MyArticle ( auteur, article_type,article_title,article_content,id_us,article_date)
VALUES ('Jino Daio','News','MOndeNews', 'Trump impeachment trial: What verdict means for Trump, Biden and America',2,'2021-02-12');";

if ($conn->multi_query($sql) === TRUE) {
  echo "New records created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>