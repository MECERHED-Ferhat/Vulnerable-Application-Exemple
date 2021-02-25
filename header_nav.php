<?php
	$name = "Guest";
	if (isset($_COOKIE["my_user_token"]) && $_COOKIE["my_user_token"] != "") {
		
		$req = "SELECT firstname, lastname FROM MyUser WHERE id_u IN (SELECT id_us FROM MyToken WHERE user_token = '". $_COOKIE["my_user_token"] ."');";
		$result = $connexion->query($req);

		if ($result->num_rows == 1) {
			$ligne = $result->fetch_assoc();
			$name = $ligne["firstname"] . " " . $ligne["lastname"];
		}
	}
?>
<header class="head">
	<div class="head-label">HackMeHere</div>
	<div class="head-status">As <?php echo $name; ?></div>
</header>

<nav class="nav">
	<a href="index.php" class="nav-email">Send an email</a>
	<a href="user.php" class="nav-user">Users in DB</a>
	<a href="article.php" class="nav-article">Articles to send</a>
	<a href="login.php" class="nav-log">Login</a>
</nav>