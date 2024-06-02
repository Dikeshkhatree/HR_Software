<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View_Dep</title>
   <link rel="stylesheet" href="css/document_type.css"/>
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
   <div class="main-container">
   <div class="table-container">
      <p class="TableInfo">Document Type List</p>
      <div class="table-div">
    
    <table>
        <thead>
                <th>Document ID</th>
                <th>Document Name</th> 
                <th>Action</th>
        </thead>
        <tbody>
            <?php
            // Include the file with the database connection
            include("db_connect.php");

       // SQL query to retrieve data from the 'schedule' table
            $selectQuery = "SELECT * FROM admin_doc ORDER BY doc_id DESC";

            // Execute the SQL query
            $result = $conn->query($selectQuery);

          // Iterate through each row in the result set & loop continues until there are no more rows left 
                while ($row = $result->fetch_assoc()) {
          // Extract data from the database and assign it to variables given below.
                    $docid = $row['doc_id'];
                    $doctype = $row['admin_doc_type'];         
            
               // output of HTML table row
                    echo "<tr>
         
                    <td>".$docid."</td>
                    <td>".$doctype."</td>
                                                      
                    <td class='action-column'>
                    <a class='edit' href='edit_doctype.php?id=$docid'>Update</a>
                  </td>
                  </tr>";
                }
            ?>
        </tbody>
    </table>
    </div>
   </div>
   </div>
         <div class="addComponent">
            <a href="add_document_type.php"><button class="docAdd" name="docadd">Add Document</button></a>
         </div>
 
</body>
</html>
