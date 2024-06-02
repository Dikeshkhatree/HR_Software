<?php
include('dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request</title>
    <link rel="stylesheet" href="css/apply_leave.css"/>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .input-group {
            margin-bottom: 11px;
            margin-top: 5px;
        }
        .form-control {
            width: 100%;
            height: 48px;
            padding: 10px;
    
            font-size: 16px;
            box-sizing: border-box;
            border-radius: 8px;
            
        } 
        .input-group button {
    width: 100%;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 1rem;
    margin-top: 13px;
    background-color: #007FFF;
    border: none;
    cursor: pointer;
    color: #ffffff;
}
    </style>
</head>
<body>
<div class="container" style="margin-top: 80px;">
    <div class="content">
        <h2>Leave Request</h2>
        <form action="leave.php" method="post">
        <div class="input-group">
            <label for="from-date" class="sr-only">From Date:</label>
            <input type="date" id="from-date" name="from_date" class="form-control" placeholder="From Date" required>
        </div>
        <div class="input-group">
            <label for="to-date" class="sr-only">To Date:</label>
            <input type="date" id="to-date" name="to_date" class="form-control" placeholder="To Date" required>
        </div>
        <div class="input-group">
            <label for="leave-type" class="sr-only">Leave Type:</label>
            <select id="leave-type" name="leave_type" class="form-control" required>
                <option value="" disabled selected>Select Leave Type</option>
                <option value="sick_leave">Sick Leave</option>
                <option value="family_medical_leave">Family and Medical Leave</option>
                <option value="personal_leave">Personal Leave</option>
                <option value="emergency_leave">Emergency Leave</option>
                <option value="vacation_leave">Vacation Leave</option>
            </select>
        </div>
        <div class="input-group">
            <label for="reason" class="sr-only">Remarks:</label>
            <textarea id="reason" name="reason" class="form-control" rows="2" placeholder="Remarks" required></textarea>
        </div>
        <div class="input-group">
            <button type="submit" name="submit" class="text">Submit</button>
        </div>
    </form>

    </div>
</div>
<?php
// Display success message if it exists
if (isset($_SESSION['success_message'])) {
    echo '<script>
        swal({
            title: "Success!",
            text: "' . $_SESSION['success_message'] . '",
            icon: "success",
            button: "OK",
        });
    </script>';
    unset($_SESSION['success_message']); // Clear the message after displaying
}

// Display error message if it exists
if (isset($_SESSION['error_message'])) {
    echo '<script>
        swal({
            title: "Error!",
            text: "' . $_SESSION['error_message'] . '",
            icon: "error",
            button: "OK",
        });
    </script>';
    unset($_SESSION['error_message']); // Clear the message after displaying
}
?>
</body>
</html>
