<?php
function renderDivs($data, $fields) {
    echo '<div class="employee-data">';
    
    // Add header row
    echo '<div class="employee-row header-row">';
    foreach ($fields as $field) {
        echo '<div class="employee-column header-column">' . htmlspecialchars($field) . '</div>';
    }
    echo '</div>'; 
    
    // Add employee data rows
    foreach ($data as $row) {
        echo '<div class="employee-row">';
        foreach ($fields as $field) {
            echo '<div class="employee-column">' . htmlspecialchars($row[$field] ?? 'N/A') . '</div>';
        }
        echo '</div>'; 
    }

    echo '</div>'; 
}
?>