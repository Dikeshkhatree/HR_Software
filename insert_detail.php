<?php
include("db_connect.php");
session_start();

// Function to generate a random password with lowercase letters and numbers
function generateRandomPassword($length = 5) {
    $characters = 'abcdefghijkyz0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password; // it returns pass where the function is called
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $username = $_POST['user_nam'];
    // Generate a random password
    $password = generateRandomPassword();
    $employeeID = $_POST['empid'];
    $email = $_POST['email'];
    $join_date = $_POST['join_date']; // Assuming the format is 'MM/DD/YYYY'
    $role = $_POST['role'];
    $address = $_POST['address'];
    $department = $_POST['department'];

    // Construct a SQL query to insert data into the 'employee_details' table
    $insertQuery = "INSERT INTO employee(username, user_pass, employee_id, email, joining_date, role, address, department) 
                    VALUES ('$username', '$password', $employeeID, '$email', '$join_date', '$role', '$address', '$department')";

    $queryexecute = $conn->query($insertQuery);

    $emailQuery = "SELECT * FROM employee WHERE email = '$email' AND employee_id = $employeeID";
    $reflectEmailQuery = $conn->query($emailQuery);

    // Number of rows returned by the SQL query
    $emailcount = mysqli_num_rows($reflectEmailQuery);

    if ($emailcount > 0) {
        $subject = "Register new employee";
        $body = "Hello $username\n\n";
        $body .= "Your account has been successfully registered with the following details. \n";
        $body .= "Username: $username\n";
        $body .= "Password: $password\n";
        $body .= "Employee ID: $employeeID\n";
        $body .= "Thank you! Please login through this detail.";
        $sender_email = "From: dikeshkhatree@gmail.com";

        if (mail($email, $subject, $body, $sender_email)) {
            $_SESSION['form_submitted'] = true;
            header("Location: employee.php?success=true");
            exit();
        } else {
            header("Location: employee.php?success=false");
            exit();
        } 
    }
}

$conn->close();
?>
