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

// Variables to store messages
$message = "";
$error = "";
$inputusername = ""; // Initialize $inputusername

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputusername = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM user WHERE username=?");
    $stmt->bind_param("s", $inputusername);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        // Verify the password using password_verify
        if (password_verify($password, $storedPassword)) {
            // Check if the username contains "admin"
            if (strpos($inputusername, "admin") !== false) {
                header("Location: admin.html");
                exit();
            } 
        } else {
            $error = "Incorrect password";
        }
    } else {
        $error = "User not found. <a href='login.html'>Retry</a>";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EZ resume</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom styles here */
        body {
            background-color: #f8f9fa; /* Change this to your desired background color */
        }

        .jumbotron {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary {
            background-color: #ff5722;
            border-color: #ff5722;
        }

        .btn-primary:hover {
            background-color: #ff7f50;
            border-color: #ff7f50;
        }

        .box-button {
            cursor: pointer;
        }

        .navbar-brand img {
            max-width: 160px; /* Adjust the size of your logo here */
        }

        /* Center and style the Ez Resume title */
        .title {
            font-size: 34px; /* Adjust the size as needed */
            font-weight: bold;
            display: inline-block;
            margin-left: 170px; /* Add some spacing from the logo */
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body>
   <!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <img src="ezresume.png" alt="Ez Resume Logo" class="logo">
            <span class="title">Ez Resume</span>
        </a>
        <div class="ml-auto">
        <?php
        // Display greeting or login/signup buttons based on user login status
        if (!empty($inputusername)) {
            echo "<span class='navbar-text'>Hello, " . htmlspecialchars($inputusername) . "!</span>";
        if (!empty($error)) {
                echo "<div class='alert alert-danger' role='alert'>$error</div>";
        }
        } else {
            // You may add login or signup buttons here if needed
            echo "<span class='navbar-text'>Hello, Guest!</span>";
        }
        ?>

        </div>
    </div>
</nav>


      <!-- Hero Section -->
      <header class="jumbotron text-center">
        <h1 class="display-4">Build Your Resume and Cover Letter</h1>
        <p class="lead">Use Our System to Create a Resume, Craft a Cover Letter, and Submit Your Application to Companies of Your Choice</p>
        <a class="btn btn-primary btn-lg" href="OnboardingTutorial.html">Get Started</a>
    </header>

    <!-- Features Section -->
    <section class="container">
	
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 box-button" onclick="location.href='create.html';">
                    <div class="card-body">
                        <h5 class="card-title"> Resume Builder </h5>
                        <p class="card-text">(Click Here To Create Your Resume</p>
                        <img src="resume.png" alt="Resume" class="img-fluid" style="max-height: 200px">
                    </div>
                </div>
            </div>
			
			<div class="col-md-6">
                <div class="card mb-4 box-button" onclick="location.href='cover_letter_editor.html';">
                    <div class="card-body">
                        <h5 class="card-title"> Email To A Company </h5>
                        <p class="card-text">(Click Here To Upload Your Resume, Cover Letter, and Letter from SPMP)</p>
                        <img src="email.png" alt="Email" class="img-fluid" style="max-height: 200px">
                    </div>
                </div>
            </div>
			
            <div class="col-md-6">
                <div class="card mb-4 box-button" onclick="location.href='cover_letter_editor.html';">
                    <div class="card-body">
                        <h5 class="card-title"> Cover Letter </h5>
                        <p class="card-text">(Click Here To Create A Cover Letter)</p>
                        <img src="coverletter.jpeg" alt="Cover Letter" class="img-fluid" style="max-height: 200px">
                    </div>
                </div>
            </div>
			
			<div class="col-md-6">
<div class="card mb-4 box-button" onclick="location.href='listofcompany.html';">
        <div class="card-body">
            <h5 class="card-title">List of Companies</h5>
            <p class="card-text">(Click here to look for the companies that offering internship)</p>
            <img src="company.png" alt="Company" class="img-fluid" style="max-height: 200px">
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card mb-4 box-button" onclick="window.location.href='https://t.me/+sYLydlTfnQNiZjY1';">
        <div class="card-body">
            <h5 class="card-title">Telegram</h5>
            <p class="card-text">(Click here to join UPLI Telegram Group to stay updated)</p>
            <img src="telegram.png" alt="Telegram" class="img-fluid" style="max-height: 200px">
        </div>
    </div>
</div>
</div>
</section>
<!-- Footer -->
<footer class="bg-light text-center py-3">
        <div class="container">
            <p>&copy; 2023 Ez Resume</p>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
