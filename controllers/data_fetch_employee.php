<?php
include('../include/hrdata.php');

function fetchEmployeeData($tableName = 'data') {
    global $conn;

    $sql = "SELECT * FROM $tableName"; 
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
?>
