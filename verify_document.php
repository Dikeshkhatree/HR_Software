<?php
// Start session
session_start();

// Include the file with the database connection
include("db_connect.php");

// Check if employeeID and docType are set in the URL
if (isset($_GET['employeeID']) && isset($_GET['docType'])) {
    $employeeID = $_GET['employeeID'];
    $docType = $_GET['docType'];

    // Update the document status to "Verified"
    $updateQuery = "UPDATE document SET status = 'Verified' WHERE employee_id = '$employeeID' AND doc_type = '$docType'";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['success_message'] = "Document verified successfully!";
    } else {
        $_SESSION['error_message'] = "Error verifying document: " . mysqli_error($conn);
    }

    header("Location: admin_view_document.php");
    exit();
}
?>
