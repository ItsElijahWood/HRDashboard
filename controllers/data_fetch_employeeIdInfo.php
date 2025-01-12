<?php
  require_once(__DIR__ . '/../include/hrdata.php');

  $connConfig = new \HRDashboard\Include\ConnConfig;
  $conn = $connConfig->getConnection();

  if (isset($_GET['id'])) {
      $employeeId = htmlspecialchars($_GET['id']); 

      $employeeData = fetchEmployeeDataById($conn, $employeeId); 

      if (!$employeeData) {
          echo "Employee not found."; 
          exit;
      }
  } else {
      echo "No Employee ID provided."; 
      exit;
  }

  function fetchEmployeeDataById($conn, $employeeId) {

      // Prepare the SQL query to fetch the employee data by Employee ID.
      $stmt = $conn->prepare("SELECT * FROM data WHERE `Employee ID` = ?");
      if ($stmt === false) {
          die('MySQL Error: ' . $conn->error);
      }

      $stmt->bind_param("s", $employeeId); 

      $stmt->execute();

      $result = $stmt->get_result();

      $employeeData = $result->fetch_assoc();

      $stmt->close();

      return $employeeData;
  }
?>
