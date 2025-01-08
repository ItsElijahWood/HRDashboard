<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if (isset($_SESSION["user_id"])) {
     $mysqli = require("hrdata.php");

     $sql = "SELECT * FROM users WHERE id = ?";
     $stmt = $mysqli->prepare($sql);
     
     $stmt->bind_param("i", $_SESSION["user_id"]);
     
     $stmt->execute();
     
     $result = $stmt->get_result();
     
     if ($result->num_rows > 0) {
         $user = $result->fetch_assoc();
     } else {
         $user = null;
     }
     
     $stmt->close();
  }
?>
