
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="admin/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="visitor/css/main.css">
		<link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light  justify-content-between">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<a href="#"><img src="visitor/img/nav_logoman.svg"></a>
					<li class="nav-item"><a class="nav-link" href="visitor/players.php">Player</a></li>
					<li class="nav-item"><a class="nav-link" href="visitor/teams.php">Teams</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li ><a class="nav-link" href="admin/index.php"><i class="fa fa-bullseye admButton" aria-hidden="true"></i></a></li>
				</ul>
			</nav>
<?php
require('visitor/footer.php');

?>

