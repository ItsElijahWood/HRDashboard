<?php 
require_once(__DIR__ . '/../../include/database/hrdata.php');
require_once(__DIR__ . '/../../controllers/panel/addDepartment.php');
require_once(__DIR__ . '/../../include/session.php');

use HRDashboard\Controller\Panel\AddDepartment;

$connConfig = new \HRDashboard\Include\ConnConfig;
$userSession = new \HRDashboard\Include\UserSession;

$conn = $connConfig->getConnection();
$userController = new AddDepartment($conn);

if ($userSession->isAuthenticated()) {
  $user = $userSession->getUser();
  $pageButtonTitle = 'Add Department';
} else {
  $user = null;
}  

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $department = isset($_POST['Department']) ? $_POST['Department'] : null;

        if (!$department) {
            throw new Exception("Please fill in all required fields.");
        }

        $userController->addDepartment($department);
        
        $message = "Department added successfully!";
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
    <title>Add Department</title>
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../../assets/css/adduser.css" />
  </head>
  <body>
    <?php include(__DIR__ . "/../../include/header.php"); ?> 
    <?php include(__DIR__ . "/../../include/buttonHeader.php"); ?> 
    
    <?php if (isset($user)): ?>
    <h1>Add Department</h1>
    <p><?= htmlspecialchars($message) ?></p>
    <form method="POST" action="">
      <label for="Department">New Department:*</label>
      <input type="text" id="Department" name="Department" required><br><br>
      <button type="submit">Submit</button>
    </form>
    <?php else: ?>
    <?php endif; ?>
  </body>
</html>