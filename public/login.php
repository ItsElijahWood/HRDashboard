<?php
  include(__DIR__ . "/../include/session.php");
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

  <?php if (isset($user)): ?>
  <?php else: ?>
    <div class="hroutmdiv">
      <div class="hroutmanagediv1">
        <p class="hroutmanagediv1p1">
          Back | 
        </p>
      </div>
      <div class="hroutmanagediv2">
        <a 
          class="hroutmanagediv2a1" 
          onclick="window.location.href='<?php echo $fullpath['base_url']; ?>';" class="button1">Home
        </a>
      </div>
    </div> 
    <h1 class="h1l">Log in</h1>
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
