<?php
session_start();
include("connect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div style="text-align: center; padding:15%;">
        <p style="font-size:50px; font-weight:bold;">
            Hello 
            <?php 
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];

                // Fix the SQL query
                $query = "SELECT name FROM `users` WHERE email='$email'";
                $result = mysqli_query($conn, $query);

                // Check if the query executed successfully
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result); // Use fetch_assoc for clarity
                    echo htmlspecialchars($row['name']); // Prevent XSS attacks
                } else {
                    echo "User not found.";
                }
            } else {
                echo "Guest";
            }
            ?>
            :)
        </p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
