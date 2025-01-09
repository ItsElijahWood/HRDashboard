<?php
  $pageTitle = "HR Login";
  include(__DIR__ . "/../include/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HR Login</title>
  <link rel="icon" href="../assets/img/logo.png" type="image/png">
  <link rel="stylesheet" href="../assets/css/login.css" />
</head>
<body>
  <?php include(__DIR__ . "/../include/header.php"); ?> 

  <?php if (isset($user)): ?>
  <?php else: ?>
    <form action="../controllers/login_form.php" method="POST">
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
