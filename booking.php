<?php
session_start(); // Start the session to store data temporarily

// Check if the form data is submitted using POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data from the frontend
    $place = $_POST['place'];
    $guest = $_POST['guest'];
    $arrive = $_POST['arrive'];
    $leaved = $_POST['leaved'];

    // Check if any of the fields are empty
    if (empty($place) || empty($guest) || empty($arrive) || empty($leaved)) {
        echo "Error: Please fill in all the fields before booking.";
        exit; // Stop the script execution if fields are empty
    }

    // Store the form data in the session
    $_SESSION['booking_data'] = [
        'place' => $place,
        'guest' => $guest,
        'arrive' => $arrive,
        'leaved' => $leaved
    ];

    // Redirect to the payment page
    header("Location: payment.html");
    exit; // Always call exit after header redirect
}
?>
