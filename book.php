<?php
// Database connection settings
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username (default is 'root' in XAMPP)
$password = ""; // Change this to your MySQL password (default is empty in XAMPP)
$dbname = "cafeblink"; // Change this to your existing database name

// Create connection
$conn = new mysqli($servername, $username, $password, $cafeblink);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$guests = $_POST['guests'];

// SQL to insert reservation data into the table
$sql = "INSERT INTO reservations (name, phone, reservation_date, start_time, end_time, guests)
        VALUES ('$name', '$phone', '$date', '$start_time', '$end_time', '$guests')";

if ($conn->query($sql) === TRUE) {
    echo "Reservation submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
