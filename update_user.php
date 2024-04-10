<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
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
        <h2>Update User</h2>
        <?php
        include_once 'credentials.php';

        // Retrieve form data
        $idperson = $_POST['idperson'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $Address = $_POST['Address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $Email = $_POST['Email'];

        // Prepare SQL statement to update user data
        $sql = "UPDATE person 
                SET fName = ?, lName = ?, Address = ?, city = ?, country = ?, Email = ?
                WHERE idperson = ?";

        // Prepare and bind parameters for SQL statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $fName, $lName, $Address, $city, $country, $Email, $idperson);

        // Execute query
        if ($stmt->execute()) {
            // Fetch updated user data
            $sql_select = "SELECT * FROM person WHERE idperson = ?";
            $stmt_select = $conn->prepare($sql_select);
            $stmt_select->bind_param("i", $idperson);
            $stmt_select->execute();
            $result = $stmt_select->get_result();
            $updated_user = $result->fetch_assoc();

            // Display updated user data
            if ($updated_user) {
                echo "<p>Updated User Data:</p>";
                echo "<p>ID: " . $updated_user['idperson'] . "</p>";
                echo "<p>First Name: " . $updated_user['fName'] . "</p>";
                echo "<p>Last Name: " . $updated_user['lName'] . "</p>";
                echo "<p>Address: " . $updated_user['Address'] . "</p>";
                echo "<p>City: " . $updated_user['city'] . "</p>";
                echo "<p>Country: " . $updated_user['country'] . "</p>";
                echo "<p>Email: " . $updated_user['Email'] . "</p>";
            } else {
                echo "<p>No user found with ID: $idperson</p>";
            }
        } else {
            echo "<p>Error updating user data: " . $conn->error . "</p>";
        }

        // Close statements and connection
        $stmt->close();
        $stmt_select->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
