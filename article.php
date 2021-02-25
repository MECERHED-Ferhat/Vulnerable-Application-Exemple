<?php
	require "connexion_api.php";

	$author = addslashes((array_key_exists("auteur", $_GET)) ? $_GET["auteur"] : "");
	$type = (array_key_exists("type", $_GET) && $_GET["type"] != "--Type--") ? $_GET["type"] : "";
	$content = addslashes((array_key_exists("content", $_GET)) ? $_GET["content"] : "");

	$req = "
		SELECT * FROM MyArticle WHERE (auteur LIKE '%". $author ."%') AND (article_type LIKE '%". $type ."%') AND (article_content LIKE '%". $content ."%');
	";
	$articles = $connexion->query($req);
?>
<!DOCTYPE html>
<html>
<head>
	<title>HackMeHere - Articles</title>
	<link rel="stylesheet" type="text/css" href="./index.css">
</head>
<body>
	<div class="root">

		<?php include("./header_nav.php"); ?>

		<main class="main">
			<div class="main-article">
				<h2 class="main-article-header">Articles to send</h2>
				<div class="article-list">
					<?php
					if ($articles->num_rows > 0)
						while (($ligne = $articles->fetch_row()) != false) {
							echo "
					<div class='article-art'>
						<div class='article-art-type'>Type article: ". $ligne[2] ."</div>
						<div class='article-art-head'>
							<span>". $ligne[1] ."</span>
							<span> - </span>
							<span>". $ligne[5] ."</span>
						</div>
						<div class='article-art-content'>". htmlspecialchars($ligne[3])."</div>
						<div class='article-art-btn'>
							<button><a href='index.php?to_send=". $ligne[0] ."'>Send</a></button>
						</div>
					</div>
							";
						}
					$articles->close();
					$connexion->close();
					?>
				</div>
			</div>

			<div class="filter-btn">
				<hr>
				<button>Filter</button>
			</div>
			<form action="article.php" method="GET" class="main-filter hidden">
				<input type="text" name="auteur" placeholder="Author">
				<select name="type">
					<option>--Type--</option>
					<option>News</option>
					<option>Sport</option>
					<option>Culture</option>
					<option>Music</option>
					<option>Météo</option>
					<option>Futur</option>
					<option>Technologie</option>
				</select>
				<input type="text" name="content" placeholder="Content">
				<input type="submit" value="Search">
			</form>
		</main>

	</div>

	<script type="text/javascript">
		filter_btn = document.querySelector(".filter-btn > button");
		filter_box = document.querySelector(".main-filter");

		filter_btn.addEventListener("click", () => {
			filter_box.classList.toggle("hidden");
		});
	</script>
</body>
</html>