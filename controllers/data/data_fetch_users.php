<?php
namespace HRDashboard\Controller\Data;

require_once(__DIR__ . '/../../include/database/hrdata.php');

class FetchUsers {
    private $conn;

    public function __construct() {
        $connConfig = new \HRDashboard\Include\ConnConfig;
        $this->conn = $connConfig->getConnection();
    }

    public function getUsers() {
        $sql = "SELECT COUNT(`id`) AS total FROM `users`";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return (int) $row['total'];
            } 
        }
        return 0;
    }
}
