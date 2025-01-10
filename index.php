<?php
  include(__DIR__ . "/./include/session.php");
  include(__DIR__ . "/./controllers/data_fetch_counter.php");
  include(__DIR__ . "/./controllers/data_fetch_salary.php");
  include(__DIR__ . "/./controllers/data_fetch_country.php");
  include(__DIR__ . "/./controllers/data_fetch_department.php");

  $totalCountEmployees = fetchTotalCount('Employee ID');
  $averageSalary = fetchAverageSalary('Annual Salary');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="icon" href="./assets/img/logo.png" type="image/png">
  <link rel="stylesheet" href="./assets/css/index.css" />
</head>
<body>
  <?php include(__DIR__ . "/./include/header.php"); ?>

  <?php if (isset($user)): ?>
    <div class="hrmanagemdiv">
      <div class="hrmanagediv1">
        <p class="hrmanagediv1p1">
          Home | 
        </p>
      </div>
      <div class="hrmanagediv2">
        <a 
        class="hrmanagediv2a1" 
        onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/public/manage';" class="button1">Manage
        </a>
      </div>
        <!-- $fullpath from header.php -->
    </div> 
    <div class="hremployeedashboard1">
      <h2 class="hremployeedashboard1h2">HR Employee Overview</h2>
      <div class="hremployeedashboardmdiv">
        <div class="hremployeediv4">
          <p class="hremployeediv3p1">Department Percentage</p>
          <div class="department-percentages">
            <?php
              if (!empty($departmentPercentages)) {
                foreach ($departmentPercentages as $department => $percentage) {
                  echo "<p class='department-entry'>" . htmlspecialchars($department) . ": " . htmlspecialchars($percentage) . "%</p>";
              }
              } else {
                echo "<p>No department data available.</p>";
              }
            ?>
          </div> 
        </div>
        <div class="hremployeegroup1">
          <div class="hremployeediv1">
            <p class="hremployeediv1p1">Total Employees</p>
            <p class="hremployeediv1p2"><?php echo htmlspecialchars($totalCountEmployees); ?></p> 
          </div>
          <div class="hremployeediv3">
          <p class="hremployeediv3p1">Country Percentage</p>
            <div class="country-percentages">
              <?php
                if (!empty($countryPercentages)) {
                  foreach ($countryPercentages as $country => $percentage) {
                    echo "<p class='country-entry'>$country: " . htmlspecialchars($percentage) . "%</p>";
                  }
                } else {
                  echo "<p>No country data available.</p>";
                }
              ?>
            </div> 
          </div>  
        </div>
        <div class="hremployeediv2">
          <p class="hremployeediv2p1">Average Salary</p>
          <p class="hremployeediv2p2"><?php echo htmlspecialchars($averageSalary); ?></p> 
        </div>    
      </div>
    </div>
  <?php else: ?>
    <div class="hroutmdiv">
      <div class="hroutmanagediv1">
        <p class="hroutmanagediv1p1">
          Logged Out | 
        </p>
      </div>
      <div class="hroutmanagediv2">
        <a 
        class="hroutmanagediv2a1" 
        onclick="window.location.href='<?php echo $fullpath['base_url']; ?>/public/login';" class="button1">Login
        </a>
      </div>
    </div> 
  <?php endif; ?>
</body>
</html>
