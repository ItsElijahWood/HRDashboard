<?php
/*
 * Copyright (c) 2025 Elijah Wood. All rights reserved.
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Proprietary and confidential.
 */
namespace HRDashboard\Include\Render;

class RenderUserDivs {
    private $fulldir;

    public function __construct($fulldir) {
        $this->fulldir = $fulldir;
    }

    public function renderDivs($data, $fields) {
        if (!is_array($data)) {
            echo "Data is not an array.";
            return;
        }

        echo '<div class="user-data">';

        // Render header row
        echo '<div class="user-row header-row">';
        foreach ($fields as $field) {      
            echo "<div class='user-column header-column'>" . htmlspecialchars($field) . '</div>';
        }
        echo '</div>';

        // Render data rows
        foreach ($data as $row) {
            echo '<div class="user-row">';
            foreach ($fields as $field) {
                $content = htmlspecialchars($row[$field] ?? 'N/A');
                $userId = htmlspecialchars($row['id'] ?? 'null');
                $baseUrl = htmlspecialchars($this->fulldir['base_url'] . '/public/admin');

                echo "<div class='user-column' onclick=\"window.location.href='$baseUrl?id=$userId';\">$content</div>";
            }
            echo '</div>';
        }

        echo '</div>';
    }
}
