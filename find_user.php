<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel - Find User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Find User</h2>

                <!-- Search form -->
                <form action="find_user_result.php" method="POST">
                    <div class="form-group">
                        <label for="matric">User Matric:</label>
                        <input type="text" class="form-control" id="matric" name="matric" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Find User</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
// find_user_result.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the input value
    $matric = $_POST["matric"];

    // Perform the search in the database
    // Replace this with your database connection and query logic
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ezresume";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming 'users' is the table name
    $sql = "SELECT * FROM user WHERE matric = '$matric'";
    $result = $conn->query($sql);

    // Display the search results
    echo "<div class='container mt-5'>";
    echo "<div class='row justify-content-center'>";
    echo "<div class='col-md-8'>";
    echo "<h2>Search Results for Matric: $matric</h2>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>User found:</p>";
            echo "<p>ID: " . $row["id"] . "</p>";
            echo "<p>Matric: " . $row["matric"] . "</p>";

            // Display all other columns in the 'user' table
            foreach ($row as $key => $value) {
                if ($key !== "id" && $key !== "matric") {
                    echo "<p>$key: $value</p>";
                }
            }
        }
    } else {
        echo "<p>No user found with the given matric.</p>";
    }

    echo "</div>";
    echo "</div>";
    echo "</div>";

    $conn->close();
} else {
    // Redirect if accessed without a form submission
    header("Location: find_user.php");
    exit();
}
?>
