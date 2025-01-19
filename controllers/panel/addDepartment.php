<?php 
/*
 * Copyright (c) 2025 Elijah Wood. All rights reserved.
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Proprietary and confidential.
 */
namespace HRDashboard\Controller\Panel;

class AddDepartment {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

	// Checks param ($_POST) if its already stored in database
  private function checkIfInDbAlready($department) {
    $sql = "SELECT * FROM departments WHERE department = ?";

    $stmt = $this->conn->prepare($sql); 

    $stmt->bind_param('s', $department);

    $stmt->execute();

    $result = $stmt->get_result(); 
    
    if ($result->num_rows > 0) {
        return true; 
    } else {
        return false; 
    }
  }

	// Gets param from $_POST and inserts into database
  public function addDepartment($department) {
    if ($this->checkIfInDbAlready($department)) {
        throw new \Exception("Job title already exists in the database.");
    }

    $sql = "INSERT INTO departments (`department`) VALUES (?)";

    $stmt = $this->conn->prepare($sql);

    if ($stmt === false) {
        throw new \Exception("Error preparing stmt addDepartment.php: " . $this->conn->error);
    }

    $stmt->bind_param("s", $department);

    if (!$stmt->execute()) {
        throw new \Exception("Error while executing sql query addDepartment.php: " . $stmt->error);
    }

    $stmt->close();
}

}
?>