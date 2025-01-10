<?php
    require(__DIR__ . '/../include/hrdata.php');

    function fetchCountryData($columnNameCY, $tableName = 'data') {
        global $conn;

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
    $countryData = fetchCountryData($columnNameCY);
  
    if (!empty($countryData)) {
        $countryPercentages = calculateCountryPercentages($countryData);
    } else {
        echo "No data available for countries.";
    }
?>
