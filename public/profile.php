<?php
  $fulldir = include(__DIR__ . '/../config/config.php');
  include_once(__DIR__ . '/../include/session.php');
  include(__DIR__ . '/../controllers/data/data_fetch_userID.php'); 

  $userSession = new \HRDashboard\Include\UserSession;

  $username = isset($userData['Username']) ? $userData['Username'] : 'N/A';
  $accesslevel = isset($userData['AccessLevel']) ? $userData['AccessLevel'] : 'N/A';
  $id = isset($userData['ID']) ? $userData['ID'] : 'N/A';

  if ($userSession->isAuthenticated()) {
    $user = $userSession->getUser();
    $userId = $user['ID'];
    $pageButtonTitle = "My Profile";
  } else {
    $user = null;
  }

  if ($_GET['id'] != $userId) {
    die("You can't access this profile.");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
  <link rel="icon" href="../assets/img/favicon.png" type="image/png">
  <link rel="stylesheet" href="../assets/css/myprofile.css" />
</head>
<body>
  <?php include(__DIR__ . "/../include/header.php"); ?> 
  <?php include(__DIR__ . "/../include/buttonHeader.php"); ?> 

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
          <p class="mainnamediv3p1"><?php echo htmlspecialchars($username); ?></p>
        </div> 
      </div>
      <div class="mainnamemdiv2">
        <div class="mainnamemdiv2p1">
          <p><strong class="ml">Position</strong> <?php echo htmlspecialchars($accesslevel); ?></p> 
        </div>
        <div class="mainnamemdiv2p2">
          <p><strong class="ml">ID</strong> <?php echo htmlspecialchars($id); ?></p>
        </div>
      </div>
    </div>
  <?php else: ?>
  <?php endif; ?>
</body>
</html>
