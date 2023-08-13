<?php
// Database configuration
$host = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$database = "your_db_name";

// Establish database connection
$connection = new mysqli($host, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Get form data
$fullName = $_POST["fullName"];
$phoneNumber = $_POST["phoneNumber"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];
$ipAddress = $_SERVER["REMOTE_ADDR"]; // User's IP address

// Insert data into database
$insertQuery = "INSERT INTO contact_form (full_name, phone_number, email, subject, message, ip_address, timestamp) VALUES ('$fullName', '$phoneNumber', '$email', '$subject', '$message', '$ipAddress', NOW())";
if ($connection->query($insertQuery) === TRUE) {
    // Send email notification
    $to = "test@techsolvitservice.com";
    $subjectEmail = "New Contact Form Submission";
    $messageEmail = "A new contact form submission has been received:\n\nFull Name: $fullName\nPhone Number: $phoneNumber\nEmail: $email\nSubject: $subject\nMessage: $message\nIP Address: $ipAddress";
    mail($to, $subjectEmail, $messageEmail);

    // Display success message
    echo "Form submitted successfully!";
} else {
    // Display error message
    echo "Error: " . $insertQuery . "<br>" . $connection->error;
}

// Close database connection
$connection->close();
?>
