<?php
  include_once(__DIR__ . "/../include/session.php");
  include(__DIR__ . "/../controllers/data_fetch_employee.php");
  include(__DIR__ . "/../include/renderEmployeeDivs.php");

  $userSession = new \HRDashboard\Include\UserSession;

  if ($userSession->isAuthenticated()) {
    $user = $userSession->getUser();
    $pageButtonTitle = "Manage";
  } else {
    $user = null;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse People</title>
  <link rel="icon" href="../assets/img/favicon.png" type="image/png">
  <link rel="stylesheet" href="../assets/css/manage.css" />
</head>
<body>
    <?php include(__DIR__ . "/../include/header.php"); ?>
    <?php include(__DIR__ . "/../include/buttonHeader.php"); ?>

    <?php if (isset($user)): ?>
        <div class="dataSelector">
            <a class="myemployeebtn" onclick="highlightBtn(this); loadMyEmployees()">My Employees</a>
            <a class="recruitmentbtn" onclick="highlightBtn(this); clearEmployee()">Recruitment</a>
            <a class="managetimebtn" onclick="highlightBtn(this); clearEmployee();">Manage Time</a>
        </div>
        <input style="display: none;" type="text" id="searchBar" oninput="searchEmployees()" placeholder="Search Employees..." />
        <div class="employee-data" id="employeeDataContainer">
        </div>
    <?php else: ?>
    <?php endif; ?>
    <script>
        function highlightBtn(elm) {
            const buttons = document.querySelectorAll('.dataSelector a');
            buttons.forEach(button => button.classList.remove('active'));
            elm.classList.add('active');
        }

        function loadMyEmployees() {
            const search = document.getElementById("searchBar");

            search.style.display =
                search.style.display === 'none' || search.style.display === ""
                ? "block"
                : "none";

            fetch("../controllers/getEmployeeData.php")
                .then((response) => response.text())
                .then((data) => {
                // Update employee data container with the content.
                document.getElementById("employeeDataContainer").innerHTML = data;
            })
            .catch((error) => console.error("Error fetching employee data:", error));
        }

        function clearEmployee() {
            const search = document.getElementById("searchBar");

            search.style.display =
                search.style.display === 'none' || search.style.display === ""
                ? "block"
                : "none";

            document.getElementById('employeeDataContainer').innerHTML = '';
        }

        function searchEmployees() {
            const query = document.getElementById("searchBar").value.toLowerCase();

            fetch("../controllers/searchEmployeeData.php?query=" + query)
                .then((response) => response.text())
                .then((data) => {
                    document.getElementById("employeeDataContainer").innerHTML = data;
                })
                .catch((error) => console.error("Error fetching employee data:", error));
            }
    </script>
</body>
</html>
