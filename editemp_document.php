<?php
include('dashboard.php');
include("db_connect.php");

session_start(); // Start the session to use session variables

if (isset($_POST['submit'])) {
    // Retrieve values from the submitted form
    $employeeID = $_POST['employeeID'];
    $documentType = $_POST['document-type'];
    $newDocument = $_FILES['file'];

    // Check the document status
    $statusQuery = "SELECT status FROM document WHERE employee_id = '$employeeID' AND doc_type = '$documentType'";
    $statusResult = mysqli_query($conn, $statusQuery);
    $statusRow = mysqli_fetch_assoc($statusResult);

    if ($statusRow['status'] === 'Verified') {
        $_SESSION['error_message'] = "Cannot update document. The document is already verified.";
        header("Location: editemp_document.php");
        exit();
    }

    // File upload handling
    $fileName = $newDocument['name'];
    $fileTmpName = $newDocument['tmp_name'];
    $fileError = $newDocument['error'];

    // Check for file upload errors
    if ($fileError !== 0) {
        $_SESSION['error_message'] = "File upload error: $fileError";
        header("Location: editemp_document.php?id=$employeeID&doctype=$documentType");
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
        header("Location: editemp_document.php?id=$employeeID&doctype=$documentType");
        exit();
    }

    // SQL query to update document in the database
    $updateQuery = "UPDATE document SET images = '$filenameOnly' WHERE employee_id = '$employeeID' AND doc_type = '$documentType'";

    // Execute the SQL query
    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['success_message'] = "Document updated successfully!";
        header("Location: editemp_document.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error updating document: " . mysqli_error($conn);
        header("Location: editemp_document.php?id=$employeeID&doctype=$documentType");
        exit();
    }
}

if (isset($_GET['id']) && isset($_GET['doctype'])) {
    $employeeID = $_GET['id'];
    $documentType = $_GET['doctype'];
    $query = "SELECT * FROM document WHERE employee_id = '$employeeID' AND doc_type = '$documentType'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $currentImage = $row['images'];
} else {
    $employeeID = '';
    $documentType = '';
    $currentImage = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Document</title>
   <link rel="stylesheet" href="css/document.css"/>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
   <div class="container">
      <h2>Edit Document - <?php echo htmlspecialchars($documentType); ?></h2>
      <div class="current-image">
         <?php if (!empty($currentImage)) : ?>
            <img src="uploads/<?php echo htmlspecialchars($currentImage); ?>" alt="Current Image" style="max-width: 100px; max-height: 100px;">
         <?php else : ?>
            <p>No previous image</p>
         <?php endif; ?>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label for="file">Upload New Document Image:</label>
            <input type="file" id="file" name="file">
         </div>
         <div class="form-group">
            <!-- Hidden input fields to pass the employee ID and document type -->
            <input type="hidden" name="employeeID" value="<?php echo htmlspecialchars($employeeID); ?>">
            <input type="hidden" name="document-type" value="<?php echo htmlspecialchars($documentType); ?>">
            <button type="submit" name="submit" class="upload-btn">Update</button>
         </div>
      </form>
   </div>

   <?php
   // Display success message if it exists
   if (isset($_SESSION['success_message'])) {
       echo '<script>
           swal({
               title: "Success!",
               text: "' . $_SESSION['success_message'] . '",
               icon: "success",
               button: "OK",
           }).then(function() {
               window.location.href = "emp_view_document.php";
           });
       </script>';
       unset($_SESSION['success_message']); // Clear the message after displaying
   }

   // Display error message if it exists
   if (isset($_SESSION['error_message'])) {
       echo '<script>
           swal({
               title: "Error!",
               text: "' . $_SESSION['error_message'] . '",
               icon: "error",
               button: "OK",
           }).then(function() {
               window.location.href = "emp_view_document.php";
           });
       </script>';
       unset($_SESSION['error_message']); // Clear the message after displaying
   }
   ?>
</body>
</html>
