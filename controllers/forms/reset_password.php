<?php
/*
 * Copyright (c) 2025 Elijah Wood. All rights reserved.
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Proprietary and confidential.
 */
namespace HRDashboard\Controller\Forms;

require_once(__DIR__ . '/../../include/database/hrdata.php');

$is_invalid = false;

// Gets passwords from POST, selects row based on email
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$connConfig = new \HRDashboard\Include\ConnConfig;
	$conn = $connConfig->getConnection();

	$email = $conn->real_escape_string($_POST["email"]);
	$old_password = $_POST["old_password"];
	$new_password = $_POST["new_password"];

	$sql = "SELECT * FROM users WHERE Email = '$email'";

	$result = $conn->query($sql);
	if (!$result) {
			die("Query Error: " . $conn->error);
	}

	$user = $result->fetch_assoc();

	if ($user) {
			// Verify old password
			if (password_verify($old_password, $user['Password'])) {
					if (!empty($new_password)) {
							$hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);

							$updateSql = "UPDATE users SET Password = '$hashedPassword' WHERE Email = '$email'";

							if ($conn->query($updateSql)) {
									echo "Password reset successfully.";
									header("Location: ../../");
									exit;
							} else {
									echo "Error updating password.";
							}
					} else {
							echo "Please enter a new password.";
					}
			} else {
					echo "Incorrect old password.";
			}
	} else {
			echo "No user found with this email address.";
	}
}
?>