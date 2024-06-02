<?php
include('home.php');
include("db_connect.php");

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
          echo '<script>alert("Cannot update document. The document is already verified.");
          window.location.href = "admin_view_document.php";
          </script>';
          exit();
      }

    // File upload handling
    $fileName = $newDocument['name'];
    $fileTmpName = $newDocument['tmp_name'];
    $fileError = $newDocument['error'];

    // Check for file upload errors
    if ($fileError !== 0) {
        echo '<script>alert("File upload error: ' . $fileError . '");
        window.location.href = "admin_view_document.php?id=' . $employeeID . '&doctype=' . $documentType . '";
        </script>';
        exit();
    }

    // Extracting filename from the path
    $filenameOnly = basename($fileName);

    // Directory where uploaded files will be stored
    $uploadDirectory = "uploads/";

    // Move uploaded file to desired location
    $destination = $uploadDirectory . $filenameOnly;
    if (!move_uploaded_file($fileTmpName, $destination)) {
        echo '<script>alert("Failed to move uploaded file.");
        window.location.href = "admin_view_document.php?id=' . $employeeID . '&doctype=' . $documentType . '";
        </script>';
        exit();
    }

    // SQL query to update document in the database
    $updateQuery = "UPDATE document SET images = '$filenameOnly' WHERE employee_id = '$employeeID' AND doc_type = '$documentType'";

    // Execute the SQL query
    if (mysqli_query($conn, $updateQuery)) {
        echo '<script>alert("Document updated successfully!");
        window.location.href = "admin_view_document.php";
        </script>';
        exit();
    } else {
        echo '<script>alert("Error updating document: ' . mysqli_error($conn) . '");
        window.location.href = "admin_view_document.php?id=' . $employeeID . '&doctype=' . $documentType . '";
        </script>';
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Document</title>
   <link rel="stylesheet" href="css/document.css"/>
</head>
<body>
   <div class="container">
      <!-- covert specialchar to html entity i.e img name -->
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
</body>
</html>
