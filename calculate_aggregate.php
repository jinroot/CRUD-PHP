<?php

include_once 'credentials.php';


// Function to get total number of apps
function getTotalApps($conn) {
    $sql = "SELECT COUNT(*) AS total_apps FROM app";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total_apps'];
}

// Function to get average number of apps per user
function getAverageAppsPerUser($conn) {
    $sql = "SELECT AVG(app_count) AS avg_apps_per_user FROM (SELECT COUNT(*) AS app_count FROM app GROUP BY person_idperson) AS app_counts";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['avg_apps_per_user'];
}

// Function to get most common country of users
function getMostCommonCountry($conn) {
    $sql = "SELECT country, COUNT(*) AS user_count FROM person GROUP BY country ORDER BY user_count DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['country'];
}

// Check which function to call based on the requested operation
if (isset($_GET['operation'])) {
    $operation = $_GET['operation'];
    switch ($operation) {
        case 'total_apps':
            echo getTotalApps($conn);
            break;
        case 'average_apps_per_user':
            echo getAverageAppsPerUser($conn);
            break;
        case 'most_common_country':
            echo getMostCommonCountry($conn);
            break;
        default:
            echo "Invalid operation";
    }
}

// Close connection
$conn->close();
?>
