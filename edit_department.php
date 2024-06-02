<?php
include("db_connect.php");

// Check if the form is submitted
if (isset($_POST['edit_dep'])) { 
// it Retrieve values from the submitted form
$department = $_POST['department'];
$depid = $_POST['depid'];

 // SQL query to update status
 $updateQuery = "UPDATE department SET department = '$department' WHERE dep_id = '$depid'";

 // Execute the SQL query
 if ($conn->query($updateQuery) === TRUE) {
  header('Location: view_department.php');

}
}
include('home.php');
if (isset($_GET['id'])) {
$depid = $_GET['id'];
$query = "SELECT * FROM department WHERE dep_id=$depid";
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
    margin: 145px auto;
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
            <h2>Update Department</h2>
            <form action="" method="post">
            <div class="input-group">
            <input type='hidden' name="depid" value="<?php echo $row['dep_id']; ?>">
                <label for="department" class="sr-only">Department</label>
               <input type="text" id="department" name="department" class="form-control" value="<?php echo $row['department']; ?>" placeholder="Department Name" required>
               </div>         
                    <div class="input-group">
                    <button type="submit" class="text" name="edit_dep">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>




