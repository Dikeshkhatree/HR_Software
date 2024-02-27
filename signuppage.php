<?php
include('home.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
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

.text{
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

   </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Sign Up</h2>
            <form action="signup.php" method="post">
                <div class="input-group">
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Password" name="pass" required>
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Email address" name="email" required>
                </div>
                <div class="input-group">
    <input type="tel" placeholder="Phone Number" name="phone" pattern="[0-9]{10}" title="Please enter 10-digit phone number" required>
    </div>

                <div class="input-group">
                    <button type="submit" class="text" name="register">CREATE ACCOUNT</button>
                </div>
                <div class="text-group">
                    Already have an account? <a href="loginpage.php" class="text-primary">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
