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

// Create connection
require "../connexion_api.php";

// Check connection
if ($connexion->connect_error) {
	die("Connection failed: " . $connexion->connect_error);
}

$sql = "DELETE FROM MyUser;";
$sql .= "DELETE FROM MyToken";
$sql .= "DELETE FROM MyArticle";

if ($connexion->multi_query($sql) === TRUE) {
	echo "Tables clear<br>";
} else {
	echo "Error: " . $sql . "<br>" . $connexion->error;
}

$firstnames = array(
	"john",
	"Mary",
	"Julie"
);
$lastnames = array(
	"Doe",
	"Moe",
	"Dooley"
);
$emails = array(
	"john@example.com",
	"mary@example.com",
	"julie@example.com"
);


for ($i=0; $i < count($emails); $i++) {
	$connexion->next_result();
	$admin = 0;
	$pass = "";
	$pass_quality = "";

	if ($i == (int)(count($emails)/2)) {
		$admin = 1;
		$pass = generateRandomString(12);
		$pass_quality = "Strong";
	} elseif ($i == count($emails)-1) {
		$pass = generateRandomString(4);
		$pass_quality = "Weak";
	} else {
		$pass = generateRandomString(rand(4, 10));
		if (strlen($pass) > 7)
			$pass_quality = "Strong";
		elseif (strlen($pass) > 4)
			$pass_quality = "Medium";
		else
			$pass_quality = "Weak";
	}
	// $pass = md5($pass);

	$sql = "INSERT INTO MyUser (id_u, firstname, lastname, email, password, password_quality, is_admin)
					 VALUES (". $i .", '". $firstnames[$i] ."', '". $lastnames[$i] ."', '". $emails[$i] ."', '". $pass ."', '". $pass_quality."', ". $admin .");";
	if ($connexion->query($sql) === TRUE) {
		echo "New user created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $connexion->error;
	}

	$connexion->next_result();
	$sql = "INSERT INTO MyToken (id_us, user_token)
					VALUES (". $i .", '". generateRandomString(10) ."');";
	if ($connexion->query($sql) === TRUE) {
		echo "New token created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $connexion->error;
	}
}

$types = array("News", "Sport", "Culture", "Music", "Météo", "Futur", "Technologie");
$contents = array("Manchester City extended their winning run to 15 games and their lead at the top of the Premier League to seven points as they easily defeated Tottenham at Etihad Stadium.", "From The Equalizer to Snowfall and the return of The Family Man, Eddie Mullan picks the programmes worth seeing this month.", "Trump impeachment trial: What verdict means for Trump, Biden and America");
$dates = array("2021-02-10", "2021-02-11", "2021-02-12");

for ($i=0; $i < count($emails); $i++) {
	$connexion->next_result();
	$sql = "INSERT INTO MyArticle (auteur, article_type, article_content, id_us, article_date)
					VALUES ('". $firstnames[$i]." ".$lastnames[$i] ."','". $types[$i] ."', '". $contents[$i] ."', ". $i .",'". $dates[$i] ."');";
	if ($connexion->query($sql) === TRUE) {
		echo "New article created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $connexion->error;
	}
}

$connexion->close();
?>