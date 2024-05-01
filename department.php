<?php
// Start session
session_start();
// Include the file with the database connection
include("db_connect.php");
// Check if the form is submitted
if (isset($_POST['department_name'])) {
    // Retrieve department name from the form
    $department = $_POST['department_name'];

    // Construct the SQL query to insert the department name into the database
    $insertQuery = "INSERT INTO department (department) VALUES ('$department')";

    // Execute the query
    if ($conn->query($insertQuery) === TRUE) {
        // Set success message
        $_SESSION['success_message'] = "Department added successfully !";
        
        // Redirect to the frontend page
        header("Location: add_department.php");
        exit();
    } else {
        // If insertion fails, display an error message
        $_SESSION['error_message'] = "Error: " . $insertQuery . "<br>" . $conn->error;
        
        // Redirect to the frontend page
        header("Location: add_department.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
