 <?php

include("db_connect.php");

if (isset($_POST['register'])) {
    $employeeID = $_POST['employeeid'];
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $email = $_POST['email'];
   
}

$insert = "INSERT INTO register_employee(employee_id, user_name, user_pass, email) VALUES ($employeeID, '$username', '$password', '$email')";
$result = $conn->query($insert); 

if (!$result) { 
    echo "Invalid";
} else {
    // header("Location: home.php");
    echo "Success";
}
