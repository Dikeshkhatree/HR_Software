
<?php

// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']; 
} else {
    // Redirect to the login page if the username is not set in the session
    header("Location: loginpage.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>this is Employee Dashboard</h1>
    <?php echo $username; ?>
</body>
</html>