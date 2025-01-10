<?php
  require(__DIR__ . '/../include/hrdata.php');

  if (isset($_GET['id'])) {
      $employeeId = htmlspecialchars($_GET['id']); 

      $employeeData = fetchEmployeeDataById($employeeId); 

      if (!$employeeData) {
          echo "Employee not found."; 
          exit;
      }
  } else {
      echo "No Employee ID provided."; 
      exit;
  }

  function fetchEmployeeDataById($employeeId) {
      global $conn; 

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
