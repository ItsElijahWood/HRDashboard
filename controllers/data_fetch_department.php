<?php
  require(__DIR__ . '/../include/hrdata.php');

  function fetchDepartmentData($columnNameDT, $tableName = 'data') {
    global $conn;

    $columnNameDT = trim($columnNameDT);

    // Query to get all data from the Department column.
    $sql = "SELECT $columnNameDT FROM $tableName";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
      $departmentData = [];
      while ($row = $result->fetch_assoc()) {
        // Store the department data in an array.
        $departmentData[] = $row[$columnNameDT];
      }
        // Return the department data array.
        return $departmentData;
      } else {
        return [];
      }
    }

  // Calculate percentage of each department.
  function calculateDepartmentPercentages($departmentData) {
    $totalCount = count($departmentData);
    $departmentCounts = array_count_values($departmentData);
    $departmentPercentages = [];

    foreach ($departmentCounts as $department => $count) {
      if (empty($department) || !is_string($department)) {
        continue;
      }

      $percentage = ($count / $totalCount) * 100;
      // Round to 2 decimal places.
      $departmentPercentages[$department] = round($percentage, 2);
    }

      return $departmentPercentages;
  }

  $columnNameDT = 'Department'; 
  $departmentData = fetchDepartmentData($columnNameDT);

  if (!empty($departmentData)) {
    $departmentPercentages = calculateDepartmentPercentages($departmentData);
  } else {
      echo "No data available for departments.";
  }
?>
