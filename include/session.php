<?php
namespace HRDashboard\Include;

require_once __DIR__ . '/./hrdata.php';

class UserSession {
    public $user;
    private $connConfig;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->connConfig = new ConnConfig();
        $conn = $this->connConfig->getConnection(); 

        // Check if a session ID exists for the user
        if (isset($_SESSION["user_id"])) {
            $this->user = $this->getUserById($_SESSION["user_id"], $conn);
        } else {
            $this->user = null;
        }
    }

    // Fetch user data by user ID
    private function getUserById($userId, $conn) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("SQL preparation failed: " . $conn->error);
        }

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function isAuthenticated() {
        return $this->user !== null;
    }

    public function getUser() {
        return $this->user;
    }
}
?>
