<?php
// Include necessary files.
include '../../include/render/renderEmployeeDivs.php'; 
include '../../controllers/data/data_fetch_jobtitle.php';
include '../../controllers/data/data_fetch_departmentPanel.php';
include '../data/data_fetch_employee.php'; 

// Fetch data from the database.
$employeeData = fetchEmployeeData($conn); 
$jobTitleFetcher = new HRDashboard\Controller\Data\FetchJobTitle($conn);
$departmentClass = new \HRDashboard\Controller\Data\FetchDepartment($conn);
$departmentData = $departmentClass->getDepartment();
$jobTitleData = $jobTitleFetcher->getJobTitles();

// Render employee data with job titles.
renderDivs($employeeData, $jobTitleData, $departmentData);
?>
