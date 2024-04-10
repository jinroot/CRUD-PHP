<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
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
        <h2>Delete User</h2>
        <?php
        include_once 'credentials.php';

        // Retrieve user ID to delete
        $idperson = $_POST['idperson'];

        // Prepare and execute DELETE queries to delete associated data from all tables
        $delete_queries = array(
            "DELETE FROM app WHERE person_idperson = $idperson",
            "DELETE FROM course WHERE person_idperson = $idperson",
            "DELETE FROM hobby WHERE person_idperson = $idperson",
            "DELETE FROM language WHERE person_idperson = $idperson",
            "DELETE FROM project WHERE person_idperson = $idperson",
            "DELETE FROM site WHERE person_idperson = $idperson"
        );

        foreach ($delete_queries as $query) {
            if (!$conn->query($query)) {
                echo "Error deleting data: " . $conn->error;
                $conn->close();
                exit();
            }
        }

        // Prepare and execute DELETE query to delete user from person table
        $sql = "DELETE FROM person WHERE idperson = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idperson);

        if ($stmt->execute()) {
            echo "<p>User and associated data deleted successfully.</p>";
        } else {
            echo "<p>Error deleting user: " . $stmt->error . "</p>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
