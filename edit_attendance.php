<?php
include("db_connect.php");

// Check if the form is submitted
if (isset($_POST['edit_attendance'])) {
    // Retrieve values from the submitted form
    $employeeID = $_POST['employeeID'];
    $Date = $_POST['date'];
    $timein = $_POST['timein'];
    $timeout = $_POST['timeout'];
    // Fetch the original time in and time out values
    $originalQuery = "SELECT * FROM attendance WHERE employee_id = $employeeID AND date = '$Date'";
    $originalResult = mysqli_query($conn, $originalQuery);
    $originalRow = mysqli_fetch_assoc($originalResult);
    $originalTimeIn = $originalRow['time_in'];
    $originalTimeOut = $originalRow['time_out'];

    // SQL query to update time in and time out
    $updateQuery = "UPDATE attendance SET time_in = '$timein', time_out = '$timeout' WHERE employee_id = $employeeID AND date = '$Date'";

    // Execute the SQL query to update time in and time out
    if ($conn->query($updateQuery) === TRUE) {
        // Fetch the start time from the schedule table
        $scheduleQuery = "SELECT start_time FROM schedule WHERE employee_id = $employeeID";
        $scheduleResult = mysqli_query($conn, $scheduleQuery);
        $scheduleRow = mysqli_fetch_assoc($scheduleResult);
        $start_time = $scheduleRow['start_time'];

        // Calculate the status based on the updated time in and start time
        if ($timein > $start_time) {
            $attendance_status = 'Late';
        } else {
            $attendance_status = 'On Time';
        }

        // Calculate the hours worked based on the updated time in and time out
        $time_in = strtotime($timein); 
        $time_out = strtotime($timeout); 
        $time_diff_seconds = $time_out - $time_in;
        $time_worked_hours = $time_diff_seconds / 3600;

        // SQL query to update status and hours worked
        $updateStatusQuery = "UPDATE attendance SET status = '$attendance_status', hours_worked = $time_worked_hours WHERE employee_id = $employeeID AND date = '$Date'";
        
        // Execute the SQL query to update status and hours worked
        if ($conn->query($updateStatusQuery) === TRUE) {
            // Redirect with success parameter
            header("Location: edit_attendance.php?success=true");
            exit();
        } else {
            echo '<script>alert("Error updating Attendance: ' . mysqli_error($conn) . '");
            window.location.href = "edit_attendance.php";
            </script>';
        }
    } else {
        echo '<script>alert("Error updating Attendance: ' . mysqli_error($conn) . '");
        window.location.href = "edit_attendance.php";
        </script>';
    }
}

include('home.php');

if (isset($_GET['id']) && isset($_GET['date'])) {
    $employeeID = $_GET['id'];
    $Date = $_GET['date'];

    // Prepare and execute the SELECT query
    $query = "SELECT * FROM attendance WHERE employee_id = $employeeID AND date = '$Date'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch the record
        $row = mysqli_fetch_assoc($result);
    } else {
        // Handle query execution error
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Attendance</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
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
            margin-top: 15px;
            margin-bottom: 26px;
            margin-right: 37px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 20px;
            border-radius: 10px;
            border: 2px solid #ced4da;
            font-size: 1rem;
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
        }

        .input-group button:hover {
            background-color: #0076CE;
        }

        .form-control {
            margin-top: 8px;
        }
    </style>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Update Attendance</h2>
            <form action="" method="post">
                <div class="input-group">
                    <input type='hidden' name="employeeID" value="<?php echo $row['employee_id']; ?>">
                    <input type='hidden' name="date" value="<?php echo $row['date']; ?>">
                </div>
                <div class="input-group">
                    <label for="time_in" class="sr-only">Time in</label>
                    <input type="time" id="time_in" name="timein" class="form-control" value="<?php echo $row['time_in']; ?>" placeholder="timein" required>
                </div>
                <div class="input-group">
                    <label for="time_out" class="sr-only">Time out</label>
                    <input type="time" id="time_out" name="timeout" class="form-control" value="<?php echo $row['time_out']; ?>" placeholder="timeout" required>
                </div>
                <div class="input-group">
                    <button type="submit" class="text" name="edit_attendance">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    // Check if there is a success parameter in the URL
    if (isset($_GET['success'])) {
        // Display success message using SweetAlert
        echo '<script>
            swal({
                title: "Success!",
                text: "Attendance updated successfully!",
                icon: "success",
                button: "OK",
            });
        </script>';
    }
    ?>
</body>
</html>
