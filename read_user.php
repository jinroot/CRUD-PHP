<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search User Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .result {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include_once 'credentials.php';

        // Retrieve search name from form submission
        $searchName = $_POST['searchName'];

        // Prepare SQL statement to retrieve user data from all tables
        $sql = "SELECT p.*, 
                       (SELECT GROUP_CONCAT(appName) FROM app WHERE person_idperson = p.idperson) AS apps,
                       (SELECT GROUP_CONCAT(courseName) FROM course WHERE person_idperson = p.idperson) AS courses,
                       (SELECT GROUP_CONCAT(hobbyName) FROM hobby WHERE person_idperson = p.idperson) AS hobbies,
                       (SELECT GROUP_CONCAT(languageName) FROM language WHERE person_idperson = p.idperson) AS languages,
                       (SELECT GROUP_CONCAT(projectName) FROM project WHERE person_idperson = p.idperson) AS projects,
                       (SELECT GROUP_CONCAT(siteName) FROM site WHERE person_idperson = p.idperson) AS sites
                FROM person p
                WHERE p.fName = ?";

        // Prepare and bind parameters for SQL statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $searchName);

        // Execute query
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Check if any data found
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                echo "<div class='result'>";
                echo "<h3>User Data</h3>";
                echo "First Name: " . $row['fName'] . "<br>";
                echo "Last Name: " . $row['lName'] . "<br>";
                echo "Address: " . $row['Address'] . "<br>";
                echo "City: " . $row['city'] . "<br>";
                echo "Country: " . $row['country'] . "<br>";
                echo "Email: " . $row['Email'] . "<br>";
                echo "Apps: " . $row['apps'] . "<br>";
                echo "Courses: " . $row['courses'] . "<br>";
                echo "Hobbies: " . $row['hobbies'] . "<br>";
                echo "Languages: " . $row['languages'] . "<br>";
                echo "Projects: " . $row['projects'] . "<br>";
                echo "Sites: " . $row['sites'] . "<br>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-danger'>No data found for the given name.</p>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
