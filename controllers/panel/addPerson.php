<?php
namespace HRDashboard\Controller\Panel;

class AddPerson {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    // Fetch distinct values from the 'data' table for a given column
    public function fetchDistinct($columnName) {
        $sql = "SELECT DISTINCT `$columnName` FROM data";
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

    public function getHighestEmployeeId() {
        $sql = "SELECT `Employee ID` FROM data ORDER BY `Employee ID` DESC LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result === false) {
            throw new \Exception("Error executing query: " . $this->conn->error);
        }

        $highestId = null;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $highestId = $row['Employee ID']; 
        }

        return $highestId;
    }

    public function generateNextEmployeeId() {
        $highestId = $this->getHighestEmployeeId();
        if ($highestId) {
            // Extract the number from the ID, e.g., E02002 becomes 2002
            $number = substr($highestId, 1); 
            $nextNumber = str_pad($number + 1, 5, "0", STR_PAD_LEFT); 
            return "E" . $nextNumber; 
        } else {
            return "E00001"; 
        }
    }

    public function addUser($fullName, $jobTitle, $department, $businessUnit, $gender, $ethnicity, $age, $hireDate, $annualSalary, $bonus, $country, $city, $exitDate) {
        if (empty($exitDate)) {
            $exitDate = null;
        }

        $employeeId = $this->generateNextEmployeeId();

        $sql = "INSERT INTO data (`Employee ID`, `Full Name`, `Job Title`, `Department`, `Business Unit`, `Gender`, `Ethnicity`, `Age`, `Hire Date`, `Annual Salary`, `Bonus %`, `Country`, `City`, `Exit Date`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  
        $stmt = $this->conn->prepare($sql);
  
        if ($stmt === false) {
            throw new \Exception("Error preparing the SQL query: " . $this->conn->error);
        }
  
        $stmt->bind_param("sssssssssdssss", $employeeId, $fullName, $jobTitle, $department, $businessUnit, $gender, $ethnicity, $age, $hireDate, $annualSalary, $bonus, $country, $city, $exitDate);
  
        if (!$stmt->execute()) {
            throw new \Exception("Error executing the SQL query: " . $stmt->error);
        }
  
        $stmt->close();
    }
}
?>