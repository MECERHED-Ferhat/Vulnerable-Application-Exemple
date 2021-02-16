<?php
function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

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

$sql = "DELETE FROM MyUser;";
$sql .= "DELETE FROM MyToken";
$sql .= "DELETE FROM MyArticle";

if ($conn->multi_query($sql) === TRUE) {
	echo "Tables clear<br>";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$firstnames = array("john", "Mary", "Julie");
$lastnames = array("Doe", "Moe", "Dooley");
$emails = array("john@example.com", "mary@example.com", "julie@example.com");

for ($i=0; $i < count($emails); $i++) {
	$conn->next_result();
	$sql = "INSERT INTO MyUser (id_u, firstname, lastname, email, is_admin)
					 VALUES (". $i .", '". $firstnames[$i] ."', '". $lastnames[$i] ."', '". $emails[$i] ."', 0);";
	if ($conn->query($sql) === TRUE) {
		echo "New user created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->next_result();
	$sql = "INSERT INTO MyToken (id_us, user_token)
					VALUES (". $i .", '". generateRandomString(10) ."');";
	if ($conn->query($sql) === TRUE) {
		echo "New token created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$types = array("News", "Sport", "Culture", "Music", "Météo", "Futur", "Technologie");
$contents = array("Manchester City extended their winning run to 15 games and their lead at the top of the Premier League to seven points as they easily defeated Tottenham at Etihad Stadium.", "From The Equalizer to Snowfall and the return of The Family Man, Eddie Mullan picks the programmes worth seeing this month.", "Trump impeachment trial: What verdict means for Trump, Biden and America");
$dates = array("2021-02-10", "2021-02-11", "2021-02-12");

for ($i=0; $i < count($emails); $i++) {
	$conn->next_result();
	$sql = "INSERT INTO MyArticle (auteur, article_type, article_content, id_us, article_date)
					VALUES ('". $firstnames[$i]." ".$lastnames[$i] ."','". $types[$i] ."', '". $contents[$i] ."', ". $i .",'". $dates[$i] ."');";
	if ($conn->query($sql) === TRUE) {
		echo "New article created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}



$conn->close();
?>