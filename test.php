<?php

// URL of the REST API
$url = 'http://localhost:3000/api/device?_size=500';

// Fetch data from the API
$response = file_get_contents($url);

// Check if request was successful
if ($response === false) {
    die('Error fetching data from API');
}

// Decode JSON response
$data = json_decode($response, true);

// Check if decoding was successful
if ($data === null) {
    die('Error decoding JSON data');
}

// Print the output
foreach ($data as $device) {
    echo "ID: {$device['ID']} <br>";
    echo "DeviceID: {$device['DeviceID']} <br>";
    echo "Browser: {$device['Browser']} <br>";
    echo "DeviceType: {$device['DeviceType']} <br><br>";
}
?>
