<?php
	require "connexion_api.php";

	$log_state = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (array_key_exists("email", $_POST) && array_key_exists("password", $_POST)) {
			$req = "SELECT user_token FROM MyToken WHERE
							id_us IN (SELECT id_u FROM MyUser WHERE
							email = '". addslashes($_POST["email"]) ."' AND
							password = '". /* md5($_POST["password"]) */ $_POST["password"] ."');";

			$result = $connexion->query($req);
			if ($result->num_rows == 1) {
				$ligne = $result->fetch_row();
				if (!setcookie("my_user_token", $ligne[0], time()+1800))
					die("<b>You have to accept the use of cookies</b>");
				$log_state = "Logged in successfully !";
			} else {
				$log_state = "Failed to log in !";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>HackMeHere - Login</title>
	<link rel="stylesheet" type="text/css" href="./index.css">
</head>
<body>
	<div class="root">

		<?php include("./header_nav.php"); ?>

		<main class="main">

			<div class="main-log">
				<form method="POST" action="login.php">
					<input type="email" name="email" placeholder="Your email">
					<input type="password" name="password" placeholder="Your password">

					<input type="submit" value="Login">

					<span
						class="main-log-result <?php echo ((empty($log_state)) ? "hidden" : ""); ?>"
					><?php echo $log_state; ?></span>
				</form>
			</div>

		</main>

	</div>
</body>
</html>
<?php
	$connexion->close();
?>