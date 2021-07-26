<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/css/jokes.css">
		<title><?=$title?></title>
	</head>
	<body>
	<nav>
		<header>
			<h1>PHP STUDY</h1>
		</header>
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="/joke/list">LIST</a></li>
			<li><a href="/joke/edit">ADD</a></li>
			<?php if ($loggedIn): ?>
			<li><a href="/logout">LOG OUT</a></li>
			<?php else: ?>
			<li><a href="/login">LOGIN</a></li>
			<?php endif; ?>
		</ul>
	</nav>

	<main>
	<?=$output?>
	</main>

	<footer>
	&copy; IJDB 2017
	</footer>
	</body>
</html>