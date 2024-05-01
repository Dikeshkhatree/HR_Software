<?php
// Include the database connection file
include('db_connect.php');
include('timezone.php'); // Include timezone to display localtime of Kathmandu/Nepal
session_start(); // Start the session

// Check if form is submitted
if (isset($_POST['submitform'])) {
    // Retrieve form data and store it in variables
    $employeeID = $_POST['employeeid'];
    $password = $_POST['pass'];
    $status = $_POST['status'];

    // Fetch the joining date of the employee from the employee table
    $joining_date_query = "SELECT joining_date FROM employee WHERE employee_id = $employeeID";
    $joining_date_result = mysqli_query($conn, $joining_date_query);
    $joining_date_row = mysqli_fetch_assoc($joining_date_result);
    $joining_date = $joining_date_row['joining_date'];

    // Get current date
    $current_date = date("Y-m-d");

    // Convert the joining date and current date to timestamps for comparison
    $joining_date_timestamp = strtotime($joining_date);
    $current_date_timestamp = strtotime($current_date);

    // Check if the current date is on or after the joining date
    if ($current_date_timestamp < $joining_date_timestamp) {
        $_SESSION['error_message'] = "Cannot mark attendance before your joining date!";
    } else {
        // Check if the employee ID exists in the employee table
        $check_query = "SELECT * FROM employee WHERE employee_id = $employeeID";
        $result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($result) == 0) {
            // Employee ID not found, set error message
            $_SESSION['error_message'] = "Employee ID not found!";
        } else {
            // Fetch the row for password
            $row = mysqli_fetch_assoc($result);
            $username = $row['username'];

            // Compare the password
            if ($row['user_pass'] == $password) {
                // Get current time
                $current_timein = date("H:i:s"); // Get current time i.e. hrs:min:sec
                $current_timeout = date("H:i:s");

                // Check if there is already an attendance record for the employee on the current date
                $existing_attendance_query = "SELECT * FROM attendance WHERE employee_id = $employeeID AND date = '$current_date'";
                $existing_attendance_result = mysqli_query($conn, $existing_attendance_query);

                if (mysqli_num_rows($existing_attendance_result) > 0) {
                    // Attendance record already exists for the employee on the current date
                    $row = mysqli_fetch_assoc($existing_attendance_result);
                    if ($status == 'in' && $row['time_in'] != NULL) {
                        // Time in is already recorded for today, prevent further time in marking
                        $_SESSION['error_message'] = "Attendance already marked for today!";
                    }
                }

                // Fetch the schedule of the employee from the schedule table
                $schedule_query = "SELECT * FROM schedule WHERE employee_id = $employeeID";
                $schedule_result = mysqli_query($conn, $schedule_query);

                if (mysqli_num_rows($schedule_result) > 0) {
                    // Fetch employee_id, start and end time from the schedule table
                    $schedule_row = mysqli_fetch_assoc($schedule_result);
                    $start_time = $schedule_row['start_time'];
                    $end_time = $schedule_row['end_time'];

                    // Determine attendance status based on the schedule
                    if ($status == 'in') {
                        if ($current_timein > $start_time) {
                            $attendance_status = 'Late';
                        } elseif ($current_timein <= $start_time) {
                            $attendance_status = 'On Time';
                        }
                        // Insert time in for the employee
                        $query = "INSERT INTO attendance (date, employee_id, user_name, user_pass, time_in, status) VALUES ('$current_date', $employeeID, '$username', '$password', '$current_timein', '$attendance_status')";
                    } elseif ($status == 'out') {
                        // Update time out for the employee
                        $query = "UPDATE attendance SET time_out = '$current_timeout' WHERE employee_id = $employeeID AND date = '$current_date'";
                        mysqli_query($conn, $query); // Execute the query

                        // Calculate the no. of hours worked
                        $query = "SELECT * from attendance WHERE employee_id = $employeeID AND date = '$current_date'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $time_in = strtotime($row['time_in']);
                            $time_out = strtotime($row['time_out']);
                            $time_diff_seconds = $time_out - $time_in;
                            $time_worked_hours = $time_diff_seconds / 3600;

                            // Update the hours worked in the attendance table
                            $query = "UPDATE attendance SET hours_worked = $time_worked_hours WHERE employee_id = $employeeID AND date = '$current_date'";
                            mysqli_query($conn, $query);
                        }
                    }

                    // Execute the query
                    if (mysqli_query($conn, $query)) {
                        // Attendance recorded successfully
            $_SESSION['form_submitted'] = true;
            $_SESSION['success_message'] = "Attendance recorded successfully!";
            header("Location: loginpage.php?success=true");
            exit();
                    } else {
                        $_SESSION['error_message'] = "Error recording attendance!";
                    }
                } else {
                    $_SESSION['error_message'] = "Schedule not set. Please add schedule!";
                }
            } else {
                // Password does not match, set error message
                $_SESSION['error_message'] = "Password does not match!";
            }
        }
    }

    // Redirect to the loginpage.php page
    header("Location: loginpage.php");
    exit();
}
?>