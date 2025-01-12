<?php
$fulldir = include(__DIR__ . '../../config/config.php');

include_once("session.php");
?>
<link rel="stylesheet" href="<?php echo $fulldir['base_url']; ?>/assets/css/buttonHeader.css" />
<?php if (isset($user)): ?>
<div class="hrmanagemdiv">
  <div class="hrmanagediv1">
    <p class="hrmanagediv1p1">
      <?php echo isset($pageButtonTitle) ? htmlspecialchars($pageButtonTitle) : "null" ?> | 
    </p>
  </div>
  <div class="hrmanagediv2">
    <a 
      class="hrmanagediv2a1" 
      onclick="window.location.href='<?php echo $fulldir['base_url']; ?>';" class="button1">Home
    </a>
  </div>
  <div class="hrmanagediv3">
    <a 
      class="hrmanagediv2a2" 
      onclick="window.location.href='<?php echo $fulldir['base_url']; ?>/public/manage';" class="button1">Manage
    </a>
  </div>
</div> 
<?php else: ?>
<div class="hroutmdiv">
  <div class="hroutmanagediv1">
    <p class="hroutmanagediv1p1">
      Logged Out | 
    </p>
  </div>
  <div class="hroutmanagediv2">
    <a 
      class="hroutmanagediv2a1" 
      onclick="window.location.href='<?php echo $fulldir['base_url']; ?>/public/login';" class="button1">Login
    </a>
  </div>
</div>
<?php endif; ?>