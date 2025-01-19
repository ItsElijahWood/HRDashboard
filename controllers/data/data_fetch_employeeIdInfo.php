<?php
/*
	* Copyright (c) 2025 Elijah Wood. All rights reserved.
	* Unauthorized copying of this file, via any medium, is strictly prohibited.
	* Proprietary and confidential.
	*/
require_once(__DIR__ . '/../../include/database/hrdata.php');

$connConfig = new \HRDashboard\Include\ConnConfig;
$conn = $connConfig->getConnection();

// Gets the employee id from the URL param
if (isset($_GET['id'])) {
	$employeeId = htmlspecialchars($_GET['id']); 

	$employeeData = fetchEmployeeDataById($conn, $employeeId); 

	if (!$employeeData) {
		echo "Employee not found."; 
		exit;
	}
} else {
	echo "No Employee ID provided."; 
	exit;
}

// Gets the $employeeId variable from $_GET param URL
function fetchEmployeeDataById($conn, $employeeId) {
		// Prepare the SQL query to fetch the employee data by Employee ID.
		$stmt = $conn->prepare("SELECT * FROM identity WHERE `Employee ID` = ?");
		if ($stmt === false) {
				die('MySQL Error: ' . $conn->error);
		}

		$stmt->bind_param("s", $employeeId); 

		$stmt->execute();

		$result = $stmt->get_result();

		$employeeData = $result->fetch_assoc();

		$stmt->close();

		return $employeeData;
}
?>
