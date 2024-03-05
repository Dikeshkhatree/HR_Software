<?php
include('dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Attendance Form</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f6f6f6;
  }
  
  .attendance-container {
    max-width: 370px; /* Reduced width */
    margin: 120px auto;
    padding: 45px 20px; /* Adjust padding: top/bottom 30px, left/right 20px */
    background-color: #fff;
    border-radius: 14px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  }
  
  .attendance-heading {
    text-align: center;
    margin-bottom: 47px;
    margin-top: -8px;
  }
  
  .attendance-label {
    font-weight: bold;
   
  }
  
  .attendance-input {
    width: 100%;
    padding: 11px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 8px;
  }

  .attendance-button {
    width: 100%;
    padding: 11px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    margin-top: 18px;
  }
  
  .attendance-button:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>
<div class="attendance-container">
  <h2 class="attendance-heading">Attendance Form</h2>
  <form action="" method="post">
    <div>
      <label for="employee" class="attendance-label">Employee ID:</label>
      <input type="text" id="employee" class="attendance-input" name="employeeid" required>
    </div>
    <div>
      <label for="status" class="attendance-label">Status:</label>
      <select id="status" name="status" class="attendance-input">
        <option value="in">Time In</option>
        <option value="out">Time Out</option>
      </select>
    </div>
    <button type="submit" class="attendance-button" name="submit">Submit</button>
  </form>
</div>
</body>
</html>

<?php
// Include the database connection file
include('db_connect.php');

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data
    $employeeID = $_POST['employeeid'];
    $status = $_POST['status'];

     // Check if the employee ID exists in the add_detail table
     $check_query = "SELECT * FROM add_detail WHERE employee_id = $employeeID";
     $result = mysqli_query($conn, $check_query);

     if(mysqli_num_rows($result) == 0) {
      // Employee ID not found, display popup message
      echo '<script>alert("Employee ID not found.");</script>';
  } else {
    // Get current date and time
    $current_date = date("Y-m-d"); // Get current date
    $current_timein = date("H:i:s"); // Get current time i.e hrs:min:sec
    $current_timeout = date("H:i:s");

    // Check if status is 'in' or 'out'
    if($status == 'in') { //The value 'in' represent that the employee is currently "in" or present at work.

        // Insert time in for the employee
        $query = "INSERT INTO attendance (date, employee_id, time_in, status) VALUES ('$current_date', $employeeID, '$current_timein', '$attendance_status')";
    }   elseif($status == 'out') {
        // Update time out for the employee
        $query = "UPDATE attendance SET time_out = '$current_timeout' WHERE employee_id = $employeeID AND date = '$current_date'";
    }

    // Execute the query
    if(mysqli_query($conn, $query)) {
        // JavaScript for showing success popup
        echo '<script>alert("Attendance recorded successfully.");</script>';
    } else {
        // JavaScript for showing error popup
        echo '<script>alert("Error recording attendance.");</script>';
    }
}
}

?>
