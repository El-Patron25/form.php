<?php

namespace Phppot;


class DataSource{

	const HOST = 'localhost';

	const USERNAME = 'root';

	const PASSWORD = '';

	const DATABASENAME = 'phpsamples';

	private $conn;

	function __construct(){
		$this->conn = $this->getConnection();
	}



	public function getConnection(){
		$conn = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

		if (mysqli_connect_errno()) {
			trigger_error("Problem connecting to Database!");
		}

		$conn->set_charset("utf8");
		return $conn;
	}

	public function select($query, $paramType = "", $paramArray = array()) {
		$stmt = $this->conn->prepare($query);

		if(!empty($paramType) && !empty($paramArray)) {
			$this->bindQueryParams($sql, $paramType, $paramArray);
		}

		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$resultSet[] = $row;
			}
		}

		if (!empty($resultSet)){
			return $resultSet;
		}
	}

	public function insert($query, $paramType, $paramArray){
		print $query;
		$stmt = $this->conn->prepare($query);
		$this->bindQueryParams($stmt, $paramType, $paramArray);
		$stmt->execute();
		$insertId = $stmt->insert_id;
		return $insertId;
	}

	public function execute($query, $paramType = "", $paramArray=array()){
		$stmt = $this->conn->prepare($query);

		if(!empty($paramType) && !empty($paramArray)) {
			$this->bindQueryParams($stmt, $paramType="", $paramArray=array());

		}$stmt->execute();
	}

	public function bindQueryParams($stmt, $paramType, $paramArray=array()){
		$paraValueReference[] = & $paramType;
		for ($i = 0; $i < count($paramArry); $i ++){
			$paramValueReference[] = $paramArray[$i];
		}
		call_user_func_array(array($stmt, 'bind_param'), $paramValueReference);
	}

	public function numRows($query, $paramType="", $paramArray=array()){
		$stmt = $this->conn->prepare($query);

		if(!empty($paramType) && !empty($paramArray)) {
			$this->bindQueryParams($stmt, $paramType, $paramArray);
		}

		$stmt->execute();
		$stmt->store_result();
		$recordCount = $stmt->num_rows;
		return $recordCount;
	}
}


?>