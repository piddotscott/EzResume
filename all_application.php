<?php
// Database connection (replace with your own credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ezresume";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the 'user' table
$sql = "SELECT * FROM student_application";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>All application</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>matric</th>
                    <th>email</th>
                    <th>comp_name</th>
                    <th>comp_email</th>
                    <th>comp_address</th>
                    <!-- Add more columns based on your table structure -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Display data from the 'user' table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["matric"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["comp_name"] . "</td>";
                        echo "<td>" . $row["comp_email"] . "</td>";
                        echo "<td>" . $row["comp_address"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
