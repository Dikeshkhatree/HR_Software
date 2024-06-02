
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
    <link rel="stylesheet" href="css/department.css"/>
    <style>
        .success {
            color: green;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<?php
include('home.php'); ?>
    <div class="container">
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
        <br>
        <h2>Add Department</h2>
        <form action="department.php" method="POST">
       <div class="form-group"> 
        <label for="department_name">Department Name</label> 
        <input type="text" id="department_name" name="department_name" placeholder="Enter department name">
    </div>
    <input type="submit" name="submit" value="Add Department">
</form>
    </div>
</body>
</html>
