<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the delete logic here
    // Retrieve data from the form
    $userId = $_POST["id"];

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

    // Delete user from the database
    $stmt = $conn->prepare("DELETE FROM user WHERE id=?");
    $stmt->bind_param("i", $userId);
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
    <title>Delete User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Delete User</h2>
            <form method="post" action="delete_user.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
                <div class="form-group">
                    <label for="user_id">User ID:</label>
                    <input type="text" id="user_id" name="id" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-danger">Delete User</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
