<?php

$user = "root";
$pass = "";

$pdo = new PDO('mysql:host=localhost;dbname=test', $user, $pass);


?>

<!DOCTYPE html>
<html>
<head>
	<title>User registration</title>

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
<body>

	<h1>Registreer je in het formulier hieronder!</h1>
	<fieldset>
	<form action="signup.php" method="POST">
		<div class="container">
		<label>Voornaam:</label>	
		<input type="text" name="voornaam"><br>
		</div>

		<div class="container">
			<label>Tussenvoegsel:</label>
		<input type="text" name="tvl"><br>
		</div>

		<div class="container">
			<label>Achternaam:</label>
		<input type="text" name="achternaam"><br>
		</div>

		<div class="container">
			<label>Username:</label>
		<input type="text" name="uan"><br>
		</div>
		<div class="container">
			<label>Email:</label>
		<input type="text" name="mail"><br>
		</div>

		<div class="container">
			<label>Password:</label>
		<input type="password" name="pass"><br>
		</div>

		<div class="container">
			<label>Repeat Password:</label>
		<input type="password" name="passr"><br>
		</div>

		<div class="container">
			<button class="" name="sub">Submit</button>
		</div>
	</form>
	</fieldset>
</body>
</html>

<?php


	if(isset($_POST['sub'])){
		$voornaam = $_POST['voornaam'];
		$achternaam = $_POST['achternaam'];
		$tussenvoegsel = $_POST['tvl'];
		$username = $_POST['uan'];
		$mail = $_POST['mail'];
		$pass = $_POST['pass'];
		$passR = $_POST['passr'];

		$pattern = "/^[a-zA-Z0-9]*$/";

		if(empty($voornaam) || empty($tussenvoegsel) || empty($achternaam) || empty($username) || empty($mail) || empty($pass) empty($passR)){
			echo "please fill in empty lines";
		}elseif(preg_match($pattern = "/^[a-zA-Z0-9]*$/";, $username)) {
			echo "you cant use karakters other than 0-9 or a-z";
		}elseif($pass != $passR){
			echo "password is not similair";
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo "Invalid email format";
		}else{

			$sql = "SELECT * FROM gebruikers WHERE username = '".$username."' ";

			$stmt = $pdo->prepare($sql);
			if (!$stmt->execute()) {
				echo "SQL fail";
				exit();
			}
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(!empty($result)){
				echo "username already exists!";
			}else{
				$sqli = "INSERT INTO gebruikers(voornaam, tussenvoegsel, achternaam, email, username, password) VALUES ('".$voornaam."', ".$tussenvoegsel."', ".$achternaam."', ".$mail."', ".$username."', ".$pass."',";

				$stmt2 = $pdo->prepare($sqli);
				if(!$stmt2->execute()){
					echo "you're registration is completed, you get an activation mail in your inbox!";
				}
			}
		}

	}

?>