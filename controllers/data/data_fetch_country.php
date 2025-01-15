<?php
    require_once(__DIR__ . '/../../include/database/hrdata.php');

    $connConfig = new \HRDashboard\Include\ConnConfig;
    $conn = $connConfig->getConnection();

    function fetchCountryData($conn, $columnNameCY, $tableName = 'data') {

        $columnNameCY = trim($columnNameCY);

        // Query get all data from the Country column.
        $sql = "SELECT $columnNameCY FROM $tableName";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $countryData = [];
            while ($row = $result->fetch_assoc()) {
                // Store the country data in an array.
                $countryData[] = $row[$columnNameCY];
            }
            // Return the country data array.
            return $countryData;
        } else {
            return [];
        }
    }

    // Calculate percentage of each country.
    function calculateCountryPercentages($countryData) {
        $totalCount = count($countryData);
        
        // Filter the country data to keep only strings or integers.
        $countryData = array_filter($countryData, function($value) {
            return is_string($value) || is_int($value);
        });
    
        $countryCounts = array_count_values($countryData);
        $countryPercentages = [];
    
        foreach ($countryCounts as $country => $count) {
            if (empty($country) || !is_string($country)) {
                continue;
            }
    
            $percentage = ($count / $totalCount) * 100;
            // Round to 2 decimal places.
            $countryPercentages[$country] = round($percentage, 2);       
        }
    
        return $countryPercentages;
    }
    

    $columnNameCY = 'Country'; 
    $countryData = fetchCountryData($conn, $columnNameCY);
  
    if (!empty($countryData)) {
        $countryPercentages = calculateCountryPercentages($countryData);
    } else {
        echo "No data available for countries.";
    }
?>
