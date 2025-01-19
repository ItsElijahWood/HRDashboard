<?php
/*
 * Copyright (c) 2025 Elijah Wood. All rights reserved.
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Proprietary and confidential.
 */
namespace HRDashboard\Controller\Data;

class FetchPanelUsers {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

	// Checks the database for users then loop through them putting the result in row var
  public function getUsers() {
    $sql = "SELECT * from `users`";
    $result = $this->conn->query($sql);

    if ($result === false) {
      die("Error executing query: " . $this->conn->error);
    }

    $users = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $users[] = $row;
      }
      return $users;
    } else {
      return [];
    }
  }
}
