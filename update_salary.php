<?php
// Include the database connection file
include('db_connect.php');

// Check if the form is submitted
if (isset($_POST['update'])) {
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

        // Retrieve the hourly rate for the employee
        $rate_query = "SELECT hourly_rate FROM rate WHERE employee_id = $employeeId";
        $rate_result = mysqli_query($conn, $rate_query);

        if (mysqli_num_rows($rate_result) == 1) {
            $rate_row = mysqli_fetch_assoc($rate_result);
            $hourly_rate = $rate_row['hourly_rate'];

            // Calculate the total hours worked for the given date period, including Saturdays
            $attendance_query = "SELECT SUM(hours_worked) AS total_hours FROM attendance WHERE employee_id = $employeeId AND date BETWEEN '$fromDate' AND '$toDate'";
            $attendance_result = mysqli_query($conn, $attendance_query);

            if (mysqli_num_rows($attendance_result) == 1) {
                $attendance_row = mysqli_fetch_assoc($attendance_result);
                $total_hours = $attendance_row['total_hours'];

                // Calculate the total number of days in the date range
                $total_days = (strtotime($toDate) - strtotime($fromDate)) / (60 * 60 * 24) + 1; // Including both from and to dates

                // Calculate the number of Saturdays in the date range
                $saturdays = floor(($total_days + date('w', strtotime($fromDate))) / 7); // Count of Saturdays
                $total_hours += $saturdays * 8; // Assuming 8 hours for each Saturday

                // Retrieve leave status for the given date period
                $leave_query = "SELECT status, from_date, to_date FROM apply_leave WHERE employee_id = $employeeId AND from_date <= '$toDate' AND to_date >= '$fromDate'";
                $leave_result = mysqli_query($conn, $leave_query);

                if (mysqli_num_rows($leave_result) > 0) {
                    while ($leave_row = mysqli_fetch_assoc($leave_result)) {
                        // Check if leave status is Approved
                        if ($leave_row['status'] == 'Approved') {
                            // Calculate the number of leave days within the specified range
                            $leave_start = strtotime(max($fromDate, $leave_row['from_date']));
                            $leave_end = strtotime(min($toDate, $leave_row['to_date']));
                            $leave_days = floor(($leave_end - $leave_start) / (60 * 60 * 24)) + 1;

                            // Add salary for leave days (8 hours per day)
                            $total_hours += $leave_days * 8;
                        }
                    }
                }

                // Calculate salary
                $salary = $total_hours * $hourly_rate;

                // Calculate the deduction (10% of the total salary)
                $deduction = $salary * 0.10;

                // Calculate the net salary after deduction
                $netsalary = $salary - $deduction;

                // Update the calculated salary and date range in the payroll table
                $update_query = "UPDATE payroll SET date_range = '$dateRange', salary = $salary, netsalary = $netsalary, paid = 'pending' WHERE date_range = '{$_POST['daterange']}' AND employee_id = $employeeId";
                if (!mysqli_query($conn, $update_query)) {
                    // Set error message if any update fails
                    $_SESSION['error_message'] = "Failed to update salary for employee ID $employeeId: " . mysqli_error($conn);
                    header("Location: view_salary.php");
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "No attendance records found for employee ID $employeeId for the given date range.";
                header("Location: view_salary.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Hourly rate not found for employee ID $employeeId.";
            header("Location: view_salary.php");
            exit();
        }
    }

    // Set success message if all updates are successful
    $_SESSION['success_message'] = "Salaries updated successfully!";
    header("Location: view_salary.php");
    exit();
}

// Retrieve the date_range from the query parameter
if (isset($_GET['date_range'])) {
    $daterange = $_GET['date_range'];

    // Retrieve existing payroll information for the specified date range
    $query = "SELECT * FROM payroll WHERE date_range = '$daterange'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        $_SESSION['error_message'] = "No payroll records found for the given date range.";
        header("Location: view_salary.php");
        exit();
    }
}
?>
<?php
include('home.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Salary</title>
    <link rel="stylesheet" href="css/update_salary.css">
</head>
<body>
    <div class="main-container">
        <h2>Update Salary</h2>
        <form action="" method="post">
            <input type='hidden' name="daterange" value="<?php echo $row['date_range']; ?>">
            <div class="form-group">
                <label for="fromDate">From Date:</label>
                <input type="date" id="fromDate" name="fromDate" value="<?php echo explode(' to ', $row['date_range'])[0]; ?>" required>
            </div>
            <!-- 'to' is simply a string used as separator & explode() is a PHP function used to split a string into an array and fetch 1st index & 2nd index -->
            <div class="form-group">
                <label for="toDate">To Date:</label>
                <input type="date" id="toDate" name="toDate" value="<?php echo explode(' to ', $row['date_range'])[1]; ?>" required>
            </div>
            <button type="submit" name="update">Update Salary</button>
        </form>
        <?php
        if (isset($_SESSION['success_message'])) {
            echo "<p class='success-message'>" . $_SESSION['success_message'] . "</p>";
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo "<p class='error-message'>" . $_SESSION['error_message'] . "</p>";
            unset($_SESSION['error_message']);
        }
        ?>
    </div>
</body>
</html>
