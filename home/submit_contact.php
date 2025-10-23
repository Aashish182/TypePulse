<?php
// Database credentials
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "typepulse";  // The name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // SQL query to insert data into the contact_form table
    $sql = "INSERT INTO contact_form (name, email, message) 
            VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Your message has been sent successfully.');
            window.location.href = 'contact.html';
          </script>";
} else {
    echo "<script>
            alert('Error occurred while sending your message. Please try again.');
            window.location.href = 'contact.html';
          </script>";
}

    // Close the connection
    $conn->close();
}
?>
