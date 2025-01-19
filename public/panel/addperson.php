<?php 
require_once(__DIR__ . '/../../include/database/hrdata.php');
require_once(__DIR__ . '/../../controllers/panel/addPerson.php');
require_once(__DIR__ . '/../../include/session.php');

use HRDashboard\Controller\Panel\AddPerson;

$connConfig = new \HRDashboard\Include\ConnConfig;
$userSession = new \HRDashboard\Include\UserSession;

$conn = $connConfig->getConnection();
$userController = new AddPerson($conn);

if ($userSession->isAuthenticated()) {
  $user = $userSession->getUser();
  $pageButtonTitle = 'Add User';
} else {
  $user = null;
}

/*
$departments = $userController->fetchDepartment('Department');
$genders = $userController->fetchDistinct('Gender');
$ethnicities = $userController->fetchDistinct('Ethnicity');
$countries = $userController->fetchDistinct('Country');
$cities = $userController->fetchDistinct('City');
$jobTitles = $userController->fetchJobTitle('jobtitle');  
*/

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $title = isset($_POST['Title']) ? $_POST['Title'] : "";
        $legalFirstName = isset($_POST['LegalFirstName']) ? $_POST['LegalFirstName'] : "";
        $preferredFirstName = isset($_POST['PreferredFirstName']) ? $_POST['PreferredFirstName'] : "";
        $legalMiddleName = isset($_POST['LegalMiddleName']) ? $_POST['LegalMiddleName'] : "";
        $legalLastName = isset($_POST['LegalLastName']) ? $_POST['LegalLastName'] : "";
        $preferredLastName = isset($_POST['PreferredLastName']) ? $_POST['PreferredLastName'] : "";
        $gender = isset($_POST['Gender']) ? $_POST['Gender'] : "";
        $ethnicity = isset($_POST['Ethnicity']) ? $_POST['Ethnicity'] : "";
        $dob = isset($_POST['DOB']) ? $_POST['DOB'] : "";
        $nin = isset($_POST['NIN']) ? $_POST['NIN'] : "";
        $passportNumber = isset($_POST['PassportNumber']) ? $_POST['PassportNumber'] : "";
        $religion = isset($_POST['Religion']) ? $_POST['Religion'] : "";
        $jobTitle = isset($_POST['JobTitle']) ? $_POST['JobTitle'] : "";
        $department = isset($_POST['Department']) ? $_POST['Department'] : "";
        $contractPeriod = isset($_POST['ContractPeriod']) ? $_POST['ContractPeriod'] : "";
        $startDate = isset($_POST['StartDate']) ? $_POST['StartDate'] : "";
        $employmentType = isset($_POST['EmploymentType']) ? $_POST['EmploymentType'] : "";

        if (!$title || !$legalFirstName || !$legalMiddleName || !$legalLastName || !$gender || !$ethnicity || !$dob || !$nin || !$passportNumber || !$jobTitle || !$department || !$startDate || !$employmentType) {
            throw new \Exception("Please fill in all required fields.");
        }

        $userController->addUser($title, $legalFirstName, $preferredFirstName, $legalMiddleName, $legalLastName, $preferredLastName, $gender, $ethnicity, $dob, $nin, $passportNumber, $religion, $jobTitle, $department, $contractPeriod, $startDate, $employmentType);
        
        $message = "User added successfully!";
    } catch (\Exception $e) {
        $message = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Person</title>
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../../assets/css/adduser.css" />
  </head>
  <body>
    <?php include(__DIR__ . "/../../include/header.php"); ?> 
    <?php include(__DIR__ . "/../../include/buttonHeader.php"); ?> 
    
    <?php if (isset($user)): ?>
    <h1>Add Person</h1>
    <p><?= htmlspecialchars($message) ?></p>
    <form method="POST" action="">
      <label for="Title">Title:*</label>
      <input type="text" id="Title" name="Title" required><br><br>
      <label for="LegalFirstName">Legal first name:*</label>
      <input type="text" id="LegalFirstName" name="LegalFirstName" required><br><br>
      <label for="PreferredFirstName">Preferred first name:</label>
      <input type="text" id="PreferredFirstName" name="PreferredFirstName"><br><br>
      <label for="LegalMiddleName">Legal middle name:*</label>
      <input type="text" id="LegalMiddleName" name="LegalMiddleName" required><br><br>
      <label for="LegalLastName">Legal last name:*</label>
      <input type="text" id="LegalLastName" name="LegalLastName" required><br><br>
      <label for="PreferredLastName">Preferred last name:</label>
      <input type="text" id="PreferredLastName" name="PreferredLastName"><br><br>
      <label for="Gender">Sex:*</label>
      <input type="text" id="Gender" name="Gender" required><br><br>
      <label for="DOB">Date of birth:*</label>
      <input type="date" id="DOB" name="DOB" required><br><br>
      <label for="Ethnicity">Ethnicity:*</label>
      <input type="text" id="Ethnicity" name="Ethnicity" required><br><br>
      <label for="NIN">National insurance number:*</label>
      <input type="text" id="NIN" name="NIN" required><br><br>
      <label for="PassportNumber">Passport number:*</label>
      <input type="text" id="PassportNumber" name="PassportNumber" required><br><br>
      <label for="Religion">Religion:</label>
      <input type="text" id="Religion" name="Religion"><br><br>
      <label for="JobTitle">JobTitle:*</label>
      <input type="text" id="JobTitle" name="JobTitle" required><br><br>
      <label for="Department">Department:*</label>
      <input type="text" id="Department" name="Department" required><br><br>
      <label for="ContractPeriod">Contract Period:</label>
      <input type="text" id="ContractPeriod" name="ContractPeriod"><br><br>
      <label for="StartDate">Start date:*</label>
      <input type="date" id="StartDate" name="StartDate" required><br><br>
      <label for="EmploymentType">Employment type:*</label>
      <input type="text" id="EmploymentType" name="EmploymentType" required><br><br>
      <button type="submit">Add User</button>
    </form>
    <?php else: ?>
    <?php endif; ?>
  </body>
</html>