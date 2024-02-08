<?php
// Include the file with the database connection
include("db_connect.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $fullName = $_POST['fullnam'];
    $username = $_POST['username'];
    $employeeID = $_POST['empid'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Construct a SQL query to insert data into the 'employee_details' table
    $insertQuery = "INSERT INTO employee_detail (full_name, username, employee_id, email, address) 
                    VALUES ('$fullName', '$username', $employeeID, '$email', '$address')";

   
    // Execute the SQL query
    if ($conn->query($insertQuery) === TRUE) {
        header('location:viewdetail.php');
    } else {
        echo "Invalid: " . $insertQuery . "<br>" . $conn->error;
    }
}
?>

