<?php
include('db_connect.php');

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the value of the 'id' parameter
    $employeeID = $_GET['id'];
    $Date = $_GET['date'];

//query to delete the record from the table & employee_id is column name of database & u can give randomvariable name instead '$employeeID'.
$deletequery = "DELETE FROM attendance where employee_id = '$employeeID' AND date = '$Date'";
$result = mysqli_query($conn, $deletequery);
if ($result) {
    header('location:view_attendance.php');
}
else {
    die("Delete failed: " . mysqli_error($conn));
}
}
?>






