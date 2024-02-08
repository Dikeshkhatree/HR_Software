<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .content {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 100px auto;
            max-width: 400px;
        }

        h1 {
            color: #3E54AC;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #ced4da;
            padding: 12px 20px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .btn-primary {
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 1rem;
            width: 100%;
            background-color: #007FFF;
            border: none;
        }

        .btn-primary:hover {
            background-color:#0076CE;
        }

        
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <h1>Sign Up</h1>
            <form action="signup.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>
               
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="pass" required>
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email address" name="email" required>
                </div>

                <div class="mb-3">
                    <input type="tel" class="form-control" placeholder="Phone Number" name="phone" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="register">CREATE ACCOUNT</button>
                </div>
                <div class="mb-3 text-center">
                    Already have an account? <a href="loginpage.php" class="text-primary">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
