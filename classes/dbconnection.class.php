<?php

class dbConnection extends components{
	
	// properties
	private $host;
	private $user;
	private $pass;
	private $database;
	private $conn;

	public function __construct() {
		$this->host = "localhost";
		$this->user = "root";
		$this->pass = "";

		$this->conn = new PDO("mysql:host=localhost;", $this->user, $this->pass,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
	);
	}

	public function createDb($database){
		$this->conn = new PDO("mysql:host=".$this->host.";", $this->user, $this->pass);
		$sql = "CREATE DATABASE IF NOT EXISTS `".$database."` ";
		$stmt = $this->conn->prepare($sql);

		if(!$stmt->execute()){
			$this->textValue("error", "Sql connection error with database");
			exit();
		}

		if($sql >=1){
			textValue("error", "Database already exists");
		}

	}

	public function createTable($table) {
		$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->database.";", $this->user, $this->pass);
		$sql = "CREATE TABLE `".$table."`(
		id INT NOT NULL AUTO_INCREMENT,
		voornaam VARCHAR(250) NOT NULL,
		tussenvoegsel VARCHAR(250),
		achternaam VARCHAR(250) NOT NULL,
		account_id INT NOT NULL,
		PRIMARY KEY (id),
		FOREIGN KEY (account_id) REFERENCES account(id) 
	);";

	$sqli = "SELECT id from `persoon` LIMIT 1";

	$stmt = $this->conn->prepare($sqli);
	if($stmt->execute() !== FALSE){
		$this->textValue("error", "Table already exists");
		// exit();
	}else{
		$this->textValue("success", "Table succesfully imported in database!");
	}
	}

	function loginUser($button, $username, $pass) {
		if(isset($button)){
		$username = $username;
		$pass = $pass;
		$pattern = "/^[a-zA-Z0-9]*$/";

		$sql = "SELECT gebruikersnaam FROM account WHERE gebruikersnaam = `".$username."` ";
		$stmt = $this->conn->prepare($sql);
		if (!$stmt->execute()) {
			$this->textValue("error", "SQL fail");
			exit();
		}
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if(empty($result)){
			$this->textValue("success", "Welcome "."<p color='red'>".$username."</p>");
		}elseif(empty($username) || empty($pass)){
			$this->textValue("error", "Please fill in all the fields");
		}elseif(!preg_match($pattern, $username)){
			$this->textValue("error", "Incorrect username");
		}elseif(!$sql) {
			$this->textValue("error", "Username does not exists");
		}else{
				$this->textValue("success", "Welcome "."<p color='red'>".$username."</p>");
			
		}
	}
	}

	// function query($sql) {

	// 	$stmt = $this->conn->prepare($sql);
	// 	if(!$stmt->execute()){
	// 		$this->textValue("error", "Database connection fail, or query fail.");
	// 		// exit();
	// 	}
	// }

}


?>