<?php
// Include the file with the database connection
include("db_connect.php");

// Check if the employeeID & date_range parameter is set in the URL
if(isset($_GET['id']) && isset($_GET['date_range'])) {
    // Retrieve employeeID from the URL
    $employeeID = $_GET['id'];
    $date_range = $_GET['date_range'];

    // SQL query to retrieve the salary based on employeeID and date range
    $selectQuery = "SELECT netsalary FROM payroll WHERE employee_id = $employeeID AND date_range = '$date_range'";

    // Execute the SQL query
    $result = $conn->query($selectQuery);

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Fetch the salary details
        $row = $result->fetch_assoc();
        $netsalary = $row['netsalary'];

        // Return the salary as response
        echo $netsalary;
    } else {
        // No salary details found for the provided employeeID and date range
        echo "Salary not found";
    }
} else {
    // Employee ID or date range not provided in the URL
    echo "Employee ID or date range not provided";
}
?>
