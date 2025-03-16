<?php
// Check if the form data is submitted using POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data from the frontend
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Check if any of the fields are empty
    if (empty($name) || empty($email) || empty($number) || empty($subject) || empty($message)) {
        echo "Error: Please fill in all the fields before sending your message.";
        exit; // Stop the script execution if fields are empty
    }

    // Create a connection to the database
    $conn = new mysqli('localhost', 'root', '', 'amazon');  // Change 'amazon' to your actual database name

    // Check if the connection is successful
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare the SQL query to insert data into the 'contact_form' table
    $stmt = $conn->prepare("INSERT INTO contact (name, email, number, subject, message) VALUES (?, ?, ?, ?, ?)");

    // Bind the form data to the SQL query
    $stmt->bind_param("sssss", $name, $email, $number, $subject, $message);  // "sssss" means 5 string parameters

    // Execute the query
    if ($stmt->execute()) {
        echo "Your message has been sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
