<?php
// forgot_password.php

session_start(); // Always start the session at the top

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']); // Sanitize email input

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $conn = new mysqli('localhost', 'root', '', 'amazon');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT email FROM register WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // ✅ Store email in session before sending OTP
            $_SESSION['email'] = $email;

            // ✅ Now include OTP sending script
            include('send_otp.php');

            // ✅ Redirect to OTP verification page
            header("Location: reset_password.html");
            exit();
        } else {
            echo "This email is not registered. Please check your email address or sign up.";
        }

        $stmt->close();
        $conn->close();
    }
}
