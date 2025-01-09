<?php
  include(__DIR__ . "./include/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HR</title>
  <link rel="icon" href="./assets/img/logo.png" type="image/png">
</head>
<body>
  <?php include(__DIR__ . "./include/header.php"); ?>

  <?php if (isset($user)): ?>
    <p>Logged in</p>
  <?php else: ?>
    <p>Logged out</p>
  <?php endif; ?>

</body>
</html>
