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
				<form method="POST" action=".">
					<input type="text" name="username">
					<input type="password" name="password">

					<input type="submit" value="Login">

					<span class="main-log-result">Success !</span>
				</form>
			</div>

		</main>

	</div>
</body>
</html>