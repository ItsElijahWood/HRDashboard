<?php
  include_once(__DIR__ . "/../include/session.php");
  include(__DIR__ . "/../controllers/data/data_fetch_employee.php");
  include(__DIR__ . "/../include/render/renderEmployeeDivs.php");

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
        <div class="dataSelectorM">
          <div class="groupButtons" onclick="highlightDiv(this); loadMyEmployees()">
            <img class="myPeopleImg" src="../assets/img/My_People.png" alt="My People Logo"></img>
            <p class="myemployeebtn">My People</p>
          </div>
          <div class="groupButtons" onclick="highlightDiv(this); clearEmployee()">
            <img class="myRecruitmentImg" src="../assets/img/Recruitment.png" alt="My Recruitment Logo"></img>
            <p class="recruitmentbtn">Recruitment</p>
          </div>
          <div class="groupButtons" onclick="highlightDiv(this); clearEmployee()">
            <img class="myManageImg" src="../assets/img/Manage_Time.png" alt="Manage Time Logo"></img>
            <p class="managetimebtn">Manage Time</p>
          </div>
        </div>
      </div>
    <div class="search">
      <input type="text" id="searchBar" oninput="searchEmployees()" placeholder="Search Employees..." />
    </div>
    <div class="mgroup">
      <div class="group1">
        <div style="display: none;" id="leftsidebar1" class="leftsidebar1">
          <h3 class="lsb1h3">Manage Panel</h3>
          <div class="lsb1d" onclick="window.location.href='<?php echo $fulldir['base_url']; ?>/public/panel/addperson'">
            <a class="lsp" onclick="window.location.href='<?php echo $fulldir['base_url']; ?>/public/panel/addperson'">Add Person</a>
          </div>
          <div class="lsb1d" onclick="window.location.href='<?php echo $fulldir['base_url']; ?>/public/panel/addjobtitle'">
            <a class="lsp" onclick="window.location.href='<?php echo $fulldir['base_url']; ?>/public/panel/addjobtitle'">Add Job Title</a>
          </div>
          <div class="lsb1d" onclick="window.location.href='<?php echo $fulldir['base_url']; ?>/public/panel/add_department'">
            <a class="lsp" onclick="window.location.href='<?php echo $fulldir['base_url']; ?>/public/panel/add_department'">Add Department</a>
          </div>
          <div class="lsb1d">
            <a class="lsp" onclick="">Browse Starters</a>
          </div>
          <div class="lsb1d">
            <a class="lsp" onclick="">Browse Leavers</a>
          </div>
        </div>
      </div>
      <div class="employee-data" id="employeeDataContainer">
      </div>
    </div>
    <?php else: ?>
    <?php endif; ?>
    <script>
      function highlightDiv(elm) {
        const divs = document.querySelectorAll('.groupButtons');
        divs.forEach(div => div.classList.remove('active'))
        elm.classList.add('active'); 
      }
      
      function loadMyEmployees() {
          const search = document.getElementById("searchBar");
          const leftsidebar1 = document.getElementById("leftsidebar1");
      
          if (search.style.display === "flex") {
              return;
          }
      
          search.style.display =
              search.style.display === 'none' || search.style.display === ""
              ? "flex"
              : "none";
      
          if (window.innerWidth >= 480) {
              leftsidebar1.style.display =
                  leftsidebar1.style.display === 'none' || leftsidebar1.style.display === ""
                  ? "block"
                  : "none";
          }
      
          fetch("../controllers/initialiseData/getEmployeeData.php")
              .then((response) => response.text())
              .then((data) => {
              // Update employee data container with the content.
              document.getElementById("employeeDataContainer").innerHTML = data;
          })
          .catch((error) => console.error("Error fetching employee data:", error));
          }
      
      function clearEmployee() {
          const search = document.getElementById("searchBar");
          const leftsidebar1 = document.getElementById("leftsidebar1");
      
          search.style.display =
              search.style.display === 'none' || search.style.display === ""
              ? "none"
              : "none";
      
          if (window.innerWidth >= 480) {
              leftsidebar1.style.display =
                  leftsidebar1.style.display === '' || leftsidebar1.style.display === ""
                      ? "none"
                      : "none";
          }
      
      
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