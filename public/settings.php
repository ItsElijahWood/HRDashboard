<?php
  include_once(__DIR__ . "/../include/session.php");

  $userSession = new HRDashboard\Include\UserSession;

  if ($userSession->isAuthenticated()) {
    $user = $userSession->getUser();
    $pageButtonTitle = "Settings";
  } else {
    $user = null;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="icon" href="../assets/img/favicon.png" type="image/png">
  <link rel="stylesheet" href="../assets/css/settings.css" />
</head>
<body>
  <?php include(__DIR__ . "/../include/header.php"); ?> 
  <?php include(__DIR__ . "/../include/buttonHeader.php"); ?> 

  <?php if (isset($user)): ?>
    <h1 class="h1l">Reset Your Password</h1>
    <form action="../controllers/reset_password.php" method="POST">
      <input 
        class="fieldForm" 
        type="email" 
        name="email" 
        id="email" 
        placeholder="Email"
        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required><br><br>

      <input 
        class="fieldForm" 
        type="password" 
        name="old_password" 
        id="old_password" 
        placeholder="Old Password" 
        required><br><br>
        
      <input 
        class="fieldForm" 
        type="password" 
        name="new_password" 
        id="new_password" 
        placeholder="New Password" 
        required><br><br>
        
      <button class="buttonForm" type="submit">Reset Password</button>
    </form>
  <?php else: ?>
  <?php endif; ?>
</body>
</html>
