<?php
  $config = include "../config.php";

  $dbHost = $config['dbHost'];
  $dbUser = $config['dbUser'];
  $dbPass = $config['token'];
  $servername = $config['hrdataDb'];

  $conn = new mysqli($dbHost, $dbUser, $dbPass, $servername);

  if ($conn->connect_error) {
    die("Conn failed: " . $conn->connect_error);
  } 

  return $conn;
?>
