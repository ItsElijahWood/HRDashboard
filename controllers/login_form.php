<?php
namespace HRDashboard\Controller;

require_once(__DIR__ . '/../include/hrdata.php');

$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $connConfig = new \HRDashboard\Include\ConnConfig;
    $conn = $connConfig->getConnection();

    // Prepare the SQL query
    $sql = sprintf("SELECT * FROM users WHERE email = '%s'",
        $conn->real_escape_string($_POST["email"])
    );

    // Execute the SQL query
    $result = $conn->query($sql);
    if (!$result) {
        die("Query Error: " . $conn->error);
    }

    // Fetch the user data
    $user = $result->fetch_assoc();

    // Check if user's data fetched and users pass is set.
    // Checks both passwords from hashed and see if its the same.
    if ($user && isset($user["password"])) {
        if (password_verify($_POST["password"], $user["password"])) {
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];

            header("Location: ../");
            exit;
        } else {
            echo "Password verification failed.";
        }
    } else {
        echo "No user found with this email or invalid password field.";
    }

    $is_invalid = true;
}
?>
