<?php
  include(__DIR__ . "/./include/session.php");
  include(__DIR__ . "/./controllers/data_fetch_counter.php");
  include(__DIR__ . "/./controllers/data_fetch_salary.php");
  include(__DIR__ . "/./controllers/data_fetch_country.php");

  $totalCountEmployees = fetchTotalCount('Employee ID');
  $averageSalary = fetchAverageSalary('Annual Salary');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HR</title>
  <link rel="icon" href="./assets/img/logo.png" type="image/png">
  <link rel="stylesheet" href="./assets/css/index.css" />
</head>
<body>
  <?php include(__DIR__ . "/./include/header.php"); ?>

  <?php if (isset($user)): ?>
    <div class="hremployeedashboard1">
      <h2 class="hremployeedashboard1h2">HR Employee Overview</h2>
      <div class="hremployeedashboardmdiv">
        <div class="hremployeediv1">
          <p class="hremployeediv1p1">Total Employees</p>
          <p class="hremployeediv1p2"><?php echo htmlspecialchars($totalCountEmployees); ?></p> 
        </div>
        <div class="hremployeediv2">
          <p class="hremployeediv2p1">Average Salary</p>
          <p class="hremployeediv2p2"><?php echo htmlspecialchars($averageSalary); ?></p> 
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
    </div>
  <?php else: ?>
    <p>Logged out</p>
  <?php endif; ?>
</body>
</html>
