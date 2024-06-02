<?php
// Include the file with the database connection
include("db_connect.php");

// Check if employee ID, date range, and payment status are set
if(isset($_POST['employee_id']) && isset($_POST['date_range']) && isset($_POST['payment_status'])) {
    $employeeID = $_POST['employee_id'];
    $date_range = $_POST['date_range'];
    $paymentStatus = $_POST['payment_status'];

    // Update the payroll table based on payment status and date range
    $updateQuery = "UPDATE payroll SET paid = '$paymentStatus' WHERE employee_id = $employeeID AND date_range = '$date_range'";

    if($conn->query($updateQuery) === TRUE) {
        echo "Payment status updated successfully.";
    } else {
        echo "Error updating payment status: " . $conn->error;
    }
} else {
    echo "Employee ID, date range, or payment status not provided.";
}
?>
