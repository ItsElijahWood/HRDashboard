<?php
/*
 * Copyright (c) 2025 Elijah Wood. All rights reserved.
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Proprietary and confidential.
 */
namespace HRDashboard\Controller\Data;

class FetchJobTitle {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

	// Get job titles from the contract table and returns jobTitles array passing variable
  public function getJobTitles() {
    $jobTitles = [];
    $sqlAll = "SELECT DISTINCT `Job title` FROM contract";
    $stmtAll = $this->conn->prepare($sqlAll);

    if ($stmtAll) {
			$stmtAll->execute();
			$resultAll = $stmtAll->get_result();

			while ($row = $resultAll->fetch_assoc()) {
				$jobTitles[] = $row['Job title'];
			}
			$stmtAll->close();
    }

    return ['jobTitles' => $jobTitles];
  }

	// Updating the job title on the correct ID row
  public function updateJobTitle($userId, $newJobTitle) {
    $sqlUpdate = "UPDATE identity SET `Job Title` = ? WHERE `Employee ID` = ?";
    $stmtUpdate = $this->conn->prepare($sqlUpdate);

    if ($stmtUpdate) {
			$stmtUpdate->bind_param('ss', $newJobTitle, $userId);
			$stmtUpdate->execute();
			$stmtUpdate->close();
    }
  }
}
?>