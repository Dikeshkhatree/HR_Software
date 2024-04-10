<?php
include('db_connect.php');
if(isset($_POST['add_schedule'])){
    $employeeID = $_POST['employeeid'];
    $start_time = $_POST['time_in'];
    $end_time = $_POST['time_out'];
   
 //strtotime function converts date or time string written in natural/human language into unix timestamp & by using date() function, it converts into standard time format i.e ('H:i:s').
    $start_time = date('H:i:s', strtotime($start_time)); // 'H:i:s' is a standard time format => 24hour format that defines time only
    $end_time = date('H:i:s', strtotime($end_time));
    
    // Check if the employee ID exists in the add_detail table
    $check_query = "SELECT * FROM add_detail WHERE employee_id = $employeeID";
    $result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($result) == 0) {
        // Employee ID not found, display popup message
        echo '<script>alert("Employee ID not found.");
        window.location.href = "add_schedule.php";
        </script>';
        exit(); // Stop further execution
    } else {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username']; // to print username also in schedule table
        $insertQuery = "INSERT INTO schedule (employee_id, username, start_time, end_time) VALUES ($employeeID, '$username', '$start_time', '$end_time')";
    
        // Execute the SQL query
        if ($conn->query($insertQuery) === TRUE) {
         // Schedule added successfully, display popup message
            echo '<script>alert("Schedule added successfully !");
        window.location.href = "add_schedule.php";
        </script>';
        } else {
            echo "Invalid: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

?>
