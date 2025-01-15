<?php
require_once(__DIR__ . '/../../include/database/hrdata.php');

$connConfig = new \HRDashboard\Include\ConnConfig;
$conn = $connConfig->getConnection();

function fetchTotalCount($conn, $columnNameEID, $tableName = 'data') {
    $columnNameEID = "`" . str_replace("`", "``", $columnNameEID) . "`";
    $tableName = "`" . str_replace("`", "``", $tableName) . "`";

    // Query to count total number of rows in the column
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
