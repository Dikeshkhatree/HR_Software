<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Rate</title>
   <style>
    body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 380px;
    margin: 115px auto;
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
    margin-top: 4px;
    margin-bottom: 32px;
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
    margin-top: 15px;
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
/* this is for selected options */
.select-wrapper {
    position: relative;
    width: 100%;
}

.select-wrapper select {
    width: 100%;
    padding: 12px 40px 12px 20px; /* Added extra padding on the right for the arrow */
    border-radius: 10px;
    border: 2px solid #ced4da;
    font-size: 1rem;
    appearance: none;
    background-color: #fff;
    cursor: pointer;
}

.select-wrapper::after {
    content: '';
    position: absolute;
    top: calc(50% - 4px); /* Vertically center the arrow */
    right: 15px; /* Adjust the position of the arrow */
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-top: 6px solid #212121; /* Color of the arrow */
    pointer-events: none; 
}

.select-wrapper select:focus {
    outline: none;
}

.select-wrapper select option {
    background-color: #fff;
    color: #212121;
}

   </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Rate per hour</h2>
            <form action="rate.php" method="post">     
           <div class="input-group" style="margin-bottom: 35px;">
           <label for="employeeid" class="sr-only">Employee</label>
           <div class="select-wrapper">
         <select id="employeeid" name="employee_id" class="form-control" required>
            <option value="" disabled selected>Select Employee</option>
            <?php
            include('db_connect.php');
            // Fetch employee details from the database
            $query = "SELECT * FROM employee";
            $result = mysqli_query($conn, $query);
            
            // Loop through each employee and create an option for the select dropdown 
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['employee_id'] . '">' . $row['username'] . ' - ' . $row['employee_id'] . '</option>';
            }
            ?>
        </select>
    </div>
</div>
            <div class="input-group">
           <label for="hourly_rate" class="sr-only">Hourly_Rate</label>
           <input type="number" id="hourly_rate" name="hourly_rate" class="form-control" placeholder="" required>
           </div>
              
                    <div class="input-group" style="margin-bottom: 10px;">
                    <button type="submit" class="text" name="submit">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>