<?php
  // Loads configs
  $fullpath = include(__DIR__ . '../../config/config.php');

  include_once("session.php");

  date_default_timezone_set('Europe/London');
  $time = date("H:i");
?>
<link rel="stylesheet" href="<?php echo $fullpath['base_url']; ?>/assets/css/header.css" />
<div class="header">
  <img class="headerLogo" onclick="window.location.href='<?php echo $fullpath['base_url']; ?>'" src="<?php echo $fullpath['base_url']; ?>/assets/img/headerlogo.png"/>
  <p class="headerText">
    <?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "" ?>
  </p>
  <p id="time"><?php echo $time; ?></p>
  <p id="pt">&nbsp;|&nbsp;</p>
  <div style="display: none;" class="Menu" id="Menu">
    <div class="MenuDiv">

      <?php if (isset($user)): ?>
        <button onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/comingsoon';" class="button1">Settings</button>
        <button onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/controllers/log_out.php';" class="button1">Log out</button>
      <?php else: ?>
        <button onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/public/login';" class="button1">Log in</button>
      <?php endif; ?>

    </div>
  </div>
  <img 
    class="headerProfileIcon" 
    src="<?php echo $fullpath['base_url']; ?>/assets/img/profilelogo.png" 
    onclick="toggleProfile()"
    alt="Profile Icon"
  /> 
</div>
<script type="module" src="<?php echo $fullpath['base_url']; ?>/assets/js/updateTime.js"></script>
<script src="<?php echo $fullpath['base_url']; ?>/assets/js/profileOpen.js"></script>
