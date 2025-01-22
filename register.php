if (isset($_POST['login'])) {
    $email = trim($_POST['email']); // Get email from POST
    $password = $_POST['password']; // Get password from POST

    // Query to find user
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['email'] = $row['email'];
            header("Location: homepage.php");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Email not found.";
    }
    $stmt->close();
}
