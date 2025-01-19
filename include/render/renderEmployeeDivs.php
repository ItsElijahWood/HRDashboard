<?php

// Renders divs from database data
function renderDivs($employeeData, $jobTitleData, $departmentData) {  
    $config = include __DIR__ . '/../../config/config.php';

    echo '<div class="employee-data">';
    
    // Add header row.
    echo '<div class="employee-row header-row">';
    echo '<div class="employee-column header-column">Full Name</div>';
    echo '<div class="employee-column header-column">Job Title</div>';
    echo '<div class="employee-column header-column">Department</div>';
    echo '</div>'; 
    
    // Check if employee data exists.
    if (empty($employeeData)) {
        echo '<div class="employee-row"><div class="employee-column">No employee data available.</div></div>';
        return;
    }

    // Render each employee's data.
    foreach ($employeeData as $row) {
        echo '<div class="employee-row">';
        
        // Safely retrieve employee details.
        $title = htmlspecialchars($row['Title'] ?? '');
        $firstName = htmlspecialchars($row['Legal first name'] ?? '');
        $lastName = htmlspecialchars($row['Legal last name'] ?? '');
        $fullName = trim("$title $firstName $lastName") ?: 'Unknown Name';

        $employeeId = htmlspecialchars($row['Employee ID'] ?? 'null');

        $baseUrl = htmlspecialchars($config['base_url'] . '/public/id/user');

        // Render employee details.
        echo "<div class='employee-column' onclick=\"window.location.href='$baseUrl?id=$employeeId';\">$fullName</div>";
        foreach($jobTitleData['jobTitles'] as $row2) {
            $jobTitleEsc = htmlspecialchars($row2);
            echo "<div class='employee-column' onclick=\"window.location.href='$baseUrl?id=$employeeId';\">$jobTitleEsc</div>";
        }
        foreach($departmentData['departments'] as $row3) {
            $departmentEsc = htmlspecialchars($row3);
            echo "<div class='employee-column' onclick=\"window.location.href='$baseUrl?id=$employeeId';\">$departmentEsc</div>";
        }
        
        echo '</div>';
    }

    echo '</div>'; 
}
?>