<?php
// Include the database connection file
include('db_connect.php');
// Start session
session_start();

if(isset($_POST['add_schedule'])){
    $employeeID = $_POST['employeeid'];
    $start_time = $_POST['time_in'];
    $end_time = $_POST['time_out'];
   
    //strtotime function converts date or time string written in natural/human language into unix timestamp & by using date() function, it converts into standard time format i.e ('H:i:s').
    $start_time = date('H:i:s', strtotime($start_time)); // 'H:i:s' is a standard time format => 24hour format that defines time only
    $end_time = date('H:i:s', strtotime($end_time));
    
    // Check if the employee ID exists in the employee table
    $check_query = "SELECT * FROM employee WHERE employee_id = $employeeID";
    $result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($result) == 0) {
        // Employee ID not found, set error message
        $_SESSION['error_message'] = "Employee ID not found.";
        header("Location: add_schedule.php");
        exit(); // Stop further execution
    } else {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username']; // to print username also in schedule table
        $insertQuery = "INSERT INTO schedule (employee_id, username, start_time, end_time) VALUES ($employeeID, '$username', '$start_time', '$end_time')";
    
        // Execute the SQL query
        if (mysqli_query($conn, $insertQuery)) {
            // Schedule added successfully, set success message
            $_SESSION['success_message'] = "Schedule added successfully !";
            header("Location: add_schedule.php");
            exit();
        } else {
            // Display error message if query execution fails
            $_SESSION['error_message'] = "Invalid: " . $insertQuery . "<br>" . mysqli_error($conn);
            header("Location: add_schedule.php");
            exit();
        }
    }
}
?>
