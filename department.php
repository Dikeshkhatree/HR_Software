<?php
// Start session
session_start();
// Include the file with the database connection
include("db_connect.php");

// Function to check if a string contains only alphabetic characters
function isValidDepartmentName($department) {
    return preg_match('/^[A-Za-z\s]+$/', $department); // used regex
}

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Retrieve department name from the form
    $department = $_POST['department_name'];

  // Check if department name is provided or check for empty
  if(empty($department)) { 
    // Set error message for missing department name
    $_SESSION['error_message'] = "Please fill out the department name field.";

    // Redirect to the frontend page
    header("Location: add_department.php");
    exit();
}

    // Check if the department name is valid
    if (!isValidDepartmentName($department)) {
        // Set error message for invalid department name
        $_SESSION['error_message'] = "Invalid department name. Please enter only alphabetic characters.";

        // Redirect to the frontend page
        header("Location: add_department.php");
        exit();
    }

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
