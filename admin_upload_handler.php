<?php
// Start session
session_start();

// Include the file with the database connection
include("db_connect.php");

// Check if the form is submitted
if (isset($_POST["submit"])) {
    $employeeID = $_POST['employeeid'];

    // Query to retrieve the employee details from the employee table
    $query = "SELECT * FROM employee WHERE employee_id=$employeeID";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // User not found in employee table, display error message
        $_SESSION['error_message'] = "User not found.";
        header("Location: admin_view_document.php");
        exit(); // Stop further execution
    } else {
        // Fetch the employee ID
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
          
        // Retrieve document type from the form
        $documentType = $_POST['document-type'];
        
        // Check if the selected document type already exists for the employee
        $checkQuery = "SELECT * FROM document WHERE employee_id = '$employeeID' AND doc_type = '$documentType'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Document type already exists for the employee, display error message
            $_SESSION['error_message'] = "Document type '$documentType' already exists for this employee.";
            header("Location: admin_view_document.php");
            exit();
        }

        // File upload handling
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileType = $file['type']; // MIME type of the file

        // Allowed file types
        $allowedFileTypes = ['image/jpeg', 'image/png'];

        // Check for file upload errors
        if ($fileError !== 0) {
            $_SESSION['error_message'] = "File upload error: " . $fileError;
            header("Location: admin_view_document.php");
            exit();
        }

        // Validate file type
        if (!in_array($fileType, $allowedFileTypes)) {
            $_SESSION['error_message'] = "Invalid file type. Only JPEG, PNG files are allowed.";
            header("Location: admin_view_document.php");
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
            header("Location: admin_view_document.php");
            exit();
        }

        // Construct the SQL query to insert the document details into the database
        $insertQuery = "INSERT INTO document (employee_id, username, doc_type, images, status) VALUES ($employeeID, '$username', '$documentType', '$filenameOnly', 'Verify')";

        // Execute the query
        if (mysqli_query($conn, $insertQuery)) {
            // Set success message
            $_SESSION['success_message'] = "Document information saved successfully!";

            // Redirect to the frontend page
            header("Location: admin_view_document.php");
            exit();
        } else {
            // If insertion fails, display an error message
            $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
            header("Location: admin_view_document.php");
            exit();
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
