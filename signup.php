 <?php

include("db_connect.php");

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
}

$insert = "INSERT INTO register_employee(user_name, user_pass, email, phone) VALUES('$username', $password, '$email', $phone)";
$result = $conn->query($insert); 

if (!$result) { 
    echo "Invalid";
} else {
    // header("Location: home.php");
    echo "Success";
}
