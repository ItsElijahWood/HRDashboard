<?php
/*
	* Copyright (c) 2025 Elijah Wood. All rights reserved.
	* Unauthorized copying of this file, via any medium, is strictly prohibited.
	* Proprietary and confidential.
	*/
namespace HRDashboard\Controller\Panel;

class AddUser {
	private $conn;

	public function __construct($connection) {
			$this->conn = $connection;
	}

	// Fetch distinct from users database
	public function fetchDistinct($columnName) {
			$sql = "SELECT DISTINCT `$columnName` FROM users";
			$result = $this->conn->query($sql);

			if ($result === false) {
					throw new \Exception("Error executing query: " . $this->conn->error);
			}

			$data = [];
			if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
							$data[] = $row[$columnName]; 
					}
			}
			return $data;
	}

	// Gets highest id from users database
	private function getHighestUserId() {
			$sql = "SELECT `ID` FROM users ORDER BY `ID` DESC LIMIT 1";
			$result = $this->conn->query($sql);

			if ($result === false) {
					throw new \Exception("Error executing query: " . $this->conn->error);
			}

			$highestId = null;
			if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$highestId = $row['ID']; 
			}

			return $highestId;
	}


	// Checks id from users database
	private function isIdExists($id) {
			$sql = "SELECT COUNT(*) FROM users WHERE ID = ?";
			$stmt = $this->conn->prepare($sql);
	
			if ($stmt === false) {
					throw new \Exception("Error preparing the SQL query: " . $this->conn->error);
			}
	
			$stmt->bind_param("s", $id);  
			$stmt->execute();

			$count = 0;
	
			$stmt->store_result();  
			$stmt->bind_result($count); 
			$stmt->fetch();
	
			$stmt->close();
	
			return $count > 0;  
	}
	
	// Generates the next id using str_pad
	private function generateNextUserId() {
			$highestId = $this->getHighestUserId();

			if ($highestId) {
					$number = (int)$highestId;
					$nextNumber = $number + 1;

					while ($this->isIdExists($nextNumber)) {
							$nextNumber++; 
					}

					return str_pad($nextNumber, 5, "0", STR_PAD_LEFT); 
			} else {
					return "00001"; 
			}
	}

	// Gets params from $_POST to insert into users database
	public function addUser($fullName, $passWord, $email, $accessLevel) {
			$hashedPassword = password_hash($passWord, PASSWORD_BCRYPT);
			$employeeId = $this->generateNextUserId();  

			$sql = "INSERT INTO users (`ID`, `Username`, `Password`, `Email`, `AccessLevel`) 
					VALUES (?, ?, ?, ?, ?)";

			$stmt = $this->conn->prepare($sql);

			if ($stmt === false) {
					throw new \Exception("Error preparing the SQL query: " . $this->conn->error);
			}

			$stmt->bind_param("sssss", $employeeId, $fullName, $hashedPassword, $email, $accessLevel);

			if (!$stmt->execute()) {
					throw new \Exception("Error executing the SQL query: " . $stmt->error);
			}

			$stmt->close();
	}
}
?>