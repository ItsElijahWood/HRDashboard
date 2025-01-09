<?php
  // Loads configs
  $fullpath = include __DIR__ . '../../config/config.php';

  include("session.php");

  date_default_timezone_set('Europe/London');
  $time = date("H:i");
?>
<link rel="stylesheet" href="<?php echo $fullpath['base_url']; ?>/assets/css/header.css" />
<div class="header">
  <img class="headerLogo" src="<?php echo $fullpath['base_url']; ?>/assets/img/logo.png"/>
  <p class="headerText">
    <?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "Home" ?>
  </p>
  <p id="time">| <?php echo $time; ?></p>
  <img 
    class="headerProfileIcon" 
    src="<?php echo $fullpath['base_url']; ?>/assets/img/profilelogo.png" 
    onclick="toggleProfile()"
    alt="Profile Icon"
  />
  <div style="display: none;" class="Menu" id="Menu">
    <div class="MenuDiv">
      <button onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/index';" class="button1">Home</button>
      <button onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/public/manage';" class="button1">Manage</button>

      <?php if (isset($user)): ?>
        <button onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/controllers/log_out.php';" class="button1">Log out</button>
      <?php else: ?>
        <button onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/public/login';" class="button1">Log in</button>
      <?php endif; ?>

    </div>
  </div>
</div>
<script type="module" src="<?php echo $fullpath['base_url']; ?> /assets/js/updateTime.js"></script>
<script src="<?php echo $fullpath['base_url']; ?> /assets/js/profileOpen.js"></script>
