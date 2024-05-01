<?php
// Include the database connection file
include('db_connect.php');
// Start session
session_start();

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data
    $employeeID = $_POST['employee_id'];
    $hourlyrate = $_POST['hourly_rate'];
   
    // Query to retrieve the username from the table
    $query = "SELECT * FROM employee WHERE employee_id = $employeeID";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 0) {
        // User not found in employee table, set error message
        $_SESSION['error_message'] = "Employee ID not found.";
        header("Location: add_rate.php");
        exit(); // Stop further execution
    } else {
        // Fetch the role from employee
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];
        $username = $row['username'];
           
        // SQL statement to insert data into database
        $insertQuery = "INSERT INTO rate (employee_id, user_name, role, hourly_rate) VALUES ($employeeID, '$username', '$role', $hourlyrate)";
    
        // Execute the SQL query
        if (mysqli_query($conn, $insertQuery)) {
            // Set success message
            $_SESSION['success_message'] = "Rate Added Successfully !";
            header("Location: add_rate.php");
            exit();
        } else {
            // Display error message if query execution fails
            $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
            header("Location: add_rate.php");
            exit();
        }
    }
}
?>
