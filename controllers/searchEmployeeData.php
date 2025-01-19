<?php
/*
* Copyright (c) 2025 Elijah Wood. All rights reserved.
* Unauthorized copying of this file, via any medium, is strictly prohibited.
* Proprietary and confidential.
*/
include(__DIR__ . '/../include/renderEmployeeDivs.php');
include(__DIR__ . '/./data_fetch_employee.php');

$query = isset($_GET['query']) ? $_GET['query'] : ''; 

// Gets searchQuery from URL param and searches from the query 
function searchEmployeeData($conn, $tableName = 'identity', $searchQuery = '') {
	$sql = "SELECT * FROM $tableName WHERE CONCAT_WS(' ', `Full Name`, `Job Title`, `Department`) LIKE '%$searchQuery%'";

	$result = $conn->query($sql);

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

$employeeData = searchEmployeeData($conn, 'identity', $query);

renderDivs($employeeData, ['Full Name', 'Job Title', 'Department']);
?>
