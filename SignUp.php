<?php
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

// Initialize variables to store messages and error status
$message = "";
$error = false;

// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // Get the user's entered password

    // Check if matric already exists
    $checkMatricQuery = "SELECT * FROM user WHERE matric = ?";
    $stmtCheckMatric = $conn->prepare($checkMatricQuery);
    $stmtCheckMatric->bind_param("s", $matric);
    $stmtCheckMatric->execute();
    $stmtCheckMatric->store_result();

    if ($stmtCheckMatric->num_rows > 0) {
        $message = "You're already signed up! Go to the login page.";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Use prepared statements to insert user data into the "users" table
        $stmt = $conn->prepare("INSERT INTO user (matric, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $matric, $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $message = "You have successfully signed up! Go to the login page.";
        } else {
            $error = true;
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmtCheckMatric->close();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Result</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <div class="container">
        <h2>Registration Result</h2>

        <?php
        if ($message !== "") {
            $messageClass = $error ? 'error' : 'success';
            echo "<p class='message $messageClass'>$message</p>";

            // Display the "Go to Login" button
            echo "<button id='loginButton' onclick='goToLoginPage()'>Go to Login</button>";
        }
        ?>
    </div>

    <script>
        function goToLoginPage() {
            // Redirect to the login page
            window.location.href = "login.html"; // Change this to the actual login page URL
        }

        // Show the "Go to Login" button when the page loads
        document.addEventListener('DOMContentLoaded', function () {
            var loginButton = document.getElementById('loginButton');
            if (loginButton) {
                loginButton.style.display = 'block';
            }
        });
    </script>
</body>

</html>
