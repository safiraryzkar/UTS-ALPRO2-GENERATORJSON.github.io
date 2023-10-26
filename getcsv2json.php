<?php

function csvToJson($csvUrl) {
    $csvData = [];
    
    if (($handle = fopen($csvUrl, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            $csvData[] = $row;
        }
        fclose($handle);
    }

    // Assuming the first row of the CSV contains the column headers
    $headers = array_shift($csvData);

    $jsonArray = [];

    foreach ($csvData as $row => $value) {
        if (is_array($value)) {
            $result[$row] = $csvData($value);
        } else {
            $keys = explode($value, $row);
            if (count($keys) > 1) {
                $field = [];
                for ($i = count($keys) - 1; $i >= 0; $i--) {
                    $field[$keys[$i]] = $value;
                    $value = $field;
                    $field = [];
                }
            }

        }
    return json_encode($jsonArray);
}

}
$csvUrl = 'https://testingalpro.alwaysdata.net/api/coffee.csv';
$jsonData = csvToJson($csvUrl);

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;
?>
