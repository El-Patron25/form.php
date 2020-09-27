<?php

require "includes/autoloader.inc.php";

$component = new Components();
$connect = new dbconnection();



	$createdb = $connect->createDb("project1");
	// $connect->query("SELECT * FROM persoon");
	// $connect->createTable("persoon");


// $connect->query("SELECT Table FROM DATABASE");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign in</title>

	<!-- main.css -->
	<link rel="stylesheet" type="text/css" href="main.css">

	<!-- Jqeury -->
	<script
  	src="https://code.jquery.com/jquery-3.5.1.js"
  	integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  	crossorigin="anonymous"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

</head>
<body id="background">
	<h1 id="h1">Sign in!</h1>
		<fieldset id="form">
			<form id="fo" action="index.php" method="GET" &gt>
				<?php $component->inputElement("Username/ E-mail:", "<i class='fas fa-user-tie'></i>", "text", "uan", "uan"); ?>
				<?php $component->inputElement("Password:", "<i class='fas fa-unlock-alt'></i>", "password", "pass", "pass"); ?>
				<div class="container">
				<?php $component->buttonElement("btn-login", "sub-login", "<i class='fas fa-sign-in-alt'></i>", "Submit") ?>
				</div>
			</form>
		</fieldset>
<!-- main.js -->
<!-- 	<script type="text/javascript" src="main.js"></script> -->

	<!-- JQEURY AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>
<?php
	$connect->loginUser($_GET['sub-login'], $_GET['uan'], $_GET['pass']);
?>