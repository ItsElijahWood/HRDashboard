<?php
  $config = require(__DIR__ . "/../config/config.php");

  // Require database creds from config.php.
  $dbHost = $config['dbHost'];
  $dbUser = $config['dbUser'];
  $dbPass = $config['dbPass'];
  $servername = $config['hrdataDb'];

  // Executes db cred.
  $conn = new mysqli($dbHost, $dbUser, $dbPass, $servername);

  if ($conn->connect_error) {
    die("Conn failed: " . $conn->connect_error);
  } 

  return $conn;
?>
