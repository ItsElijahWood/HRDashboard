<?php
  include '../include/renderEmployeeDivs.php'; 
  include 'data_fetch_employee.php'; 

  // Fetches data from database and stores it in var.
  $employeeData = fetchEmployeeData($conn); 

  renderDivs($employeeData, ['Full Name', 'Job Title', 'Department']);
?>
