<?php
  include(__DIR__ . '/../include/renderEmployeeDivs.php');
  include(__DIR__ . '/./data_fetch_employee.php');

  $query = isset($_GET['query']) ? $_GET['query'] : ''; 

  function searchEmployeeData($conn, $tableName = 'data', $searchQuery = '') {

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

  // Fetch data with the search query.
  $employeeData = searchEmployeeData($conn, 'data', $query);

  renderDivs($employeeData, ['Full Name', 'Job Title', 'Department']);
?>
