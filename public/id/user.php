<?php
  $fulldir = include(__DIR__ . '/../../config/config.php');
  include(__DIR__ . '/../../include/session.php');
  include(__DIR__ . '/../../controllers/data_fetch_employeeIdInfo.php'); 

  $pageButtonTitle = "Profile";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
  <link rel="stylesheet" href="../../assets/css/user.css" />
</head>
<body>
  <?php include(__DIR__ . "/../../include/header.php"); ?> 
  <?php include(__DIR__ . "/../../include/buttonHeader.php"); ?> 

  <?php if (isset($user)): ?>
    <div class="mainnamediv">
      <div class="mainnamemdiv">
        <div class="mainnamediv2">
          <img 
            class="ProfileIcon" 
            src="<?php echo $fulldir['base_url']; ?>/assets/img/profilelogo.png" 
            alt="Profile Icon"
          />
        </div>
        <div class="mainnamediv3">
          <p class="mainnamediv3p1"><?php echo htmlspecialchars($employeeData['Full Name']); ?></p>
        </div> 
      </div>
      <div class="mainnamemdiv2">
        <div class="mainnamemdiv2p1">
          <p><strong class="ml">Position</strong> <?php echo htmlspecialchars($employeeData['Job Title']); ?></p> 
        </div>
        <div class="mainnamemdiv2p2">
          <p><strong class="ml">Department</strong> <?php echo htmlspecialchars($employeeData['Department']); ?></p>
        </div>
      </div>
    </div>
    <div class="cutoffdiv1">
        <h3 class="cutoffdiv1p1">Identity</h3>
    </div>
  <?php else: ?>
  <?php endif; ?>
</body>
</html>
