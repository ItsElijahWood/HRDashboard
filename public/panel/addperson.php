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

$departments = $userController->fetchDistinct('Department');
$businessUnits = $userController->fetchDistinct('Business Unit');
$genders = $userController->fetchDistinct('Gender');
$ethnicities = $userController->fetchDistinct('Ethnicity');
$countries = $userController->fetchDistinct('Country');
$cities = $userController->fetchDistinct('City');
$jobTitles = $userController->fetchDistinct('Job Title');  

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $fullName = isset($_POST['FullName']) ? $_POST['FullName'] : null;
        $jobTitle = isset($_POST['JobTitle']) ? $_POST['JobTitle'] : null;
        $department = isset($_POST['Department']) ? $_POST['Department'] : null;
        $businessUnit = isset($_POST['BusinessUnit']) ? $_POST['BusinessUnit'] : null;
        $gender = isset($_POST['Gender']) ? $_POST['Gender'] : null;
        $ethnicity = isset($_POST['Ethnicity']) ? $_POST['Ethnicity'] : null;
        $age = isset($_POST['Age']) ? $_POST['Age'] : null;
        $hireDate = isset($_POST['HireDate']) ? $_POST['HireDate'] : null;
        $annualSalary = isset($_POST['AnnualSalary']) ? $_POST['AnnualSalary'] : null;
        $bonus = isset($_POST['Bonus']) ? $_POST['Bonus'] : null;
        $country = isset($_POST['Country']) ? $_POST['Country'] : null;
        $city = isset($_POST['City']) ? $_POST['City'] : null;
        $exitDate = isset($_POST['ExitDate']) ? $_POST['ExitDate'] : null;

        if (!$fullName || !$jobTitle || !$department || !$businessUnit || !$gender || !$ethnicity || !$age || !$hireDate || !$annualSalary || !$bonus || !$country || !$city) {
            throw new Exception("Please fill in all required fields.");
        }

        $userController->addUser($fullName, $jobTitle, $department, $businessUnit, $gender, $ethnicity, $age, $hireDate, $annualSalary, $bonus, $country, $city, $exitDate);
        
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
      <label for="FullName">Full Name:*</label>
      <input type="text" id="FullName" name="FullName" required><br><br>
      <label for="JobTitle">Job Title:*</label>
      <select id="JobTitle" name="JobTitle" required>
        <option value="">-- Select Job Title --</option>
        <?php foreach ($jobTitles as $title): ?>
        <option value="<?= htmlspecialchars($title) ?>"><?= htmlspecialchars($title) ?></option>
        <?php endforeach; ?>
      </select>
      <br><br>
      <label for="Department">Department:*</label>
      <select id="Department" name="Department" required>
        <option value="">-- Select Department --</option>
        <?php foreach ($departments as $dept): ?>
        <option value="<?= htmlspecialchars($dept) ?>"><?= htmlspecialchars($dept) ?></option>
        <?php endforeach; ?>
      </select>
      <br><br>
      <label for="BusinessUnit">Business Unit:*</label>
      <select id="BusinessUnit" name="BusinessUnit" required>
        <option value="">-- Select Business Unit --</option>
        <?php foreach ($businessUnits as $unit): ?>
        <option value="<?= htmlspecialchars($unit) ?>"><?= htmlspecialchars($unit) ?></option>
        <?php endforeach; ?>
      </select>
      <br><br>
      <label for="Gender">Gender:*</label>
      <select id="Gender" name="Gender" required>
        <option value="">-- Select Gender --</option>
        <?php foreach ($genders as $gen): ?>
        <option value="<?= htmlspecialchars($gen) ?>"><?= htmlspecialchars($gen) ?></option>
        <?php endforeach; ?>
      </select>
      <br><br>
      <label for="Ethnicity">Ethnicity:*</label>
      <select id="Ethnicity" name="Ethnicity" required>
        <option value="">-- Select Ethnicity --</option>
        <?php foreach ($ethnicities as $eth): ?>
        <option value="<?= htmlspecialchars($eth) ?>"><?= htmlspecialchars($eth) ?></option>
        <?php endforeach; ?>
      </select>
      <br><br>
      <label for="Age">Age:*</label>
      <input type="number" id="Age" name="Age" required><br><br>
      <label for="HireDate">Hire Date:*</label>
      <input type="date" id="HireDate" name="HireDate" required><br><br>
      <label for="AnnualSalary">Annual Salary:*</label>
      <input type="number" id="AnnualSalary" name="AnnualSalary" step="0.01" required><br><br>
      <label for="Bonus">Bonus % (0 to 100):*</label>
      <input type="number" id="Bonus" name="Bonus" min="0" max="100" step="0.01" required><br><br>
      <label for="Country">Country:*</label>
      <select id="Country" name="Country" required>
        <option value="">-- Select Country --</option>
        <?php foreach ($countries as $country): ?>
        <option value="<?= htmlspecialchars($country) ?>"><?= htmlspecialchars($country) ?></option>
        <?php endforeach; ?>
      </select>
      <br><br>
      <label for="City">City:*</label>
      <select id="City" name="City" required>
        <option value="">-- Select City --</option>
        <?php foreach ($cities as $city): ?>
        <option value="<?= htmlspecialchars($city) ?>"><?= htmlspecialchars($city) ?></option>
        <?php endforeach; ?>
      </select>
      <br><br>
      <label for="ExitDate">Exit Date:</label>
      <input type="date" id="ExitDate" name="ExitDate"><br><br>
      <button type="submit">Add User</button>
    </form>
    <?php else: ?>
    <?php endif; ?>
  </body>
</html>