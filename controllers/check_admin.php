<?php
namespace HRDashboard\Controller;

require_once __DIR__ . '/../include/session.php';

class CheckAccessLevel {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn; 
  }

  private function getTableColumns($tableName) {
    try {
      $sql = "DESCRIBE `$tableName`";
      $stmt = $this->conn->prepare($sql);

      $stmt->execute();

      $columns = $stmt->fetchAll(\PDO::FETCH_COLUMN);

      return $columns; 
    } catch (\PDOException $e) {
      throw new \Exception("Error retrieving columns: " . $e->getMessage());
    }
  }

  public function checkUserAccess($tableName, $userId) {
    try {
      $allowedColumns = $this->getTableColumns($tableName);

      if (!in_array('AccessLevel', $allowedColumns)) {
        throw new \Exception("'AccessLevel' column does not exist in table `$tableName`.");
      }

      if (!in_array('ID', $allowedColumns)) {
        throw new \Exception("'ID' column does not exist in table `$tableName`.");
      }

      $sql = "SELECT `AccessLevel` FROM `$tableName` WHERE `ID` = ? AND `AccessLevel` = 'admin'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$userId]);

      $result = $stmt->fetch();

      return $result !== false;

    } catch (\PDOException $e) {
      throw new \Exception("Error checking access level: " . $e->getMessage());
    }
  }
}
