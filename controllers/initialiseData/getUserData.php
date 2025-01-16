<?php
$fulldir = include __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../include/database/hrdata.php';
include_once __DIR__ . '/../../controllers/data/data_fetch_panelusers.php';
include_once __DIR__ . '/../../include/render/renderUsersDivs.php';

$connConfig = new \HRDashboard\Include\ConnConfig;
$conn = $connConfig->getConnection(); 

if (!$conn) {
  die("Connection failed: " . $conn->connect_error);
}

$fetchPanelUsers = new \HRDashboard\Controller\Data\FetchPanelUsers($conn);
$panelUser = $fetchPanelUsers->getUsers();

$renderUserDivs = new \HRDashboard\Include\Render\RenderUserDivs($fulldir);
$renderDivs = $renderUserDivs->renderDivs($panelUser, ['ID', 'Username', 'AccessLevel']);
?>
