<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (array_key_exists("file_join", $_FILES)) {
			$destination = "users_document/" . basename($_FILES["file_join"]["name"]);
			if ($_FILES["file_join"]["type"] != "text/plain") {
				echo "Only .txt files are accepted";
			} elseif (!move_uploaded_file($_FILES["file_join"]["tmp_name"], $destination)) {
				echo "File not uploaded";
			} else {
				echo "File uploaded to /users_document";
			}
		}
	}
?>
<h2>Special email</h2>
<form action="" enctype="multipart/form-data" method="POST" class="main-email">
	<label for="dest">Destination</label>
	<input type="email" name="dest">

	<label for="object">Object</label>
	<input type="text" name="object">

	<label for="subject"></label>
	<textarea name="subject"><?php
		echo $content;
	?></textarea>

	<div class="main-email-btns">
		<input type="file" name="file_join" accept="text/plain">
		
		<input type="submit" value="Send">
	</div>
</form>