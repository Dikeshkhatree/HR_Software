<?php
include("db_connect.php");
session_start();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve values from the submitted form
    $employeeID = $_POST['employeeID'];
    $fromdate = $_POST['from_date'];
    $status = $_POST['status'];

    // SQL query to update status
    $updateQuery = "UPDATE apply_leave SET status = '$status' WHERE employee_id = '$employeeID' AND from_date = '$fromdate'";

    // Execute the SQL query
    if ($conn->query($updateQuery) === TRUE) {
        $_SESSION['success_message'] = "Status updated successfully!";
    } else {
        $_SESSION['error_message'] = "Error updating status: " . $conn->error;
    }

    // Redirect back to the leave detail page
    header('Location: leave_detail.php?id=' . $employeeID . '&fromdate=' . $fromdate);
    exit();
} else {
    $_SESSION['error_message'] = "Invalid request";
    header('Location: leave_detail.php');
    exit();
}
