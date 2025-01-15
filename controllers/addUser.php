<?php
namespace HRDashboard\Controller;

class AddUser {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function fetchDistinct($columnName) {
        $sql = "SELECT DISTINCT `$columnName` FROM users";
        $result = $this->conn->query($sql);

        if ($result === false) {
            throw new \Exception("Error executing query: " . $this->conn->error);
        }

        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row[$columnName]; 
            }
        }
        return $data;
    }

    private function getHighestUserId() {
        $sql = "SELECT `ID` FROM users ORDER BY `ID` DESC LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result === false) {
            throw new \Exception("Error executing query: " . $this->conn->error);
        }

        $highestId = null;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $highestId = $row['ID'];  // Assuming the ID is just a number (e.g., 1, 2, 3)
        }

        return $highestId;
    }

    // Method to check if a given ID already exists in the database
    private function isIdExists($id) {
        $sql = "SELECT COUNT(*) FROM users WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt === false) {
            throw new \Exception("Error preparing the SQL query: " . $this->conn->error);
        }
    
        $stmt->bind_param("s", $id);  // Assuming ID is a string (5-digit)
        $stmt->execute();

        $count = 0;
    
        // Instead of binding the result directly, fetch the result
        $stmt->store_result();  // Store the result to be able to get row count
        $stmt->bind_result($count); // Bind the result to $count
        $stmt->fetch();
    
        $stmt->close();
    
        return $count > 0;  // Returns true if the ID already exists
    }
    
    // Method to generate the next unique user ID
    private function generateNextUserId() {
        $highestId = $this->getHighestUserId();

        // Check if a highest ID was found
        if ($highestId) {
            // Extract the number from the ID (e.g., if ID is 00001, it becomes 1)
            $number = (int)$highestId;
            $nextNumber = $number + 1; // Increment the number

            // Ensure that the next number is unique
            while ($this->isIdExists($nextNumber)) {
                $nextNumber++; // Keep incrementing if the ID already exists
            }

            return str_pad($nextNumber, 5, "0", STR_PAD_LEFT); // Return the next ID as a 5-digit string
        } else {
            return "00001"; // Starting from 00001 if no IDs exist
        }
    }

    // Method to add a new user to the database
    public function addUser($fullName, $passWord, $email, $accessLevel) {
        $hashedPassword = password_hash($passWord, PASSWORD_BCRYPT);
        $employeeId = $this->generateNextUserId();  // Generate unique ID

        $sql = "INSERT INTO users (`ID`, `Username`, `Password`, `Email`, `AccessLevel`) 
            VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            throw new \Exception("Error preparing the SQL query: " . $this->conn->error);
        }

        $stmt->bind_param("sssss", $employeeId, $fullName, $hashedPassword, $email, $accessLevel);

        if (!$stmt->execute()) {
            throw new \Exception("Error executing the SQL query: " . $stmt->error);
        }

        $stmt->close();
    }
}
?>