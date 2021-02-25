<?php
	require "connexion_api.php";

	$admin_form = NULL;
	$is_admin = false;
	$content = "";

	if (array_key_exists("to_send", $_GET) && is_numeric($_GET["to_send"])) {
		$req = "SELECT article_content FROM MyArticle WHERE id_a =". addslashes($_GET["to_send"]) . ";";
		$result = $connexion->query($req);
		$content = ($result->num_rows == 1) ? htmlspecialchars($result->fetch_row()[0]) : "";
	}
	if (array_key_exists("admin_form", $_GET) && $_GET["admin_form"] != "")
		$admin_form = $_GET["admin_form"];

	if (isset($_COOKIE["my_user_token"]) && $_COOKIE["my_user_token"] != "") {
		$req = "SELECT is_admin FROM MyUser WHERE id_u IN (SELECT id_us FROM MyToken WHERE user_token = '". $_COOKIE["my_user_token"] ."');";
		$admin_value = $connexion->query($req);
		if ($admin_value->num_rows == 1)
			$is_admin = ($admin_value->fetch_row()[0] == 1);
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
			<?php
				if ($is_admin && $admin_form) {
					include $admin_form;
				} else {
					if ($is_admin) echo "<button class='main-email-admin'><a href='index.php?admin_form=admin_email.php'>Admin Form</a></button>";
					
					echo "
			<form method='POST' action='' class='main-email'>
				<label for='dest'>Destination</label>
				<input type='email' name='dest'>

				<label for='object'>Object</label>
				<input type='text' name='object'>

				<label for='subject'></label>
				<textarea name='subject'>". $content ."</textarea>

				<input class='main-email-submit' type='submit' value='Send'>
			</form>
					";
				}
			?>
		</main>
	</div>

</body>
</html>
<?php
	$connexion->close();
?>
