<?php
include('../include/hrdata.php');

function fetchEmployeeData($tableName = 'data') {
    global $conn;

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
