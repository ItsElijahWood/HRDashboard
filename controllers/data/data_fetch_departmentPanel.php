<?php
/*
 * Copyright (c) 2025 Elijah Wood. All rights reserved.
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Proprietary and confidential.
 */
namespace HRDashboard\Controller\Data;

class FetchDepartment {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }
	
	// Get departments row from contract and set data into Departments array
  public function getDepartment() {
    $Departments = [];
    $sqlAll = "SELECT DISTINCT `Department` FROM contract";
    $stmtAll = $this->conn->prepare($sqlAll);

    if ($stmtAll) {
       $stmtAll->execute();
       $resultAll = $stmtAll->get_result();

       while ($row = $resultAll->fetch_assoc()) {
           $Departments[] = $row['Department'];
       }
       $stmtAll->close();
    }

    return ['departments' => $Departments];
  }

	// Gets param from $_POST updates on Employee ID found in database 
  public function updateDepartment($userId, $newDepartment) {
    $sqlUpdate = "UPDATE identity SET `Department` = ? WHERE `Employee ID` = ?";
    $stmtUpdate = $this->conn->prepare($sqlUpdate);

    if ($stmtUpdate) {
      $stmtUpdate->bind_param('ss', $newDepartment, $userId);
      $stmtUpdate->execute();
      $stmtUpdate->close();
    }
  }
}
?>