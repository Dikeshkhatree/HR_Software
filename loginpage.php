<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <title>loginpage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous" />
    <style>
        h4 {
            color: #3E54AC;
        }

        h1 {
            color: black;
        }
        .content {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-content: center;
            align-items: center;
        }

        .form-content {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 40px;
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
        }

        .input-field {
            border-radius: 10px;
            border: 3px solid #ced4da;
            padding: 12px 20px;
            margin-bottom: 20px;
            width: 100%;
            font-size: 1rem;
        }

        p {
            color: black;
        }

        .forgot{
     margin-left: 262px;
    margin-top: -54px;
    margin-bottom: -14px 
        }
    .attendance{
    width: 180px;
    height: 42px;
    margin-left: 58px;
    margin-top: 9px;
    margin-bottom: 0px;
}

 /* Attendance form CSS styles */
    .attendance-container {
        margin: 100px auto;
        position:absolute;
        display: inline-block;
        top: -70%;
        left: 50%;
        z-index: 2;
        transform: translate(-50%,-50%);
        transition: top 0.4s ease;   
    }

    .attendance-overlay{
        width: 100%;
        height: 100vh;
        background: rgba(50, 50, 50, 0.7);
        position: fixed;
        left: 0;
        top: 0;
        z-index: -1;
        opacity: 0;
    }
    .showOverlay{
        opacity: 1;
        z-index: 1;
    }
    .showpopup{
        top: 36%;  
    }
    .attendance-content {
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
        padding: 30px 30px 15px 30px;
    }

    .attendance-h2 {
        color: #3E54AC;
        text-align: center;
        margin-bottom: 30px;
       
    }

    .attendance-input-group {
        margin-bottom: 20px;
    }

    .attendance-input-group input,
    .attendance-input-group select {
        width: 100%;
        padding: 12px 20px;
        border-radius: 10px;
        border: 2px solid #ced4da;
        font-size: 1rem;
    }

    .attendance-input-group button {
        width: 100%;
        padding: 12px 20px;
        border-radius: 10px;
        font-size: 1rem;
        background-color: #007FFF;
        border: none;
        cursor: pointer;
        margin-top: 7px;
    }

    .attendance-text {
        color: #ffffff;
    }

    .attendance-input-group button:hover {
        background-color: #0076CE;
    }
    </style>
</head>

<body>

    <div class="vh-100">
        <div class="content"
            style="background-color: #0089ed;height: 50vh; position: relative;top:0; padding: 1rem; margin: 0;">
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
                        <form action="login.php" method="post" class="row border border-0 border-dark mx-0 my-0">


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
                                    placeholder="Username or Email Address" name="username" autocomplete="" required>

                                <label for="floatingInput" style="margin-left: 7px;">Username or Email </label>

                            </div>

                            <div class="form-floating mb-1">
                                <input type="password" class="form-control input-field" id="floatingInput"
                                    placeholder="Password" name="pass" autocomplete="" required>

                                <label for="floatingInput" style="margin-left: 7px;">Password</label>

                            </div>

                            <div class="container-fluid d-grid mb-3">
                                <button type="submit" class="btn btn-primary" name="submit">LOGIN</button>
                                </div>
                            
                            <div class="container-fluid d-flex justify-content-between align-items-center mb-1">
                               
                            <button type="button" class="btn btn-success attendance" name="submit" onClick="showAttendancePopup()">Submit Attendance</button>
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
       <center> <h2>Attendance Form</h2></center> <br>
        <form action="attendance.php" method="post" class="attendance-form">
            <div class="attendance-input-group">
                <label for="employee" class="attendance-label">Login ID:</label>
                <input type="text" id="employee" class="attendance-input" name="employeeid" style="width: 100%; margin-top: 5px;" required>
            </div>

            <div class="attendance-input-group">
                <label for="password" class="attendance-label">Password</label>
                <input type="password" id="password" class="attendance-input" name="pass" style="width: 100% ; margin-top: 5px;" required>
            </div>

            <div class="attendance-input-group">
                <label for="status" class="attendance-label">Status:</label>
                <select id="status" name="status" class="attendance-input"  style="margin-top: 5px;">
                    <option value="in">Time In</option>
                    <option value="out">Time Out</option>
                </select>
            </div>

            <div class="attendance-input-group">
                <button type="submit" class="attendance-text" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>


<script> 
function showAttendancePopup(){
    document.querySelector('.attendance-container').classList.add('showpopup');
    document.querySelector('.attendance-overlay').classList.add('showOverlay');
} 

function closeAttendancePopup(){
    document.querySelector('.attendance-container').classList.remove('showpopup');
    document.querySelector('.attendance-overlay').classList.remove('showOverlay');
} 

</script>
</body>
</html>
