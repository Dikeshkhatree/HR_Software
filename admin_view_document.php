<?php
include('home.php');
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

                  // Pagination variables
               $limit = 4; // Number of records per page
               $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1

               // Calculate the offset for the SQL query
               $offset = ($page - 1) * $limit;
                // SQL query to retrieve data from the 'document' table
                $selectQuery = "SELECT * FROM document ORDER BY date DESC LIMIT $offset, $limit";

                // Execute the SQL query
                $result = $conn->query($selectQuery);
                $totalrecordquery = "select count(*) AS total from document";
                $total_records_result = $conn->query($totalrecordquery);
                $total_records = $total_records_result->fetch_assoc()['total'];

                  // Calculate total number of pages
               $total_pages = ceil($total_records / $limit);

                // Iterate through each row in the result set
                while ($row = $result->fetch_assoc()) {
                    // Extract data from the database
                    $employeeID = $row['employee_id'];
                    $username = $row['username'];
                    $doctype = $row['doc_type'];
                    $document = $row['images'];
                    $status = $row['status'];
                    $statusDisplay = $status === 'Verified' ? '<span class="status-verified">Verified</span>' : '<span class="status-not-verified">Verify</span>';

                    // Output HTML table row
                    echo "<tr>
                            <td>".$employeeID."</td>
                            <td>".$username."</td>
                            <td>".$doctype."</td>
                            <td><img src='uploads/".$document."' alt='Document' style='max-width: 100px; max-height: 100px;' onclick='viewImage(\"uploads/".$document."\")'></td>
                            <td>
                                <a href='verify_document.php?employeeID=".$employeeID."&docType=".$doctype."' class='verify-link'>".$statusDisplay."</a>
                            </td>
                            <td class='action-column'>
                                <a class='edit' href='editadmin_document.php?id=$employeeID&doctype=$doctype'>Edit</a>
                                <a class='delete' href='deleteadmin_document.php?id=$employeeID&doctype=$doctype'>Delete</a>
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
      <a href="admin_document.php"><button class="docAdd" name="docadd">Add Document</button></a>
   </div>
   <script>
function viewImage(imageSrc) {
    window.open(imageSrc, "_blank", "width=800, height=600");
}
</script>
<div class="pagination">
   <?php 
    if ($page > 1) {
        echo '<li><a href="?page=' . ($page - 1) . '">&lsaquo; Prev</a></li>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
      if ($i == $page) {
          echo '<li class="active"><a href="?page=' . $i . '">' . $i . '</a></li>';
      } else {
          echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
      }
  }
    if ($page < $total_pages) {
        echo '<li><a href="?page=' . ($page + 1) . '">Next &rsaquo;</a></li>';
    }
    ?>  
   </div>
</body>
</html>
