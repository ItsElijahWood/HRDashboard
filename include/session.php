<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  // Check if a session id is set.
  if (isset($_SESSION["user_id"])) {
     $mysqli = require("hrdata.php");

     $sql = "SELECT * FROM users WHERE id = ?";
     $stmt = $mysqli->prepare($sql);
     
     // Bind session id (integer) to ? in $sql.
     $stmt->bind_param("i", $_SESSION["user_id"]);
     
     $stmt->execute();
     
     $result = $stmt->get_result();
     
     // If returned more than 0 rows than fetchs first row into $user,
     // If not than set null.
     if ($result->num_rows > 0) {
         $user = $result->fetch_assoc();
     } else {
         $user = null;
     }
     
     $stmt->close();
  }
?>
