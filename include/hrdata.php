<?php
namespace HRDashboard\Include;

class ConnConfig {
  private $conn;

  public function __construct() {
    $config = require(__DIR__ . "/../config/config.php");

    $dbHost = $config['dbHost'];
    $dbUser = $config['dbUser'];
    $dbPass = $config['dbPass'];
    $servername = $config['hrdataDb'];

    // Executes db credentials.
    $this->conn = new \mysqli($dbHost, $dbUser, $dbPass, $servername);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getConnection() {
    return $this->conn;
  }

  public function closeConnection() {
    if ($this->conn) {
      $this->conn->close();
    }
  }
}
?>
