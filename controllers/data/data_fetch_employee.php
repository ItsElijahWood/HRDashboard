<?php
/*
 * Copyright (c) 2025 Elijah Wood. All rights reserved.
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Proprietary and confidential.
 */
include_once(__DIR__ . '/../../include/database/hrdata.php');

$connConfig = new \HRDashboard\Include\ConnConfig;
$conn = $connConfig->getConnection();

function fetchEmployeeData($conn, $tableName = 'identity') {
	$sql = "SELECT * FROM $tableName"; 
	
	// Execute the query into the $conn.
	$result = $conn->query($sql);

	// If more than 0 rows found loop through data column,
	// and put the data inside $data array.
	if ($result->num_rows > 0) {
		$data = [];
		while ($row = $result->fetch_assoc()) {
				$data[] = $row;
		}

		return $data;
	} else {
		return [];
	}
}
?>
