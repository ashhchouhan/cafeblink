



<?php

$host = 'localhost';
$db_name = 'admin';
$user_name = 'root';
$user_password = '';

// Create connection
$con = new mysqli($host, $user_name, $user_password, $db_name);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} /* else {
    echo "Connected successfully";
}*/

?>
