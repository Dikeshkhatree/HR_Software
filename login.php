<?php
session_start();
// Include the file with the database connection
include("db_connect.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
//if form is submitted, it retrieves the values from submitted form using $_POST.
 //OR it Retrieve values from the submitted form
    $username = $_POST['username'];
    $password = $_POST['pass'];   

// SQL query to check if the provided username and password exist in the 'admin' table
$checkadmin = "SELECT * from admin WHERE (user_name='$username' OR email='$username') AND user_pass='$password'";

// SQL query to check if the provided username and password exist in the 'employee' table
$checkemployee = "SELECT * from employee WHERE (username='$username' OR email='$username') AND user_pass='$password'";

// Execute the SQL query
$resultadmin = $conn->query($checkadmin);
$resultemployee = $conn->query($checkemployee);

// Check if the number of rows returned by the query is greater than zero
 // Check if the username and password match in the admin table
if ($resultadmin->num_rows > 0) {

// fetch the data from the admin table
  $database_fetch = $resultadmin->fetch_assoc();

 // $_SESSION['user'] is a session variable named "user" which holds value of 'user_name' from database
  $_SESSION['user'] = $database_fetch ['user_name']; // this 'user_name' is database field name

    // If rows are returned, redirect to the home.php page
    header("Location: home.php");
    exit();
} elseif ($resultemployee->num_rows > 0){

// fetch the data from the admin table
$database_fetch = $resultemployee->fetch_assoc();

// $_SESSION['user'] is a session variable named "user" which holds value of 'user_name' from database
 $_SESSION['user'] = $database_fetch ['username']; // this 'user_name' is database field name
 
 // Redirect to the dashboard.php page
 header("Location: dashboard.php");
 exit();
} else {
    // If no rows are returned, print "Invalid" 
    echo "Invalid"; 
    echo '<script>
    alert("Invalid username or password. Please try again.");
    window.location.href = "loginpage.php";
  </script>';
}
}
  // Close the database connection
$conn->close();

?>
