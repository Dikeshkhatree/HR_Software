<?php
// Start session
session_start();

// Include the file with the database connection
include("db_connect.php");
$username = $_SESSION['user'];
// Check if the form is submitted
if (isset($_POST["submit"])) {
  
    // Query to retrieve the employee details from the employee table
    $query = "SELECT * FROM employee WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // User not found in employee table, display error message
        $_SESSION['error_message'] = "User not found.";
        header("Location: emp_view_document.php");
        exit(); // Stop further execution
    } else {
        // Fetch the employee ID
        $row = mysqli_fetch_assoc($result);
        $employeeID = $row['employee_id'];

        // Retrieve document type from the form
        $documentType = $_POST['document-type'];

        // File upload handling
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];

        // Check for file upload errors
        if ($fileError !== 0) {
            $_SESSION['error_message'] = "File upload error: " . $fileError;
            header("Location: emp_view_document.php");
            exit();
        }

        // Extracting filename from the path
        $filenameOnly = basename($fileName);

        // Directory where uploaded files will be stored
        $uploadDirectory = "uploads/";

        // Move uploaded file to desired location
        $destination = $uploadDirectory . $filenameOnly;
        if (!move_uploaded_file($fileTmpName, $destination)) {
            $_SESSION['error_message'] = "Failed to move uploaded file.";
            header("Location: emp_view_document.php");
            exit();
        }

        // Construct the SQL query to insert the document details into the database
        $insertQuery = "INSERT INTO document (employee_id, username, doc_type, images) VALUES ('$employeeID', '$username', '$documentType', '$filenameOnly')";

        // Execute the query
        if (mysqli_query($conn, $insertQuery)) {
          
            // Redirect to the frontend page
            header("Location: emp_view_document.php");
            exit();
        } else {
            // If insertion fails, display an error message
            $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
            header("Location: emp_view_document.php");
            exit();
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
