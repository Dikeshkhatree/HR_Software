

<?php
session_start();
// Include the file with the database connection
include("db_connect.php");

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Retrieve department name from the form
    $document = $_POST['document_type'];

  // Check if department name is provided or check for empty
  if(empty($document)) { 
    // Set error message for missing department name
    $_SESSION['error_message'] = "Please fill out the document type field.";

    // Redirect to the frontend page
    header("Location: add_document_type.php");
    exit();
}

  
    // Construct the SQL query to insert the department name into the database
    $insertQuery = "INSERT INTO admin_doc (admin_doc_type) VALUES ('$document')";

    // Execute the query
    if ($conn->query($insertQuery) === TRUE) {
        // Set success message
        $_SESSION['success_message'] = "Document added successfully !";

        // Redirect to the frontend page
        header("Location: add_document_type.php");
        exit();
    } else {
        // If insertion fails, display an error message
        $_SESSION['error_message'] = "Error: " . $insertQuery . "<br>" . $conn->error;

        // Redirect to the frontend page
        header("Location: add_document_type.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>