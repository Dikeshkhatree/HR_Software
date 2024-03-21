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
    margin-top: 15px;
    margin-bottom: 26px;
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
.form-control{
    margin-top: 8px;
}
   </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Add Schedule</h2>
            <form action="schedule.php" method="post">

            <div class="input-group">
              <label for="employeeid" class="sr-only">Employee ID</label>
              <input type="number" id="employeeid" name="employeeid" class="form-control" placeholder="" required>
             </div>

                <div class="input-group">
                <label for="time_in" class="sr-only">Start time</label>
               <input type="time" id="time_in" name="time_in" class="form-control" placeholder="Start time" required>
               </div>

            <div class="input-group">
           <label for="time_out" class="sr-only">End time</label>
           <input type="time" id="time_out" name="time_out" class="form-control" placeholder="End time" required>
           </div>
              
                    <div class="input-group">
                    <button type="submit" class="text" name="add_schedule">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>

