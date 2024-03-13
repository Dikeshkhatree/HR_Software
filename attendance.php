<?php
include('dashboard.php');

// Include the database connection file
include('db_connect.php');
include('timezone.php');// include timezone to display localtime of kathmandu/Nepal

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data and stored into this variable
    $employeeID = $_POST['employeeid'];
    $status = $_POST['status'];

    // Check if the employee ID exists in the add_detail table
    $check_query = "SELECT * FROM add_detail WHERE employee_id = $employeeID";
    $result = mysqli_query($conn, $check_query); // execute the query

    if(mysqli_num_rows($result) == 0) {
        // Employee ID not found, display popup message
        echo '<script>alert("Employee ID not found.");</script>';
    } else {
        // Get current date and time using date function.
        $current_date = date("Y-m-d"); // Get current date & store into variable $current_date.
        $current_timein = date("H:i:s"); // Get current time i.e hrs:min:sec
        $current_timeout = date("H:i:s");

        // Fetch the schedule of the employee from the schedule table
        $schedule_query = "SELECT * FROM schedule WHERE employee_id = $employeeID";
        $schedule_result = mysqli_query($conn, $schedule_query); // execute the query

        if(mysqli_num_rows($schedule_result) > 0) {
            // Fetch employee_id, start and end time from the schedule table
            $schedule_row = mysqli_fetch_assoc($schedule_result);

            // fetch data of start_time, end_time from database column to get schedule info e.g [10am-5pm] to determine the status i.e late or ontime
            $start_time = $schedule_row['start_time']; 
            $end_time = $schedule_row['end_time'];

            // Determine attendance status based on the schedule
            if($status == 'in') { //The value 'in' represent that the employee is currently "in" or present at work.

                if ($current_timein > $start_time) {
                    $attendance_status = 'Late';
                } elseif ($current_timein <= $start_time) {
                    $attendance_status = 'On Time';
                }

                // Insert time in for the employee
                $query = "INSERT INTO attendance (date, employee_id, time_in, status) VALUES ('$current_date', $employeeID, '$current_timein', '$attendance_status')";
            } elseif($status == 'out') {

                // Update time out for the employee
                $query = "UPDATE attendance SET time_out = '$current_timeout' WHERE employee_id = $employeeID AND date = '$current_date'";
                 mysqli_query($conn, $query); // Execute the query

              // calculate the no. of hours worked
             $query = "SELECT * from attendance WHERE employee_id = $employeeID AND date = '$current_date'";
             $result = mysqli_query($conn, $query); // Execute the query
            
             if(mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);

// fetch the data of 'time_in' and 'time_out' from the attendance table and store in variable i.e  $time_in and $time_out
              $time_in = strtotime($row['time_in']); 
              $time_out = strtotime($row['time_out']); 

               // Calculate the time difference in seconds
                $time_diff_seconds = $time_out - $time_in;

                // Convert seconds to hours
                $time_worked_hours = $time_diff_seconds / 3600;

                 // Update the hours worked in the attendance table
                 $query = "UPDATE attendance SET hours_worked = $time_worked_hours WHERE employee_id = $employeeID AND date = '$current_date'";
                 mysqli_query($conn, $query); // execute the query
             }
            }
        } else {
            // if schedule not set, display popup message
            echo '<script>alert("Schedule not set. Please add schedule");</script>';
            exit(); // Exit here if schedule not set
        }

        // Execute the query
        if(mysqli_query($conn, $query)) {
            // JavaScript for showing success popup
            echo '<script>alert("Attendance recorded successfully.");</script>';

        } else {
            // JavaScript for showing error popup
            echo '<script>alert("Error recording attendance.");</script>';
            
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Attendance Form</title>
<link rel="stylesheet" href="css/attendance.css"/>
</head>
<body>
<div class="attendance-container">
  <h2 class="attendance-heading">Attendance Form</h2>
  <form action="" method="post">
    <div>
      <label for="employee" class="attendance-label">Employee ID:</label>
      <input type="text" id="employee" class="attendance-input" name="employeeid" required>
    </div>
    <div>
      <label for="status" class="attendance-label">Status:</label>
      <select id="status" name="status" class="attendance-input">
        <option value="in">Time In</option>
        <option value="out">Time Out</option>
      </select>
    </div>
    <button type="submit" class="attendance-button" name="submit">Submit</button>
  </form>
</div>
</body>
</html>
