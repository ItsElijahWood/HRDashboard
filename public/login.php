<?php
  include_once(__DIR__ . "/../include/session.php");

  $userSession = new HRDashboard\Include\UserSession;

  if ($userSession->isAuthenticated()) {
    $user = $userSession->getUser();

    $pageButtonTitle = "HR Login";
  } else {
    $user = null;
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People Node</title>
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/login.css" />
  </head>
  <body>
    <?php include(__DIR__ . "/../include/header.php"); ?> 
    <?php include(__DIR__ . "/../include/buttonHeader.php"); ?> 
    
    <?php if (isset($user)): ?>
    <?php else: ?>
    <h1 class="h1l">Log in</h1>
    <form action="../controllers/forms/login_form.php" method="POST">
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
        name="password" 
        id="password" 
        placeholder="Password" 
        required><br><br>
      <button class="buttonForm" type="submit">Log in</button>
    </form>
    <?php endif; ?>
  </body>
</html>