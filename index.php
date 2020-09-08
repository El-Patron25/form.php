<?php

$user = "root";
$pass = "";

$pdo = new PDO('mysql:host=localhost;dbname=test', $user, $pass);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign in</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

</head>
<body>

	<fieldset>
		<form action="index.php" method="POST">
		
			<div>
				<label>Username/ E-mail:</label>
				<i class="fas fa-user-tie"></i><input type="text" name="uan">
			</div>

			<div>
				<label>Password:</label>
				<i class="fas fa-unlock-alt"></i><input type="text" name="pass">
			</div>

			<div>
				<button name="sub">Submit<i class="fas fa-sign-in-alt"></i></button>
			</div>
		</form>
	</fieldset>
</body>
</html>

<?php

	if(isset($_POST['sub'])){

		$username = $_POST['uan'];
		$pass = $_POST['pass'];
		$pattern = "/^[a-zA-Z0-9]*$/";

		$sql = "SELECT * FROM gebruikers WHERE '".$username."' > 0 ";
		$stmt = $pdo->prepare($sql);
		if (!$stmt->execute()) {
			header("Location: index.php?error=SQLfail");
			exit();
		}

		if(empty($username) || empty($pass)){
			header("Location: index.php?error=emptyfields");
		}elseif(preg_match($pattern, $username)){
			header("Location: index.php?error=incorrectusername");
		}elseif(!$sql) {
			header("Location: index.php?error=usernamedoesntexist");
		}
	}


?>