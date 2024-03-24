<?php
include("db_connect.php");

// Check if the form is submitted
if (isset($_POST['submit'])) { 
// it Retrieve values from the submitted form
$employeeID = $_POST['employeeID'];
$status = $_POST['status'];

 // SQL query to update status
 $updateQuery = "UPDATE apply_leave SET status = '$status' WHERE employee_id = '$employeeID'";

 // Execute the SQL query
 if ($conn->query($updateQuery) === TRUE) {
    echo '<script>alert("Updated successfully!");
    window.location.href = "admin_view_leave.php";
    </script>';
} else {
    echo '<script>alert("Error updating status!");
    window.location.href = "admin_view_leave.php";
    </script>';
}
}
?>