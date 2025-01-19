<?php
/*
 * Copyright (c) 2025 Elijah Wood. All rights reserved.
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Proprietary and confidential.
 */
namespace HRDashboard\Controller\Data;

require_once(__DIR__ . '/../../include/database/hrdata.php');

class FetchUsers {
	private $conn;

	public function __construct() {
		$connConfig = new \HRDashboard\Include\ConnConfig;
		$this->conn = $connConfig->getConnection();
	}

	// Gets the users table and counts id's from users database and returns set int 
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
