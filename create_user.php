<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
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
    </style>
</head>
<body>
    <div class="container">
        <?php
        include_once 'credentials.php';

        // Prepare and bind parameters for person table
        $stmt_person = $conn->prepare("INSERT INTO person (fName, lName, Address, city, country, Email) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_person->bind_param("ssssss", $fName, $lName, $Address, $city, $country, $Email);

        // Set parameters for person table
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $Address = $_POST['Address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $Email = $_POST['Email'];

        // Execute insertion into person table
        if ($stmt_person->execute()) {
            // Retrieve the last inserted person ID
            $person_id = $conn->insert_id;

            // Insert into associated tables
            $tables = array("app", "course", "hobby", "language", "project", "site");
            foreach ($tables as $table) {
                $fieldName = $table . "Name";
                for ($i = 0; $i <= 3; $i++) {
                    if (!empty($_POST[$fieldName][$i])) {
                        // Prepare and bind parameters for associated table
                        $stmt_associated = $conn->prepare("INSERT INTO $table ($fieldName, person_idperson) VALUES (?, ?)");
                        $stmt_associated->bind_param("si", $_POST[$fieldName][$i], $person_id);
                        $stmt_associated->execute();
                        $stmt_associated->close();
                    }
                }
            }
            echo "<p class='text-success'>New record created successfully</p>";
        } else {
            echo "<p class='text-danger'>Error: " . $stmt_person->error . "</p>";
        }

        // Close statement and connection
        $stmt_person->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
