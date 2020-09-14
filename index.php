<?php

$user = "root";
$pass = "";

$pdo = new PDO('mysql:host=localhost;dbname=test', $user, $pass);

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
		<form id="fo" action="index.php" method="POST" &gt>
			<div class="container">
				<label>Username/ E-mail:</label>
				<label class="error"></label>
				<i class="fas fa-user-tie"></i><input type="text" name="uan" id="uan">
			</div>
			<div class="container">
				<label>Password:</label>
				<i class="fas fa-unlock-alt"></i><input type="password" name="pass" id="uan">
			</div>
			<div class="container">
				<button name="sub">Submit<i class="fas fa-sign-in-alt"></i></button>
			</div>
		</form>
	</fieldset>


<!-- main.js -->
	<script type="text/javascript" src="main.js"></script>

	<!-- JQEURY AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>

<?php

	if(isset($_POST['sub'])){

		$username = $_POST['uan'];
		$pass = $_POST['pass'];
		$pattern = "/^[a-zA-Z0-9]*$/";

		$sql = "SELECT DISTINCT username FROM gebruikers WHERE username = '".$username."' ";
		$stmt = $pdo->prepare($sql);
		if (!$stmt->execute()) {
			header("Location: index.php?error=SQLfail");
			exit();
		}
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if(empty($result)){
			echo "Welcome "."<p color='red'>".$username."</p>";
		}elseif(empty($username) || empty($pass)){
			header("Location: index.php?error=emptyfields");
		}elseif(!preg_match($pattern, $username)){
			header("Location: index.php?error=incorrectusername");
		}elseif(!$sql) {
			header("Location: index.php?error=usernamedoesntexist");
		}else{
				echo "<h1 font=26px>Welcome '".$username."'</h1>";
			
		}
	}


?>