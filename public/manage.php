<?php
  $pageTitle = "Manage";
  include("../include/session.php");
  include("../controllers/data_fetch_employee.php");
  include("../include/renderEmployeeDivs.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HR Manage Employees</title>
  <link rel="icon" href="../assets/img/logo.png" type="image/png">
  <link rel="stylesheet" href="../assets/css/manage.css" />
</head>
<body>
   <?php include("../include/header.php"); ?>

   <?php if (isset($user)): ?>
   <?php $employeeData = fetchEmployeeData(); ?>
        <div class="dataSelector">
            <a class="myemployeebtn" onclick="highlightBtn(this)">My Employees</a>
            <a class="recruitmentbtn" onclick="highlightBtn(this)">Recruitment</a>
            <a class="managetimebtn" onclick="highlightBtn(this)">Manage Time</a>
        </div>
        <div class="employee-data">
            <?php renderDivs($employeeData, ['Full Name', 'Job Title', 'Department']); ?> 
        </div>
   <?php else: ?>
        <form action="../controllers/login_form.php" method="POST">
            <input class="fieldForm" type="email" name="email" id="email" placeholder="Email"
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required><br><br>
            <input class="fieldForm" type="password" name="password" id="password" placeholder="Password" required><br><br>
            <button class="buttonForm" type="submit">Log in</button>
        </form>
   <?php endif; ?>
    <script>
        function highlightBtn(elm) {
            const buttons = document.querySelectorAll('.dataSelector a');
            buttons.forEach(button => button.classList.remove('active'));
            elm.classList.add('active');
        }
    </script>
</body>
</html>
