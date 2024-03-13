<?php
// Include the file with the database connection
include("db_connect.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $username = $_POST['user_nam'];
    $password = $_POST['pass'];
    $employeeID = $_POST['empid'];
    $email = $_POST['email'];
    $join_date = $_POST['join_date']; // Assuming the format is 'MM/DD/YYYY'
    $role = $_POST['role'];
    $address = $_POST['address'];

//strtotime function converts date or time string written in natural/human language into unix timestamps i.e(1261522 number in second) 
// & by using function date(), it converts into standard date format i.e ("2022-04-03").
// "2022-04-03" is a string in programming terminology.

    // Construct a SQL query to insert data into the 'employee_details' table
    $insertQuery = "INSERT INTO add_detail(username, user_pass, employee_id, email, joining_date, role, address) 
                    VALUES ('$username', '$password', $employeeID, '$email', '$join_date', '$role', '$address')";

   
    // Execute the SQL query
    if ($conn->query($insertQuery) === TRUE) {
        header('location:viewdetail.php');
    } else {
        echo "Invalid: " . $insertQuery . "<br>" . $conn->error;
    }
}
?>

