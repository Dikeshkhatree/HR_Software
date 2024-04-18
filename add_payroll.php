<?php
// Include the database connection file
include('db_connect.php');
include('home.php');
if(isset($_POST['submit'])) {
    $employeeId = $_POST['employeeId'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    // Query to retrieve the username from the table
    $query = "SELECT * FROM employee WHERE employee_id = $employeeId";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 0) {
        // User not found in employee table, display error message
        echo '<script>alert("Employee ID not found.");
        window.location.href = "add_payroll.php";
        </script>';
        exit(); // Stop further execution
    } else {
        // Fetch the role from employee
     $row = mysqli_fetch_assoc($result);
     $username = $row['username'];
     $role = $row['role'];

    // Retrieve the hourly rate for the employee
    $rate_query = "SELECT * FROM rate WHERE employee_id = $employeeId";
    $rate_result = mysqli_query($conn, $rate_query);

    if(mysqli_num_rows($rate_result) > 0) {
        $row = mysqli_fetch_assoc($rate_result);
        $hourly_rate = $row['hourly_rate'];

        // Calculate the total hours worked for the given date period, including Saturdays
        $attendance_query = "SELECT SUM(hours_worked) AS total_hours FROM attendance WHERE employee_id = $employeeId AND date BETWEEN '$fromDate' AND '$toDate'";
        $attendance_result = mysqli_query($conn, $attendance_query);

        if(mysqli_num_rows($attendance_result) == 1) {
         $row = mysqli_fetch_assoc($attendance_result);
         $total_hours = $row['total_hours'];

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
  $insert_query = "INSERT INTO payroll (employee_id, username, role, from_date, to_date, salary) VALUES ($employeeId, '$username', '$role', '$fromDate', '$toDate', $salary)";
  if(mysqli_query($conn, $insert_query)) {
      echo '<script>alert("Salary inserted successfully!");</script>';
  } else {
      echo '<script>alert("Failed to insert salary.");</script>';
  }
} else {
  echo '<script>alert("Failed to retrieve total hours worked.");</script>';
}
} else {
echo '<script>alert("Failed to calculate salary for the employee.");</script>';
}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
        }

        .content {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h2 {
            color: #3E54AC;
            text-align: center;
            margin-top: -6px;
            margin-bottom: 20px;
            margin-right: 37px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group input,
        .input-group textarea {
            width: 100%;
            padding: 12px 20px;
            border-radius: 10px;
            border: 2px solid #ced4da;
            font-size: 1rem;
            box-sizing: border-box;
            margin-top: 8px;
        }

        .input-group button {
            width: 100%;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #007FFF;
            border: none;
            cursor: pointer;
            color: #ffffff;
            margin-top: 10px;
        }

        .input-group button:hover {
            background-color: #0076CE;
        }

        .text-group {
            text-align: center;
            margin-top: 10px;
        }

        .text-group a {
            color: #007FFF;
        }

        .form-control {
            margin-top: 6px;
        }
        /* this is for selected options */
.select-wrapper {
    position: relative;
    width: 100%;
}

.select-wrapper select {
    width: 100%;
    padding: 12px 40px 12px 20px; /* Added extra padding on the right for the arrow */
    border-radius: 10px;
    border: 2px solid #ced4da;
    font-size: 1rem;
    appearance: none;
    background-color: #fff;
    cursor: pointer;
}

.select-wrapper::after {
    content: '';
    position: absolute;
    top: calc(50% - 4px); /* Vertically center the arrow */
    right: 15px; /* Adjust the position of the arrow */
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-top: 6px solid #212121; /* Color of the arrow */
    pointer-events: none; 
}

.select-wrapper select:focus {
    outline: none;
}

.select-wrapper select option {
    background-color: #fff;
    color: #212121;
}

    </style>
</head>
<body>
<div class="container" style="margin-top: 95px;">
    <div class="content">
        <h2>Payroll</h2>
        <form action="" method="post">
        <div class="input-group">
           <label for="employeeid" class="sr-only">Employee</label>
           <div class="select-wrapper">
         <select id="employeeid" name="employeeId" class="form-control" required>
            <option value="" disabled selected>Select Employee</option>
            <?php
            // Fetch employee details from the database
            $query = "SELECT * FROM employee";
            $result = mysqli_query($conn, $query); //execute query
            
            // Loop through each employee and create an option for the select dropdown 
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['employee_id'] . '">' . $row['username'] . ' - ' . $row['employee_id'] . '</option>';
            }
            ?>
        </select>
    </div>
</div>
            <div class="input-group">
                <label for="from-date" class="sr-only">From Date:</label>
                <input type="date" id="from-date" name="fromDate" class="form-control" placeholder="From Date" required>
            </div>
            <div class="input-group">
                <label for="to-date" class="sr-only">To Date:</label>
                <input type="date" id="to-date" name="toDate" class="form-control" placeholder="To Date" required>
            </div>
           
           <div class="input-group" style="margin-bottom: 10px;">
                <button type="submit" name="submit" class="text">Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
