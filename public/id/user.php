<?php
  $fulldir = include(__DIR__ . '/../../config/config.php');
  include_once(__DIR__ . '/../../include/session.php');
  include(__DIR__ . '/../../controllers/data/data_fetch_employeeIdInfo.php'); 
  include_once __DIR__ . '/../../controllers/data/data_fetch_jobtitle.php';
  include_once __DIR__ . '/../../controllers/data/data_fetch_departmentPanel.php';

  $userSession = new \HRDashboard\Include\UserSession;

  if ($userSession->isAuthenticated()) {
    $user = $userSession->getUser();
    $pageButtonTitle = "Profile";

    $fetchJobTitle = new \HRDashboard\Controller\Data\FetchJobTitle($conn);
    $fetchDepartment = new \HRDashboard\Controller\Data\FetchDepartment($conn);
    $jobData = $fetchJobTitle->getJobTitles();
    $DepartmentData = $fetchDepartment->getDepartment();
    $jobTitles = $jobData['jobTitles'];
    $DepartmentTitle = $DepartmentData['departments'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newJobTitle = $_POST['JobTitle'];
        $newDepartment = $_POST['Department'];
        $userId = $_GET['id']; 
    
        if (!empty($newJobTitle)) {
          $fetchJobTitle->updateJobTitle($userId, $newJobTitle);
        }

        if (!empty($newDepartment)) {
          $fetchDepartment->updateDepartment($userId, $newDepartment);
        }

        $jobTitles = $fetchJobTitle->getJobTitles()['jobTitles'];
        $DepartmentTitle = $fetchDepartment->getDepartment()['departments'];
    }
  } else {
    $user = null;
    $jobTitles = [];
    $DepartmentTitle = [];
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../../assets/css/user.css" />
  </head>
  <body>
    <?php include(__DIR__ . "/../../include/header.php"); ?> 
    <?php include(__DIR__ . "/../../include/buttonHeader.php"); ?>

    <?php if (isset($user)): ?>
    <div class="mainnamediv">
      <div class="mainnamemdiv">
        <div class="mainnamediv2">
          <img 
            class="ProfileIcon" 
            src="<?php echo $fulldir['base_url']; ?>/assets/img/profilelogo.png" 
            alt="Profile Icon"
          />
        </div>
        <div class="mainnamediv3">
          <p class="mainnamediv3p1"><?php echo htmlspecialchars($employeeData['Full Name']); ?></p>
        </div>
      </div>
      <div class="mainnamemdiv2">
        <div class="mainnamemdiv2p1">
          <p><strong class="ml">Position</strong> <?php echo htmlspecialchars($employeeData['Job Title']); ?></p>
        </div>
        <div class="mainnamemdiv2p2">
          <p><strong class="ml">Department</strong> <?php echo htmlspecialchars($employeeData['Department']); ?></p>
        </div>
      </div>
    </div>
    <div class="cutoffdiv1">
      <h3 class="cutoffdiv1p1">Identity</h3>
    </div>
    <form method="POST" action="">
      <div class="postdiv">
      <label for="JobTitle">Job Title</label>
      <select id="JobTitle" name="JobTitle" required>
        <option value="<?= htmlspecialchars($employeeData["Job Title"]) ?>" selected>
          <?= htmlspecialchars($employeeData["Job Title"]) ?>
        </option>
        <?php foreach ($jobTitles as $title): ?>
        <option value="<?= htmlspecialchars($title) ?>" <?= trim($title) === trim($employeeData["Job Title"]) ? 'selected' : '' ?>>
          <?= htmlspecialchars($title) ?>
        </option>
        <?php endforeach; ?>
      </select>
      </div>
      <div class="postdiv">
      <label for="Department">Department</label>
      <select id="Department" name="Department" required>
        <option value="<?= htmlspecialchars($employeeData["Department"]) ?>" selected>
          <?= htmlspecialchars($employeeData["Department"]) ?>
        </option>
        <?php foreach ($DepartmentTitle as $title): ?>
        <option value="<?= htmlspecialchars($title) ?>" <?= trim($title) === trim($employeeData["Department"]) ? 'selected' : '' ?>>
          <?= htmlspecialchars($title) ?>
        </option>
        <?php endforeach; ?>
      </select>
      </div>
      <div class="buttondiv">
        <button class="submit">Save</button>
      </div>
    </form>
    <?php endif; ?>
  </body>
</html>
