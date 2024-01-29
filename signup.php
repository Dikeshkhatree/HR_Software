<?php

include("db_connect.php");

if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
}


$insert = "INSERT INTO admin(user_name, phone, email, user_pass) VALUES('$name', '$phone', '$email', '$password')";
$result = $conn->query($insert);

if (!$result) {
    echo "Invalid";
} else {
    header("Location: Home.php");
}
