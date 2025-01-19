<?php
/*
* Copyright (c) 2025 Elijah Wood. All rights reserved.
* Unauthorized copying of this file, via any medium, is strictly prohibited.
* Proprietary and confidential.
*/
require_once(__DIR__ . '/../../include/database/hrdata.php');

$connConfig = new \HRDashboard\Include\ConnConfig;
$conn = $connConfig->getConnection();

// Fetch parms replace ` with `` and fetches $columnNameEID as COUNT
function fetchTotalCount($conn, $columnNameEID, $tableName = 'identity') {
	$columnNameEID = "`" . str_replace("`", "``", $columnNameEID) . "`";
	$tableName = "`" . str_replace("`", "``", $tableName) . "`";

	$sql = "SELECT COUNT($columnNameEID) AS total_count FROM $tableName";
	$result = $conn->query($sql);

	if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row['total_count']; 
	} else {
			return 0; 
	}
}

$columnNameEID = 'Employee ID';
$totalCount = fetchTotalCount($conn, $columnNameEID);
?>
