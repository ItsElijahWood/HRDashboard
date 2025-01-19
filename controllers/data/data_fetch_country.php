<?php
/*
* Copyright (c) 2025 Elijah Wood. All rights reserved.
* Unauthorized copying of this file, via any medium, is strictly prohibited.
* Proprietary and confidential.
*/
require_once(__DIR__ . '/../../include/database/hrdata.php');

$connConfig = new \HRDashboard\Include\ConnConfig;
$conn = $connConfig->getConnection();

// Fetch data from params and selects $columnName
function fetchColumnData($conn, $columnName, $tableName = 'contract') {
	$columnName = trim($columnName);

	$sql = "SELECT `$columnName` FROM `$tableName`";
	$result = $conn->query($sql);

	if ($result && $result->num_rows > 0) {
			$data = [];
			while ($row = $result->fetch_assoc()) {
					$data[] = $row[$columnName];
			}
			return $data;
	} else {
			return [];
	}
}

// Calculate percentages for each value
function calculatePercentages($data) {
	$totalCount = count($data);

	$filteredData = array_filter($data, function ($value) {
			return is_string($value) || is_int($value);
	});

	$valueCounts = array_count_values($filteredData);
	$percentages = [];

	foreach ($valueCounts as $value => $count) {
			$percentage = ($count / $totalCount) * 100;
			$percentages[$value] = round($percentage, 2);
	}

	return $percentages;
}

$columnName = 'Employment type';
$employmentData = fetchColumnData($conn, $columnName);

if (!empty($employmentData)) {
	$employmentPercentages = calculatePercentages($employmentData);
} else {
  echo "No data available for Employment type.";
}
?>
