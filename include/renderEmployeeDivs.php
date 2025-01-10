<?php
$fulldir = require(__DIR__ . '/../config/config.php');

function renderDivs($data, $fields) {
    global $fulldir; 

    echo '<div class="employee-data">';
    
    // Add header row.
    echo '<div class="employee-row header-row">';
    foreach ($fields as $field) {
        echo '<div class="employee-column header-column">' . htmlspecialchars($field) . '</div>';
    }
    echo '</div>'; 
    
    // Add employee data rows.
    foreach ($data as $row) {
        echo '<div class="employee-row">';
        foreach ($fields as $field) {
            $content = htmlspecialchars($row[$field] ?? 'N/A');
            
            $employeeId = htmlspecialchars($row['Employee ID'] ?? 'null'); 
            
            $baseUrl = htmlspecialchars($fulldir['base_url'] . '/public/id/user');
            echo "<div class='employee-column' onclick=\"window.location.href='$baseUrl?id=$employeeId';\">$content</div>";
        }
        echo '</div>';
    }

    echo '</div>'; 
}
?>
