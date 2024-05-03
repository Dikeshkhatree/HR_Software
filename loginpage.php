<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <title>loginpage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="css/loginpage.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class="vh-100">
        <div class="content"
            style="background-color: #0089ede6;height: 50vh; position: relative;top:0; padding: 1rem; margin: 0;">
            <div class="col-5" style="box-sizing: border-box;">
                <h1 class="text-light"><b>Sign in to</b><br>HR System</h1>

                <p class="text-light">
                    <img src="images/char.jpg" alt="" width="450px"
                        style="position: absolute;bottom:0;overflow: hidden;margin-bottom:-22rem;margin-left:10rem;">
            </div>
            <div class="row d-flex justify-content-center" style="position: relative;top: 175px;">
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="card-body p-7">

                        <div class="form-content">
                            <form action="login.php" method="post"
                                class="row border border-0 border-dark mx-0 my-0">
                                <center>
                                    <h1><sup style="font-size: 70%; color: blue;">HR Software</sup></h1>
                                </center>

                                <div class="d-flex justify-content-end align-items-center">
                                    <p class="me-2 mb-0"></p>
                                </div>
                                <div class="d-flex justify-content-end">


                                </div>
                                <h1>Sign in</h1>

                                <img src="images/HRM.jpg" alt="HR logo" width="50" height="180"
                                    style="margin-bottom: 20px;">

                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control input-field" id="floatingInput"
                                        placeholder="Username or Email Address" name="username" autocomplete="username"
                                        required>
                                    <label for="floatingInput" style="margin-left: 7px;">Username or Email </label>
                                </div>

                                <div class="form-floating mb-1">
                                    <input type="password" class="form-control input-field" id="floatingInputPassword"
                                        placeholder="Password" name="pass" autocomplete="current-password" required>
                                    <label for="floatingInputPassword" style="margin-left: 7px;">Password</label>
                                </div>

                                <div class="container-fluid d-grid mb-3">
                                    <button type="submit" class="btn btn-primary" name="submit">LOGIN</button>
                                </div>

                                <div class="container-fluid d-flex justify-content-between align-items-center mb-1">

                                    <button type="button" class="btn btn-success attendance"
                                        onClick="showAttendancePopup()">Submit Attendance</button>
                                </div>

                                <div class="forgot">
                                    <a href="#" style="color: blue; text-decoration: none;">Forgot<br> Password?</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- attendance form popup -->
    <!-- for closing attendance popup when clicked outside -->
    <div class="attendance-overlay" onClick="closeAttendancePopup()"></div>
    <div class="attendance-container">
        <div class="attendance-content">

            <center>
                <h2>Attendance Form</h2>
            </center> <br>

            <form action="attendance.php" method="post" class="attendance-form">
                <div class="attendance-input-group">
                    <label for="employee" class="attendance-label">Login ID:</label>
                    <input type="number" id="employee" class="attendance-input" name="employeeid"
                        style="width: 100%; margin-top: 5px;" required>
                </div>

                <div class="attendance-input-group">
                    <label for="password" class="attendance-label">Password</label>
                    <input type="password" id="password" class="attendance-input" name="pass"
                        style="width: 100% ; margin-top: 5px;" required>
                </div>

                <div class="attendance-input-group">
                    <label for="status" class="attendance-label">Status:</label>
                    <select id="status" name="status" class="attendance-input" style="margin-top: 5px;">
                        <option value="in">Time In</option>
                        <option value="out">Time Out</option>
                    </select>
                </div>

                <div class="attendance-input-group">
                    <button type="submitform" class="attendance-text" name="submitform">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showAttendancePopup() {
            document.querySelector('.attendance-container').classList.add('showpopup');
            document.querySelector('.attendance-overlay').classList.add('showOverlay');
        }

        function closeAttendancePopup() {
            document.querySelector('.attendance-container').classList.remove('showpopup');
            document.querySelector('.attendance-overlay').classList.remove('showOverlay');
        }

    </script>
     <?php
    // Check if there is a success parameter in the URL
    if (isset($_GET['success']) && isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true) {
        if ($_GET['success'] === "true") {
            // Display success message using SweetAlert
            echo '<script>
            swal({
                title: "Success!",
                text: "Attendance recorded successfully!",
                icon: "success",
                button: "OK",
              });
            </script>';
        }
        // Reset the session variable to prevent the message from appearing on page refresh
        unset($_SESSION['form_submitted']);
    }
    // Check if there is an error message in the session
if (isset($_SESSION['error_message'])) {
    // Get the error message from the session
    $error_message = $_SESSION['error_message'];

    // Display error message using SweetAlert
    echo '<script>
    swal({
        title: "Error!",
        text: "'.$error_message.'",
        icon: "error",
        button: "OK",
      });
    </script>';

    // Reset the session variable to prevent the message from appearing on page refresh
    unset($_SESSION['error_message']);
}
    ?>
</body>

</html>
