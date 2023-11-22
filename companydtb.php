<?php
// Establish a connection to the database
$servername = "localhost"; // This is typically the default for XAMPP
$username = "root"; // The default MySQL username for XAMPP
$password = ""; // The default MySQL password for XAMPP
$dbname = "ezresume"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the form
$name = $_POST['name'];
$matric = $_POST['matric'];
$email = $_POST['email'];
$companyName = $_POST['companyName'];
$companyEmail = $_POST['companyEmail'];
$companyAddress = $_POST['companyAddress'];

// SQL query to insert data into the database or update if duplicate matric exists
$sql = "INSERT INTO student_application (name, matric, email, comp_name, comp_email, comp_address)
        VALUES ('$name', '$matric', '$email', '$companyName', '$companyEmail', '$companyAddress')
        ON DUPLICATE KEY UPDATE
        name = VALUES(name), email = VALUES(email), comp_name = VALUES(comp_name),
        comp_email = VALUES(comp_email), comp_address = VALUES(comp_address)";

// Execute the query
if ($conn->query($sql) === TRUE) {
    // Get some data from the database
    $query = "SELECT name, comp_name FROM student_application WHERE matric='$matric'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $studentName = $row['name'];
            $companyName = $row['comp_name'];

            // Display an alert with the retrieved data
            echo "<script>alert('Data inserted successfully. Student Name: $studentName, Company Name: $companyName');</script>";
        }
    }

    // Display a message and button to go back to the homepage
    echo '<div class="container">
            <p class="done-text">You\'re all done !</p>
            <button id="homeButton" onclick="goToHomePage()">Back to Homepage</button>
          </div>';
} else {
    echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '");</script>';
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head content here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            /* Light gray background */
            margin: 0;
            padding: 0;
        }

        .container {
            text-align: center;
            margin-top: 50px;
        }

        .done-text {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 20px;
        }

        #homeButton {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #homeButton:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <!-- Your existing content -->

    <script>
        function goToHomePage() {
            // Modify the URL in window.location.href to the desired home page
            window.location.href = "index.html"; // Change "index.html" to your actual home page URL
        }
    </script>
</body>

</html>
