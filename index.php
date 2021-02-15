<?php
	if (array_key_exists("to_send", $_GET) && is_numeric($_GET["to_send"])) {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "DBA";

		$connexion = new mysqli($servername, $username, $password, $dbname);

		if ($connexion->connect_error) {
			die("Server Error");
		}

		$req = "SELECT article_content FROM MyArticle WHERE id_a =". addslashes($_GET["to_send"]) . ";";
		$result = $connexion->query($req);
		$result = ($result->num_rows == 1) ? $result->fetch_row()[0] : "";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>HackMeHere - Send Email</title>
	<link rel="stylesheet" type="text/css" href="./index.css">
</head>
<body>
	<div class="root">

		<?php include("./header_nav.php"); ?>

		<main class="main">

			<div class="main-email">
				<label for="dest">Destination</label>
				<input type="email" name="dest">

				<label for="object">Object</label>
				<input type="text" name="object">

				<label for="subject"></label>
				<textarea name="subject"><?php
					echo $result;
				?></textarea>
			</div>

		</main>
	</div>


</body>
</html>
