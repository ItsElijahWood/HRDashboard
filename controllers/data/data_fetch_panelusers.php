<?php
namespace HRDashboard\Controller\Data;

class FetchPanelUsers {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function getUsers() {
    // SQL query to fetch all users
    $sql = "SELECT * from `users`";
    $result = $this->conn->query($sql);

    if ($result === false) {
      die("Error executing query: " . $this->conn->error);
    }

    // Check if there are any users
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
