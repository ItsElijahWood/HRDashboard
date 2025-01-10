<?php
  require(__DIR__ . '/../include/hrdata.php');

  function fetchTotalCount($columnNameEID, $tableName = 'data') {
      global $conn;

      $columnNameEID = "`" . str_replace("`", "``", $columnNameEID) . "`";
      $tableName = "`" . str_replace("`", "``", $tableName) . "`";

      // Query to count total number of rows in the column.
      $sql = "SELECT COUNT($columnNameEID) AS total_count FROM $tableName";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
          $row = $result->fetch_assoc();
          // Return the total count.
          return $row['total_count']; 
      } else {
          // Return 0 if no rows found.
          return 0; 
      }
  }

  $columnNameEID = 'Employee ID';
  $totalCount = fetchTotalCount($columnNameEID);
?>
