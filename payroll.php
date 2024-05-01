<?php
// Include the database connection file
include('db_connect.php');
// Start session
session_start();
if(isset($_POST['submit'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    // Concatenate the "from" and "to" dates into a single string
    $dateRange = $fromDate . ' to ' . $toDate;

    // Retrieve all employees
    $employee_query = "SELECT * FROM employee";
    $employee_result = mysqli_query($conn, $employee_query);

    // Loop through each employee
    while ($employee_row = mysqli_fetch_assoc($employee_result)) {
        $employeeId = $employee_row['employee_id'];
        $username = $employee_row['username'];
        $role = $employee_row['role'];

        // Retrieve the hourly rate for the employee
        $rate_query = "SELECT hourly_rate FROM rate WHERE employee_id = $employeeId";
        $rate_result = mysqli_query($conn, $rate_query);

        if(mysqli_num_rows($rate_result) == 1) {
            $rate_row = mysqli_fetch_assoc($rate_result);
            $hourly_rate = $rate_row['hourly_rate'];

            // Calculate the total hours worked for the given date period, including Saturdays
            $attendance_query = "SELECT SUM(hours_worked) AS total_hours FROM attendance WHERE employee_id = $employeeId AND date BETWEEN '$fromDate' AND '$toDate'";
            $attendance_result = mysqli_query($conn, $attendance_query);

            if(mysqli_num_rows($attendance_result) == 1) {
                $attendance_row = mysqli_fetch_assoc($attendance_result);
                $total_hours = $attendance_row['total_hours'];

                // Calculate the monthly salary including Saturdays
                $total_days = (strtotime($toDate) - strtotime($fromDate)) / (60 * 60 * 24) + 1; // Including both from and to dates
                $saturdays = floor(($total_days + date('w', strtotime($fromDate))) / 7); // Count of Saturdays
                $total_hours += $saturdays * 8; // Assuming 8 hours for each Saturday

                // Retrieve leave status for the given date period
                $leave_query = "SELECT status, from_date, to_date FROM apply_leave WHERE employee_id = $employeeId AND from_date <= '$toDate' AND to_date >= '$fromDate'";
                $leave_result = mysqli_query($conn, $leave_query);

                if(mysqli_num_rows($leave_result) > 0) {
                    while($leave_row = mysqli_fetch_assoc($leave_result)) {
                        // Check if leave status is Approved
                        if($leave_row['status'] == 'Approved') {
                            // Calculate the number of leave days within the specified range
                            $leave_start = strtotime(max($fromDate, $leave_row['from_date'])); //max will calculate later date till to_date
                            $leave_end = strtotime(min($toDate, $leave_row['to_date'])); //min will calculate earlier date behind to_date
                            $leave_days = floor(($leave_end - $leave_start) / (60 * 60 * 24)) + 1;

                            // Add salary for leave days (8 hours per day)
                            $total_hours += $leave_days * 8;
                        }
                    }
                }

                // Calculate salary
                $salary = $total_hours * $hourly_rate;

                // Insert the calculated salary into the payroll table
                $insert_query = "INSERT INTO payroll (employee_id, username, role, date_range, salary) VALUES ($employeeId, '$username', '$role', '$dateRange', $salary)";
                mysqli_query($conn, $insert_query);
            }
        }
    }

    // Set success message
    $_SESSION['success_message'] = "Salaries inserted successfully!";
    header("Location: add_payroll.php");
    exit();
}
      else {
         // Set error message
         $_SESSION['error_message'] = "Failed to insert salary.";
         header("Location: add_payroll.php");
         exit();
     }
     ?>