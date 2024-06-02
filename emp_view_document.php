<?php
include('dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Document</title>
   <link rel="stylesheet" href="css/view_document.css"/>
   <style>
    /* view_document.css */
.status-verified {
    color: #28a745; /* Green */
    font-weight: bold;
}

.status-not-verified {
    color: #dc3545; /* Light red */
    font-weight: bold;
}

/* Existing styles... */

   </style>
</head>
<body>
   <div class="main-container">
      <div class="table-container">
         <p class="TableInfo">Document Details</p>
         <div class="table-div">
            <table>
               <thead>
                  <th>Employee ID</th>
                  <th>Username</th>
                  <th>Document Type</th>
                  <th>Document</th>
                  <th>Status</th>
                  <th>Action</th>
               </thead>
               <tbody>
                  <?php
                  // Include the file with the database connection
                  include("db_connect.php");
      
                  // Get the username of the currently logged-in user
                  $username = $_SESSION['user'];
      
                  // SQL query to retrieve data from the 'document' table
                  $selectQuery = "SELECT * FROM document WHERE username='$username' ORDER BY date DESC";
      
                  // Execute the SQL query
                  $result = $conn->query($selectQuery);
      
                  // Iterate through each row in the result set
                  while ($row = $result->fetch_assoc()) {
                      // Extract data from the database
                      $employeeID = $row['employee_id'];
                      $username = $row['username'];
                      $doctype = $row['doc_type'];
                      $document = $row['images'];    
                      $status = $row['status'];  
    
                      // Check the status and set the status text and class
                      if ($status == 'Verified') {
                          $statusText = '<span class="status-verified">Verified</span>';
                      } else {
                          $statusText = '<span class="status-not-verified">Verifiy</span>';
                      }
    
                      // Output HTML table row
                      echo "<tr>
                              <td>".$employeeID."</td>
                              <td>".$username."</td>
                              <td>".$doctype."</td>     
                              <td><img src='uploads/".$document."' alt='Document' style='max-width: 100px; max-height: 100px;' onclick='viewImage(\"uploads/".$document."\")'></td>
                              <td>".$statusText."</td>
                              <td class='action-column'>
                                  <a class='edit' href='editemp_document.php?id=$employeeID&doctype=$doctype'>Edit</a>
                                  <a class='delete' href='deleteemp_document.php?id=$employeeID&doctype=$doctype'>Delete</a>
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
      <a href="document.php"><button class="docAdd" name="docadd">Add Document</button></a>
   </div>
   <script>
      function viewImage(imageSrc) {
          window.open(imageSrc, "_blank", "width=800, height=600");
      }
   </script>
</body>
</html>
