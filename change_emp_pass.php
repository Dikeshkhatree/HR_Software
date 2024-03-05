<?php
include('dashboard.php');
include('db_connect.php');

// Initialize the message variable
$message = '';
$green_message = '';

// Check if the form is submitted
if (isset($_POST['change_password'])) {
    // Retrieve values from the submitted form
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if new password matches confirm password
    if ($new_password == $confirm_password) {
        // Fetch the user's current password from the database
        $select = "SELECT * FROM add_detail WHERE user_pass = '$current_password'";
        $result = mysqli_query($conn, $select);

        // Check if the current password matches any user's password in the database
        if (mysqli_num_rows($result) > 0) {
            // Update the user's password
            $update = "UPDATE add_detail SET user_pass = '$new_password' WHERE user_pass = '$current_password'";
            mysqli_query($conn, $update);
            
            $green_message = "Password Changed Successfully !"; // $message is the variable here
        } else {
            $message = "Current Password does not match";
        }
    } else {
        $message = "New Password & Confirm New Password do not match";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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
            margin-bottom: 30px;
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
        }

        .text {
            color: #ffffff;
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

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .right-message {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
        <div class="error-message"><?php echo $message; ?></div>
        <div class="right-message"><?php echo $green_message; ?></div>
            <h2>Change Password</h2>
           
            <form action="" method="post">

            <div class="input-group">
                    <input type="password" placeholder="Current Password" name="current_password" required>
                </div>
               

                <div class="input-group">
                    <input type="password" placeholder="New Password" name="new_password" required>
                </div>
              
                <div class="input-group">
                    <input type="password" placeholder="Confirm New Password" name="confirm_password" required>
                </div>

                <div class="input-group">
                    <button type="submit" class="text" name="change_password">Change Password</button> 
                </div>
              
            </form>
        </div>
    </div>
</body>
</html>
