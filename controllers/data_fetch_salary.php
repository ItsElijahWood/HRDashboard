<?php
  require_once(__DIR__ . '/../include/hrdata.php');

  $connConfig = new \HRDashboard\Include\ConnConfig;
  $conn = $connConfig->getConnection();

  function fetchAverageSalary($conn, $columnNameAS, $tableName = 'data') {
      $columnNameAS = "`" . str_replace("`", "``", $columnNameAS) . "`";
      $tableName = "`" . str_replace("`", "``", $tableName) . "`";

      // Query to remove the dollar sign and commas, then calculate the average salary.
      $sql = "SELECT AVG(CAST(REPLACE(REPLACE($columnNameAS, '$', ''), ',', '') AS DECIMAL(10,2))) AS average_salary FROM $tableName";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
          $row = $result->fetch_assoc();

          // Return the average salary formatted with a dollar sign and commas.
          return "$" . number_format($row['average_salary'], 2, '.', ','); 
      } else {
          return "NULL";
      }
  }

  $columnNameAS = 'Annual Salary';
  $averageSalary = fetchAverageSalary($conn, $columnNameAS);
?>
