<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the update logic here
    // Retrieve data from the form
    $userId = $_POST["user_id"];
    $newUsername = $_POST["new_username"];
    $newMatric = $_POST["new_matric"];
    $newEmail = $_POST["new_email"];
    $newPassword = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

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

    // Update user in the database
    $stmt = $conn->prepare("UPDATE user SET username=?, matric=?, email=?, password=? WHERE id=?");
    $stmt->bind_param("ssssi", $newUsername, $newMatric, $newEmail, $newPassword, $userId);
    $stmt->execute();

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Update User</h2>
            <form method="post" action="update_user.php">
                <div class="form-group">
                    <label for="user_id">User ID:</label>
                    <input type="text" id="user_id" name="user_id" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="new_username">New Username:</label>
                    <input type="text" id="new_username" name="new_username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="new_matric">New Matric:</label>
                    <input type="text" id="new_matric" name="new_matric" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="new_email">New Email:</label>
                    <input type="email" id="new_email" name="new_email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
