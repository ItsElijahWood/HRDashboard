<?php
/*
 * Copyright (c) 2025 Elijah Wood. All rights reserved.
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Proprietary and confidential.
 */
require_once(__DIR__ . '/../../include/database/hrdata.php');

$connConfig = new \HRDashboard\Include\ConnConfig;
$conn = $connConfig->getConnection();

// Gets ID param from URL 
if (isset($_GET['id'])) {
	$userId = htmlspecialchars($_GET['id']); 

	$userData = fetchUserDataById($conn, $userId); 

	if (!$userData) {
		echo "ID not found."; 
		exit;
	}
} else {
	echo "No ID provided."; 
	exit;
}

function fetchUserDataById($conn, $userId) {
		// Prepare the SQL query to fetch the employee data by Employee ID.
		$stmt = $conn->prepare("SELECT * FROM users WHERE `ID` = ?");
		if ($stmt === false) {
			die('MySQL Error: ' . $conn->error);
		}

		$stmt->bind_param("s", $userId); 

		$stmt->execute();

		$result = $stmt->get_result();

		$userData = $result->fetch_assoc();

		$stmt->close();

		return $userData;
}
?>
