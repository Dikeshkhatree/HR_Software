<?php

session_start();

// Include the file with the database connection
include("db_connect.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    // $phone = $_POST['phone'];
    // $email = $_POST['email'];
    $password = $_POST['pass'];
}

// Construct a SQL query to check if the provided username and password exist in the 'admin' table
$check = "SELECT * from admin WHERE user_name='$username' AND user_pass='$password'";

// Execute the SQL query
$result = $conn->query($check);

// Check the number of rows returned by the query
if ($result->num_rows == 0) {
    
    // If no rows are returned, print "Invalid"
    echo "Invalid"; 
    echo '<script>
    alert("Invalid username or password. Please try again.");
    window.location.href = "loginpage.php";
  </script>';
} else {
    // user is session variable here & named it as u wish
    $_SESSION['user']=$username;
    // If rows are returned, redirect to the home.php page
    header("Location: home.php");
}
?>
