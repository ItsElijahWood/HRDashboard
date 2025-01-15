<?php
// Loads configs
$fullpath = include(__DIR__ . '../../config/config.php');
include_once __DIR__ . '/../include/session.php';
$userSesson = new \HRDashboard\Include\UserSession;

if ($userSesson->isAuthenticated()) {
  $user = $userSesson->getUser();
  $userId = $user['ID'];
}

include_once("session.php");
?>
<link rel="stylesheet" href="<?php echo $fullpath['base_url']; ?>/assets/css/header.css" />
<?php if (isset($user)): ?>
<div class="header">
  <img class="headerLogo" onclick="window.location.href='<?php echo $fullpath['base_url']; ?>'" src="<?php echo $fullpath['base_url']; ?>/assets/img/headerlogo.png"/>
  <p class="headerText">
    <?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "" ?>
  </p>
  <div style="display: none;" class="Menu" id="Menu">
    <div class="MenuDiv">

      <?php if (isset($user)): ?>
        <?php if (isset($user['AccessLevel']) && $user['AccessLevel'] === 'admin'): ?>
          <div onclick="window.location.href='<?php echo $fullpath['base_url']?>/public/admin/adminpanel'" class="groupImgAndA">
            <img class="adminImg" alt="Admin Panel Logo" src="<?php echo $fullpath['base_url']?>/assets/img/Admin.png"></img>
            <a onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/public/admin/adminpanel';" class="buttonmain">Admin Panel</a>
          </div>
          <?php endif; ?>
          <div onclick="window.location.href='<?php echo $fullpath['base_url']?>/public/settings'" class="groupImgAndA">
          <img class="settingsImg" alt="Settings Logo" src="<?php echo $fullpath['base_url']?>/assets/img/Settings.png"></img>
        <a onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/public/settings';" class="button1">Settings</a>
          </div>
          <div onclick="window.location.href='<?php echo $fullpath['base_url']?>/public/profile?id=<?php echo $userId ?>'" class="groupImgAndA">
          <img class="profileImg" alt="Profile Logo" src="<?php echo $fullpath['base_url']?>/assets/img/Profile.png"></img>
            <a onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/public/profile?id=<?php echo $userId ?>'"; class="button1">My Profile</a>
          </div>
          <div onclick="window.location.href='<?php echo $fullpath['base_url']?>/controllers/log_out.php'" class="groupImgAndA">
          <img class="logOutImg" alt="Logout Logo" src="<?php echo $fullpath['base_url']?>/assets/img/Log_out.png"></img>
        <a onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/controllers/log_out.php';" class="button1">Log out</a>
        </div>
        <?php else: ?>
      <?php endif; ?>

    </div>
  </div>
  <div class="divProfileLogo">
    <img 
      class="headerProfileIcon" 
      src="<?php echo $fullpath['base_url']; ?>/assets/img/profilelogo.png" 
      onclick="toggleProfile()"
      alt="Profile Icon"
    /> 
  </div>
</div>
<?php else: ?>
  <link rel="stylesheet" href="<?php echo $fullpath['base_url']; ?>/assets/css/header.css" />
  <div class="header">
  <img class="headerLogo" onclick="window.location.href='<?php echo $fullpath['base_url']; ?>'" src="<?php echo $fullpath['base_url']; ?>/assets/img/headerlogo.png"/>
  <p class="headerText">
    <?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "" ?>
  </p>
  <div style="display: none;" class="MenuLOUT" id="Menu">
    <div style="height: auto;" class="MenuDiv">
    <div onclick="window.location.href='<?php echo $fullpath['base_url']?>/public/login'" class="groupImgAndA">
            <img class="logInImg" alt="Login Logo" src="<?php echo $fullpath['base_url']?>/assets/img/Log-In.png"></img>
            <a onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/public/login';" class="button1">Log in</a>
    </div>
    </div>
  </div>
  <div class="divProfileLogo">
  <img 
    class="headerProfileIcon" 
    src="<?php echo $fullpath['base_url']; ?>/assets/img/profilelogo.png" 
    onclick="toggleProfile()"
    alt="Profile Icon"
  /> 
  </div>
</div>
<?php endif; ?>
<script src="<?php echo $fullpath['base_url']; ?>/assets/js/profileOpen.js"></script>
