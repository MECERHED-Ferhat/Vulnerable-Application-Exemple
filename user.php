<?php
	require "connexion_api.php";

	$filtre = addslashes((array_key_exists("user_filter", $_GET)) ? $_GET["user_filter"] : "");
	$error = NULL;
	$users = NULL;
	
	if (strpos($filtre, "'") || strpos($filtre, ";"))
		$error = "There was an error in your SQL command, check line 0";
	else {
		$req = "SELECT * FROM MyUser WHERE
						firstname LIKE '%". $filtre ."%' OR
						lastname LIKE '%". $filtre ."%' OR
						email LIKE '%". $filtre ."%';";
		$users = $connexion->query($req);
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
			<div class="main-user">
				<h2 class="main-user-header">Users in database</h2>
				<div class='user-list'>
				<?php
				if (!is_null($error)) {
					echo "<div class='user-msg'>" . $error . "</div>";
				} elseif (!is_null($users) && $users->num_rows > 0) {
					while (($ligne = $users->fetch_assoc()) != false) {
						echo "
					<div class='user-list-row'>
						<span class='user-row-name'>". $ligne['firstname'] . " ". $ligne['lastname'] ."</span>
						<span class='user-row-email'>". $ligne['email'] ."</span>
						<span class='user-row-date'>Joined the ". $ligne['reg_date'] ."</span>
					</div>
						";
					}
				} else {
					echo "<div class='user-msg'>No result</div>";
				}
				?>
				</div>

				<form class="user-form" action="" method="GET">
					<input type="text" name="user_filter" placeholder="Filter user...">

					<input type="submit" value="Filter">
				</form>
			</div>
		</main>
	</div>

</body>
</html>