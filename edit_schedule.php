<?php
include("db_connect.php");

// Check if the form is submitted
if (isset($_POST['edit_schedule'])) { 
// it Retrieve values from the submitted form
$employeeID = $_POST['employeeID'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

 // SQL query to update status
 $updateQuery = "UPDATE schedule SET start_time = '$start_time', end_time = '$end_time' WHERE employee_id = '$employeeID'";

 // Execute the SQL query
 if ($conn->query($updateQuery) === TRUE) {
    echo '<script>alert("Schedule Updated successfully!");
    window.location.href = "view_schedule.php";
    </script>';
} else {
    echo '<script>alert("Error updating schedule!");
    window.location.href = "view_schedule.php";
    </script>';
}
}
include('home.php');
if (isset($_GET['id'])) {
$employeeID = $_GET['id'];
$query = "SELECT * FROM schedule WHERE employee_id=$employeeID";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update schedule</title>
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
            <h2>Update Schedule</h2>
            <form action="" method="post">
            <div class="input-group">
            <input type='hidden' name="employeeID" value="<?php echo $row['employee_id']; ?>">
                <label for="time_in" class="sr-only">Start time</label>
               <input type="time" id="time_in" name="start_time" class="form-control" value="<?php echo $row['start_time']; ?>" placeholder="Start time" required>
               </div>

            <div class="input-group">
           <label for="time_out" class="sr-only">End time</label>
           <input type="time" id="time_out" name="end_time" class="form-control" value="<?php echo $row['end_time']; ?>" placeholder="End time" required>
           </div>
              
                    <div class="input-group">
                    <button type="submit" class="text" name="edit_schedule">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>




