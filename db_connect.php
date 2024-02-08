<?php
$host = "localhost:3307";
$user = "root";
$password = '';
$db_name = "hr";

// Attempt to create a connection using the procedural style
$conn = mysqli_connect($host, $user, $password, $db_name);

// Check if the connection was successful 
if (!$conn) {
    
    die("Connection Failed: " . mysqli_connect_error());
}
?>
