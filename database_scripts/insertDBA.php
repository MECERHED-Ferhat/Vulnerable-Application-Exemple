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

$WEAK_PASSWORD_QUALITY = 4;

$firstnames = array(
	"john",
	"Mary",
	"Julie",
	"Danika",
	"Savanna",
	"Erin",
	"Taylor",
	"Abbie",
	"Zaria",
	"Mary",
	"Tatum",
	"Mckayla",
	"Rafael",
	"Kamora",
	"Devin",
	"Aracely",
	"Darian",
	"Jesus",
	"Titus",
	"Trevon",
	"Adonis",
	"Kamora",
	"Deja",
	"Aliyah",
	"Karsyn",
	"Destinee",
	"Alice",
	"Kira",
	"Mckayla",
	"Cloe",
	"Shawn",
	"Ashly",
	"Kylee",
);
$lastnames = array(
	"Doe",
	"Moe",
	"Dooley",
	"Martin",
	"Hahn",
	"Nixon",
	"Cooke",
	"Paul",
	"Vance",
	"Eaton",
	"Ibarra",
	"Richard",
	"Shepard",
	"Rice",
	"Leonard",
	"Schroeder",
	"Deleon",
	"Newman",
	"Donovan",
	"Mcguire",
	"Schmitt",
	"Herman",
	"Keller",
	"Alvarado",
	"Kennedy",
	"Sellers",
	"Rivers",
	"Gould",
	"Jimenez",
	"Patton",
	"Peters",
	"Garrison",
	"Bernard",
);
$emails = array(
	"john@example.com",
	"mary@example.com",
	"julie@example.com",
	"Danika@example.com",
	"Savanna@example.com",
	"Erin@example.com",
	"Taylor@example.com",
	"Abbie@example.com",
	"Zaria@example.com",
	"Mary@example.com",
	"Tatum@example.com",
	"Mckayla@example.com",
	"Rafael@example.com",
	"Kamora@example.com",
	"Devin@example.com",
	"Aracely@example.com",
	"Darian@example.com",
	"Jesus@example.com",
	"Titus@example.com",
	"Trevon@example.com",
	"Adonis@example.com",
	"Kamora@example.com",
	"Deja@example.com",
	"Aliyah@example.com",
	"Karsyn@example.com",
	"Destinee@example.com",
	"Alice@example.com",
	"Kira@example.com",
	"Mckayla@example.com",
	"Cloe@example.com",
	"Shawn@example.com",
	"Ashly@example.com",
	"Kylee@example.com",
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
		$pass = generateRandomString($WEAK_PASSWORD_QUALITY);
		$pass_quality = "Weak";
	} else {
		$pass = generateRandomString(rand(4, 10));
		if (strlen($pass) > 7)
			$pass_quality = "Strong";
		elseif (strlen($pass) > $WEAK_PASSWORD_QUALITY)
			$pass_quality = "Medium";
		else
			$pass_quality = "Weak";
	}
	$pass = md5($pass);

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
$contents = array(
	"Manchester City extended their winning run to 15 games and their lead at the top of the Premier League to seven points as they easily defeated Tottenham at Etihad Stadium.",
	"From The Equalizer to Snowfall and the return of The Family Man, Eddie Mullan picks the programmes worth seeing this month.",
	"Trump impeachment trial: What verdict means for Trump, Biden and America",
	"You have every right to be angry, but that doesn't give you the right to be mean.",
	"The body piercing didn't go exactly as he expected.",
	"It's not possible to convince a monkey to give you a banana by promising it infinite bananas when they die.",
	"She was too short to see over the fence.",
	"She looked into the mirror and saw another person.",
	"As he looked out the window, he saw a clown walk by.",
	"Jeanne wished she has chosen the red button.",
	"Dolores wouldn't have eaten the meal if she had known what it actually was.",
	"Flying fish few by the space station.",
	"I caught my squirrel rustling through my gym bag.",
	"The light in his life was actually a fire burning all around him.",
	"She could hear him in the shower singing with a joy she hoped he'd retain after she delivered the news.",
	"Mothers spend months of their lives waiting on their children.",
	"It was getting dark, and we weren’t there yet.",
	"His thought process was on so many levels that he gave himself a phobia of heights.",
	"Gary didn't understand why Doug went upstairs to get one dollar bills when he invited him to go cow tipping.",
	"I’m working on a sweet potato farm.",
	"The tortoise jumped into the lake with dreams of becoming a sea turtle.",
	"Art doesn't have to be intentional.",
	"It was at that moment that he learned there are certain parts of the body that you should never Nair.",
	"There are few things better in life than a slice of pie.",
	"I hear that Nancy is very pretty.",
	"No matter how beautiful the sunset, it saddened her knowing she was one day older.",
	"She wrote him a long letter, but he didn't read it.",
	"He colored deep space a soft yellow.",
	"The efficiency we have at removing trash has made creating trash more acceptable.",
	"Greetings from the galaxy MACS0647-JD, or what we call home.",
	"We will not allow you to bring your pet armadillo along.",
	"He played the game as if his life depended on it and the truth was that it did.",
	"Thirty years later, she still thought it was okay to put the toilet paper roll under rather than over.",
);
$dates = array(
	"2021-02-10",
	"2021-02-11",
	"2021-02-12",
	"2021-08-21",
	"2021-05-06",
	"2021-09-23",
	"2021-02-05",
	"2021-07-14",
	"2021-03-23",
	"2021-02-14",
	"2021-11-22",
	"2021-10-15",
	"2021-01-14",
	"2021-04-10",
	"2021-01-16",
	"2021-12-25",
	"2021-12-02",
	"2021-03-05",
	"2021-11-23",
	"2021-05-16",
	"2021-04-10",
	"2021-12-07",
	"2021-01-25",
	"2021-12-31",
	"2021-10-15",
	"2021-06-17",
	"2021-01-14",
	"2021-08-07",
	"2021-08-17",
	"2021-01-03",
	"2021-05-31",
	"2021-01-28",
	"2021-12-30",
);

for ($i=0; $i < count($emails); $i++) {
	$connexion->next_result();
	$sql = "INSERT INTO MyArticle (auteur, article_type, article_content, id_us, article_date)
					VALUES ('". $firstnames[$i]." ".$lastnames[$i] ."','". $types[rand(0, count($types)-1)] ."', '". addslashes($contents[$i]) ."', ". $i .",'". $dates[$i] ."');";
	if ($connexion->query($sql) === TRUE) {
		echo "New article created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $connexion->error;
	}
}

$connexion->close();
?>