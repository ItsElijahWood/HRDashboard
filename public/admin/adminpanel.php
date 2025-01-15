<?php
include_once __DIR__ . '/../../include/session.php';
include_once __DIR__ . '/../../controllers/data/data_fetch_users.php';
include_once __DIR__ . '/../../include/render/renderUsersDivs.php';
$config = include(__DIR__ . '/../../config/config.php');

$fetchUsers = new \HRDashboard\Controller\Data\FetchUsers;
$userSession = new \HRDashboard\Include\UserSession;
$renderDivs = new \HRDashboard\Include\Render\RenderUserDivs($config);

$userCount = $fetchUsers->getUsers();
$fields = ['ID', 'Username', 'AccessLevel'];

if ($userSession->isAuthenticated()) {
  $user = $userSession->getUser();
  $pageButtonTitle = "Admin Panel";
} else {
  $user = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
  <link rel="stylesheet" href="../../assets/css/adminpanel.css" />
</head>
<body>
    <?php include(__DIR__ . "/../../include/header.php"); ?>
    <?php include(__DIR__ . "/../../include/buttonHeader.php"); ?>

    <?php if (isset($user)): ?>
        <div class="hroverview">
            <h2 class="hrth2">HR Overview</h2>
            <div class="background"></div>
            <div class="totalUCD">
                <p class="ptUC">Total HR's</p>
                <p class="pUC"><?php echo $userCount; ?></p>
            </div>
        </div>
        <div class="mgroup">
          <div class="group1">
            <div id="leftsidebar1" class="leftsidebar1">
                  <h3 class="lsb1h3">Manage Panel</h3>
                  <div class="lsb1d" onclick="window.location.href='<?php echo $fulldir['base_url']; ?>/public/admin/adduser'">
                      <a class="lsp" onclick="window.location.href='<?php echo $fulldir['base_url']; ?>/public/admin/adduser'">Add User</a>
                  </div>
          </div>
        </div>
        <div class="user-data" id="user-data-container">
        </div>
      </div>
      <script>
        fetch("../../controllers/getUserData.php")
                .then((response) => response.text())
                .then((data) => {
                // Update employee data container with the content.
                document.getElementById("user-data-container").innerHTML = data;
            })
            .catch((error) => console.error("Error fetching employee data:", error));      
      </script>
    <?php else: ?>
    <?php endif; ?>
</body>
</html>
