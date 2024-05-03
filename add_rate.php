<?php
// Include the home.php and db_connect.php files
include('home.php');
include('db_connect.php');
// Start session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Rate</title>
    <link rel="stylesheet" href="css/rate.css"/>
    <style>
        .success {
            color: green;
            text-align: center;
            margin-top: -4px;
            margin-bottom: 10px;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
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
            <h2>Rate per hour</h2>
            <form action="rate.php" method="post">     
                <div class="input-group" style="margin-bottom: 35px;">
                    <label for="employeeid" class="sr-only">Employee</label>
                    <div class="select-wrapper">
                        <select id="employeeid" name="employee_id" class="form-control">
                            <option value="" disabled selected>Select Employee</option>
                            <?php
                            // Fetch employee details from the database
                            $query = "SELECT * FROM employee WHERE employee_id NOT IN (SELECT DISTINCT employee_id FROM rate)"; //distinct is keyword that returns unique value & eliminate duplicate rows
                            $result = mysqli_query($conn, $query);
                            
                            // Loop through each employee and create an option for the select dropdown 
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['employee_id'] . '">' . $row['username'] . ' - ' . $row['employee_id'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <label for="hourly_rate" class="sr-only">Hourly Rate</label>
                    <input type="text" id="hourly_rate" name="hourly_rate" class="form-control" placeholder="Enter rate name">
                </div>
                <div class="input-group" style="margin-bottom: 10px;">
                    <button type="submit" class="text" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
