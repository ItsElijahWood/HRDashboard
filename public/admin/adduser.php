<?php 
require_once(__DIR__ . '/../../include/database/hrdata.php');
require_once(__DIR__ . '/../../controllers/panel/addUser.php');
require_once(__DIR__ . '/../../include/session.php');
$fulldir = require(__DIR__ . '/../../config/config.php');

use HRDashboard\Controller\Panel\AddUser;

$connConfig = new \HRDashboard\Include\ConnConfig;
$userSession = new \HRDashboard\Include\UserSession;

$conn = $connConfig->getConnection();
$userController = new AddUser($conn);

if ($userSession->isAuthenticated()) {
  $user = $userSession->getUser();
  $pageButtonTitle = 'Add User';
} else {
  $user = null;
}

$accessleveloptions = $userController->fetchDistinct('AccessLevel');

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $fullName = isset($_POST['FullName']) ? $_POST['FullName'] : null;
        $passWord = isset($_POST['Password']) ? $_POST['Password'] : null;
        $email = isset($_POST['Email']) ? $_POST['Email'] : null;
        $accessLevel = isset($_POST['AccessLevel']) ? $_POST['AccessLevel'] : null;

        if (!$fullName || !$passWord || !$email || !$accessLevel) {
            throw new Exception("Please fill in all required fields.");
        }

        $userController->addUser($fullName, $passWord, $email, $accessLevel);
        
        header("location: " . $fulldir['base_url'] . "/public/admin/adduser");
        $message = "User added successfully!";
    } catch (\Exception $e) {
        $message = $e->getMessage();
    }
}

if (isset($user['AccessLevel']) && $user['AccessLevel'] === 'admin') {
} else {
  die("You are not an admin.");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../../assets/css/adduser.css" />
  </head>
  <body>
    <?php include(__DIR__ . "/../../include/header.php"); ?> 
    <?php include(__DIR__ . "/../../include/buttonHeader.php"); ?> 
    
    <?php if (isset($user)): ?>
    <h1>Add User</h1>
    <p><?= htmlspecialchars($message) ?></p>
    <form method="POST" action="">
      <label for="FullName">Full Name:*</label>
      <input type="text" id="FullName" name="FullName" required><br><br>
      <label for="Password">Password:*</label>
      <input type="password" name="Password" id="Password" required><br><br>
      <label for="Email">Email*</label>
      <input type="Email" id="Email" name="Email" required><br><br>
      <label for="AccessLevel">Access Level*</label>
      <select id="AccessLevel" name="AccessLevel" required>
        <br><br>
        <option value="">-- Select Access Level --</option>
        <?php foreach ($accessleveloptions as $option): ?>
        <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit">Add User</button>
    </form>
    <?php else: ?>
    <?php endif; ?>
  </body>
</html>