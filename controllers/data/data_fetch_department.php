<?php
/*
* Copyright (c) 2025 Elijah Wood. All rights reserved.
* Unauthorized copying of this file, via any medium, is strictly prohibited.
* Proprietary and confidential.
*/
require_once(__DIR__ . '/../../include/database/hrdata.php');
$connConfig = new \HRDashboard\Include\ConnConfig;
$conn = $connConfig->getConnection();

// Fetch data from params and trims the data to select the $columnNameDT
function fetchDepartmentData($conn, $columnNameDT, $tableName = 'contract') {
	$columnNameDT = trim($columnNameDT);

	$sql = "SELECT $columnNameDT FROM $tableName";
	$result = $conn->query($sql);

	if ($result && $result->num_rows > 0) {
		$departmentData = [];
		while ($row = $result->fetch_assoc()) {
			$departmentData[] = $row[$columnNameDT];
		}
		
		return $departmentData;
	} else {
		return [];
	}
}

// Calculate percentage of each department.
function calculateDepartmentPercentages($departmentData) {
	$totalCount = count($departmentData);
	
	$departmentData = array_filter($departmentData, function($value) {
			return is_string($value) || is_int($value);
	});

	$departmentCounts = array_count_values($departmentData);
	$departmentPercentages = [];

	foreach ($departmentCounts as $department => $count) {
		if (empty($department) || !is_string($department)) {
			continue;
		}

		$percentage = ($count / $totalCount) * 100;
		$departmentPercentages[$department] = round($percentage, 2);
	}

	return $departmentPercentages;
}


$columnNameDT = 'Department'; 
$departmentData = fetchDepartmentData($conn, $columnNameDT);

if (!empty($departmentData)) {
	$departmentPercentages = calculateDepartmentPercentages($departmentData);
} else {
	echo "No data available for departments.";
}
?>
