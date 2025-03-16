<?php
session_start();

// Get the form data for login
$foremail = $_POST['foremail'];
$forpassword = $_POST['forpassword'];

// Create a connection to the database
$conn = new mysqli('localhost', 'root', '', 'amazon');  // Ensure 'localhost' is correct

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);  // Handle connection errors
}

// Check if the email exists in the register table
$stmt = $conn->prepare("SELECT * FROM register WHERE email = ?");
$stmt->bind_param("s", $foremail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Error: No user found with this email.";
} else {
    $user = $result->fetch_assoc();

    // Check password (plaintext for now)
    if ($forpassword === $user['password']) {
        // Set session
        $_SESSION["user"] = $foremail;

        // Redirect and show success message
        echo "<p style='color: green; font-size: 20px;'>Login successful! Redirecting...</p>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'index.html';
                }, 2000);
              </script>";
        exit;
    } else {
        echo "Error: Incorrect password.";
    }
}

$stmt->close();
$conn->close();
?>
