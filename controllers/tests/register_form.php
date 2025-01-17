Only a testing file not to be used in production
<?php
  $mysqli = require_once __DIR__ . "/../../include/database/hrdata.php";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = mysqli_real_escape_string($mysqli, $_POST['user']);
    $pass = $_POST['password'];
    $age = (int) $_POST['age'];
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
    
    if (empty($user) || empty($pass) || empty($age) || empty($email) || empty($gender)) {
      echo "All fields required";
      exit;
    }

    $sql = "SELECT ID FROM users WHERE Username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
      echo "Username already took";
      exit;
    }

    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (Username, Password, Email) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sss', $user, $hashedPassword, $email);
    
    if ($stmt->execute()) {
      header("Location: ../../");
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
  }
?>

Incase of trouble signing up 👇
<form action="./controllers/register_form.php" method="POST">
        <label for="username">User:</label><br>
        <input type="text" id="user" name="user" required><br><br>

        <label for="password">pass:</label><br>
        <input type="text" id="password" name="password" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age" required><br><br>

        <label for="sex">Sex:</label><br>
        <input type="text" id="gender" name="gender" required><br><br>

        <button type="submit">Submit</button>
</form>
