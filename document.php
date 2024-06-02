<?php
include('dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document Upload</title>
<link rel="stylesheet" href="css/document.css"/>
</head>
<body>

<div class="container">
    <h2>Upload Documents</h2>
    <form action="upload_handler.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="document-type">Document Type:</label>
        <select id="document-type" name="document-type">
            <option value="" disabled selected>Select Document Type</option>
            <?php
include('db_connect.php');

// Get the employee ID
$username = $_SESSION['user'];

// Query to fetch document types from admin_doc that have not been used by other employees
$query = "SELECT admin_doc_type 
          FROM admin_doc 
          WHERE admin_doc_type NOT IN (
              SELECT DISTINCT doc_type 
              FROM document 
              WHERE username = '$username'
          )";
           
            $result = mysqli_query($conn, $query);
           
            // Loop through each document type and create an option for the select dropdown 
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['admin_doc_type'] . "'>" . $row['admin_doc_type'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="file">Upload Document:</label>
        <input type="file" id="file" name="file">
    </div>
    <div class="form-group">
        <button type="submit" name="submit" class="upload-btn">Upload</button>
    </div>
</form>

</div>

</body>
</html>
