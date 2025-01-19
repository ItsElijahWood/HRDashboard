<?php 
/*
 * Copyright (c) 2025 Elijah Wood. All rights reserved.
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Proprietary and confidential.
 */
namespace HRDashboard\Controller\Panel;

class AddJobTitle {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

	// Checks the param ($_POST) if it is already stored in database
  private function checkIfInDbAlready($jobTitle) {
    $sql = "SELECT * FROM jobtitles WHERE jobtitle = ?";

    $stmt = $this->conn->prepare($sql); 

    $stmt->bind_param('s', $jobTitle);

    $stmt->execute();

    $result = $stmt->get_result(); 
    
    if ($result->num_rows > 0) {
        return true; 
    } else {
        return false; 
    }
  }

	// Gets param from $_POST addjobtitle.php inside include
  public function addJobTitle($jobTitle) {
    if ($this->checkIfInDbAlready($jobTitle)) {
      throw new \Exception("Job title already exists in the database.");
    }

    $sql = "INSERT INTO jobtitles (`jobtitle`) VALUES (?)";

    $stmt = $this->conn->prepare($sql);

    if ($stmt === false) {
      throw new \Exception("Error preparing stmt addJobTitle.php");
    }

    $stmt->bind_param("s", $jobTitle);

    if (!$stmt->execute()) {
      throw new \Exception("Error while executing sql query addJobTitle.php: Query Passed $jobTitle Error: " . $stmt->error);
    }

    $stmt->close();
  }
}
?>