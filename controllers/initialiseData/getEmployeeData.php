<?php
  include '../../include/render/renderEmployeeDivs.php'; 
  include '../data/data_fetch_employee.php'; 

  // Fetches data from database and stores it in var.
  $employeeData = fetchEmployeeData($conn); 

  renderDivs($employeeData, ['Full Name', 'Job Title', 'Department']);
?>
