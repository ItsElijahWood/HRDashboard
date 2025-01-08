<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require("../include/hrdata.php");

    // Prepare the SQL query
    $sql = sprintf("SELECT * FROM users WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"])
    );

    // Execute the SQL query
    $result = $mysqli->query($sql);
    if (!$result) {
        die("Query Error: " . $mysqli->error);
    }

    // Fetch the user data
    $user = $result->fetch_assoc();

    if ($user && isset($user["password"])) {
        if (password_verify($_POST["password"], $user["password"])) {
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];

            header("Location: ../index.php");
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
