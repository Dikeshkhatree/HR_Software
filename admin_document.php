<?php
include('home.php');
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
    <form action="admin_upload_handler.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="employeeid" class="sr-only">Employee</label>
    <div class="select-wrapper">
        <select id="employeeid" name="employeeid" class="form-control" required>
            <option value="" disabled selected>Select Employee</option>
            <?php
            include('db_connect.php');
//alias
            $query = "SELECT e.username, e.employee_id 
            FROM employee e
            WHERE EXISTS (
                SELECT ad.admin_doc_type
                FROM admin_doc ad
                WHERE ad.admin_doc_type NOT IN (
                    SELECT DISTINCT d.doc_type
                    FROM document d
                    WHERE d.employee_id = e.employee_id
                )
            )";
  
           $result = mysqli_query($conn, $query);
           
            // Loop through each employee and create an option for the select dropdown 
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['employee_id'] . '">' . $row['username'] . ' - ' . $row['employee_id'] . '</option>';
            }
            ?>
        </select>
    </div>
</div>
        <div class="form-group">
            <label for="document-type">Document Type:</label>
            <select id="document-type" name="document-type">
            <option value="" disabled selected>Select Document Type</option>
            <?php
            include('db_connect.php');

           // Fetch employee details who do not have schedules from the database
           $query = "SELECT * FROM admin_doc";
           $result = mysqli_query($conn, $query);
           
            // Loop through each employee and create an option for the select dropdown 
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
