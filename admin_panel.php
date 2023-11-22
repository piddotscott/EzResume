<?php
// Separate PHP code for better organization

function getUserCount() {
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

    $userCountQuery = "SELECT COUNT(*) as total_users FROM user";
    $result = $conn->query($userCountQuery);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $output = "<p>Total users: " . $row["total_users"] . "</p>";
    } else {
        $output = "<p>Error retrieving user count.</p>";
    }

    // Close the database connection
    $conn->close();

    return $output;
}

function getUserList() {
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

    $userListQuery = "SELECT id, username FROM user";
    $result = $conn->query($userListQuery);

    if ($result && $result->num_rows > 0) {
        $output = "<ul>";
        while ($row = $result->fetch_assoc()) {
            $output .= "<li>User ID: " . $row["id"] . ", Username: " . $row["username"] . "</li>";
        }
        $output .= "</ul>";
    } else {
        $output = "<p>No users found.</p>";
    }



    // Close the database connection
    $conn->close();

    return $output;
}
