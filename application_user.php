
<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ezresume";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the search query
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];

    // Use a prepared statement to prevent SQL injection
    $sql = "SELECT * FROM student_application WHERE matric = ?";
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("s", $searchTerm);

    // Execute the statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Search Results:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Matric</th>
                    <th>name</th>
                    <th>Email</th>
                    <th>Company name</th>
                    <th>Company email</th>
                    <th>Company address</th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["matric"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["comp_name"] . "</td>
                    <td>" . $row["comp_email"] . "</td>
                    <td>" . $row["comp_address"] . "</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No results found.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Student Search</h2>
    <form method="post" action="application_user.php">
        <label for="searchTerm">Matric Number:</label>
        <input type="text" id="searchTerm" name="searchTerm" required>
        <input type="submit" name="search" value="Search">
    </form>
</body>
</html>

 