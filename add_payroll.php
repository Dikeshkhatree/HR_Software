<?php
// Include the database connection file
include('db_connect.php');
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll</title>
    <link rel="stylesheet" href="css/payroll.css"/>
    <style>
        .success {
            color: green;
            text-align: center;
            margin-top: -8px;
            margin-bottom: 14px;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container" style="margin-top: 140px;">
    <div class="content">
        <?php
        // Display success message if it exists
        if (isset($_SESSION['success_message'])) {
            echo '<p class="success">' . $_SESSION['success_message'] . '</p>';
            unset($_SESSION['success_message']); // Clear the message after displaying
        }

        // Display error message if it exists
        if (isset($_SESSION['error_message'])) {
            echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']); // Clear the message after displaying
        }
        ?>
        <h2>Payroll</h2>
        <form action="payroll.php" method="post">
          
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
