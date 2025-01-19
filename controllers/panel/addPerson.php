<?php
/*
 * Copyright (c) 2025 Elijah Wood. All rights reserved.
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Proprietary and confidential.
 */
namespace HRDashboard\Controller\Panel;

class AddPerson {
	private $conn;

	public function __construct($connection) {
			$this->conn = $connection;
	}

	// Fetch column from table
	public function fetchDistinct($columnName) {
			$sql = "SELECT DISTINCT `$columnName` FROM identity";
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

// Gets the highest id from identity table
	public function getHighestEmployeeId() {
			$sql = "SELECT `Employee ID` FROM identity ORDER BY `Employee ID` DESC LIMIT 1";
			$result = $this->conn->query($sql);

			if ($result === false) {
					throw new \Exception("Error executing query: " . $this->conn->error);
			}

			$highestId = null;
			if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$highestId = $row['Employee ID']; 
			}

			return $highestId;
	}


	public function generateNextEmployeeId() {
			$highestId = $this->getHighestEmployeeId();
			if ($highestId) {
		// Adds highest id + 1 and adds 5 0's to left side of the number
					$nextNumber = str_pad($highestId + 1, 5, "0", STR_PAD_LEFT); 
					return $nextNumber; 
			} else {
					return "00001"; 
			}
	}

// Fetches data from $_POST then inserts into the database                                    
	public function addUser($title, $legalFirstName, $preferredFirstName, $legalMiddleName, $legalLastName, $preferredLastName, $gender, $ethnicity, $dob, $nin, $passportNumber, $religion, $department, $jobtitle, $contractPeriod, $startDate, $employmentType) {
			$employeeId = $this->generateNextEmployeeId();

			$sql = "INSERT INTO identity (`Employee ID`, `Title`, `Legal first name`, `Preferred first name`, `Legal middle names`, `Legal last name`, `Preferred last name`, `Sex`, `Ethnicity`, `Date of birth`, `National insurance number`, `Passport number`, `Religion`) 
							VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			// Prepare statement
			$stmt = $this->conn->prepare($sql);

			if ($stmt === false) {
					throw new \Exception("Error preparing the SQL query: " . $this->conn->error);
			}

			$stmt->bind_param("sssssssssssss", $employeeId, $title, $legalFirstName, $preferredFirstName, $legalMiddleName, $legalLastName, $preferredLastName, $gender, $ethnicity, $dob, $nin, $passportNumber, $religion);

			if (!$stmt->execute()) {
					throw new \Exception("Error executing the SQL query: " . $stmt->error);
			}

			$stmt->close();

			$sql2 = "INSERT INTO contract (`Employee ID`, `Employment type`, `Job title`, `Contract period`, `Start date`, `Department`) VALUES (?, ?, ?, ?, ?, ?)";

			$stmt2 = $this->conn->prepare($sql2);

			if ($stmt2 === false) {
					throw new \Exception("Error preparing SQL query: " . $this->conn->error);
			}

			$stmt2->bind_param("ssssss", $employeeId, $employmentType, $jobtitle, $contractPeriod, $startDate, $department);

			if (!$stmt2->execute()) {
					throw new \Exception("Eror executing the SQL query: " . $stmt2->error);
			}

			$stmt2->close();
	}
}
?>
