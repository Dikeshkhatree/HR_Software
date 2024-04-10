<?php
// Include the database connection file
include('db_connect.php');
include('timezone.php');// include timezone to display localtime of kathmandu/Nepal

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data and stored into this variable
    $employeeID = $_POST['employeeid'];
    $password = $_POST['pass'];
    $status = $_POST['status'];

    // Check if add_detail table column i.e 'employee_id' value matches the value of variables from above using post method.
    $check_query = "SELECT * FROM add_detail WHERE employee_id = $employeeID";
    $result = mysqli_query($conn, $check_query); // execute the query

    if(mysqli_num_rows($result) == 0) {
        // Employee ID not found, display popup message
        echo '<script>alert("Employee ID not found."); 
        window.location.href = "loginpage.php";
        </script>';
    } else {
        // Fetch the row for password
        $row = mysqli_fetch_assoc($result);
        $username = $row['username']; // fetch username from add_detail and print in attendance table
        // Compare the password
        if($row['user_pass'] == $password) {
            // Get current date and time using date function.
            $current_date = date("Y-m-d"); // Get current date & store into variable $current_date.
            $current_timein = date("H:i:s"); // Get current time i.e hrs:min:sec
            $current_timeout = date("H:i:s");

            // Check if there is already an attendance record for the employee on the current date
            $existing_attendance_query = "SELECT * FROM attendance WHERE employee_id = $employeeID AND date = '$current_date'";
            $existing_attendance_result = mysqli_query($conn, $existing_attendance_query);

            if(mysqli_num_rows($existing_attendance_result) > 0) {
                // Attendance record already exists for the employee on the current date
                $row = mysqli_fetch_assoc($existing_attendance_result);

                 if($status == 'in' && $row['time_in'] != NULL) {
                    // Time in is already recorded for today, prevent further time in marking
                    echo '<script>alert("Attendance already marked for today.");
                    window.location.href = "loginpage.php";
                    </script>';
                    exit();
                }
            }

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
                    $query = "INSERT INTO attendance (date, employee_id, user_name, user_pass, time_in, status) VALUES ('$current_date', $employeeID, '$username', '$password', '$current_timein', '$attendance_status')";
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

                // Execute the query
                if(mysqli_query($conn, $query)) {
                    echo '<script>alert("Attendance recorded Successfully !");
                    window.location.href = "loginpage.php";
                    </script>';
                    exit();
                } else {
                    echo '<script>alert("Error recording attendance.");</script>';
                }
            } else {
                echo '<script>alert("Schedule not set. Please add schedule.");
                window.location.href = "loginpage.php";
                </script>';
                exit(); // Exit here if schedule not set
            }
        } else {
            // Password does not match, display popup message
            echo '<script>alert("Password does not match.");
            window.location.href = "loginpage.php";
            </script>';
        }
    }
}
?>
