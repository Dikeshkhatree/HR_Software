<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add schedule</title>
    <link rel="stylesheet" href="css/schedule.css"/>
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
            <h2>Add Schedule</h2>
            <form action="schedule.php" method="post">
            <div class="input-group">
    <label for="employeeid" class="sr-only">Employee</label>
    <div class="select-wrapper">
        <select id="employeeid" name="employeeid" class="form-control" required>
            <option value="" disabled selected>Select Employee</option>
            <?php
            include('db_connect.php');

           // Fetch employee details who do not have schedules from the database
           $query = "SELECT * FROM employee WHERE employee_id NOT IN (SELECT DISTINCT employee_id FROM schedule)"; //distinct is keyword that returns unique value & eliminate duplicate rows
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
                <label for="time_in" class="sr-only">Start time</label>
               <input type="time" id="time_in" name="time_in" class="form-control" placeholder="Start time" required>
               </div>

            <div class="input-group">
           <label for="time_out" class="sr-only">End time</label>
           <input type="time" id="time_out" name="time_out" class="form-control" placeholder="End time" required>
           </div>
              
                    <div class="input-group">
                    <button type="submit" class="text" name="add_schedule">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>

