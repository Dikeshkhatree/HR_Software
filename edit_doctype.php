<?php
include("db_connect.php");

// Check if the form is submitted
if (isset($_POST['edit_doc'])) { 
// it Retrieve values from the submitted form
$document = $_POST['document'];
$docid = $_POST['docid'];

 // SQL query to update status
 $updateQuery = "UPDATE admin_doc SET admin_doc_type = '$document' WHERE doc_id = '$docid'";

 // Execute the SQL query
 if ($conn->query($updateQuery) === TRUE) {
    header('Location:document_type.php');
}
}
include('home.php');
if (isset($_GET['id'])) {
$docid = $_GET['id'];
$query = "SELECT * FROM admin_doc WHERE doc_id=$docid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update document-type</title>
   <style>
    body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 400px;
    margin: 145px auto;
}

.content {
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
    padding: 30px;
}

h2 {
    color: #3E54AC;
    text-align: center;
    margin-top: 15px;
    margin-bottom: 26px;
    margin-right: 37px;
}

.input-group {
    margin-bottom: 20px;
}

.input-group input {
    width: 100%;
    padding: 12px 20px;
    border-radius: 10px;
    border: 2px solid #ced4da;
    font-size: 1rem;
}

.input-group button {
    width: 100%;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 1rem;
    background-color: #007FFF;
    
    border: none;
    cursor: pointer;
}

.text{
    color: #ffffff;
}
.input-group button:hover {
    background-color: #0076CE;
}

.text-group {
    text-align: center;
    margin-top: 10px;
}

.text-group a {
    color: #007FFF;
}
.form-control{
    margin-top: 8px;
}

   </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Update Document</h2>
            <form action="" method="post">
            <div class="input-group">
            <input type='hidden' name="docid" value="<?php echo $row['doc_id']; ?>">
                <label for="document" class="sr-only">Document Type</label>
               <input type="text" id="document" name="document" class="form-control" value="<?php echo $row['admin_doc_type']; ?>" placeholder="Document Name" required>
               </div>         
                    <div class="input-group">
                    <button type="submit" class="text" name="edit_doc">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>




