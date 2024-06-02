
<?php
include('home.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Document type</title>
    <link rel="stylesheet" href="css/admin_doc_type.css"/>
    <style>
        .success {
            color: green;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
    <?php
        // Display success message if it exists
        if (isset($_SESSION['success_message'])) {
            echo '<p class="success">' . $_SESSION['success_message'] . '</p>';
            unset($_SESSION['success_message']); // Clear the message after displaying
        }

        // Display error message if it exists
        if (isset($_SESSION['error_message'])) {
            echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']); // Clear the message after displaying
        }
        ?>
        <br>
        <h2>Add Document Type</h2>
        <form action="doc_type_backend.php" method="POST">
       <div class="form-group"> 
        <label for="document">Document Type Name</label> 
        <input type="text" id="document" name="document_type" placeholder="Enter Document name">
    </div>
    <input type="submit" name="submit" value="Add Document">
</form>
    </div>
</body>
</html>