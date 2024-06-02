<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View_Dep</title>
   <link rel="stylesheet" href="css/view_department.css"/>
   
</head>
<body>
   <div class="main-container">
   <div class="table-container">
      <p class="TableInfo">Department List</p>
      <div class="table-div">
    
    <table>
        <thead>
                <th>Department ID</th>
                <th>Department Name</th> 
                <th>Action</th>
        </thead>
        <tbody>
            <?php
            // Include the file with the database connection
            include("db_connect.php");

       // SQL query to retrieve data from the 'schedule' table
            $selectQuery = "SELECT * FROM department ORDER BY dep_id DESC";

            // Execute the SQL query
            $result = $conn->query($selectQuery);

          // Iterate through each row in the result set & loop continues until there are no more rows left 
                while ($row = $result->fetch_assoc()) {
          // Extract data from the database and assign it to variables given below.
                    $departmentid = $row['dep_id'];
                    $department = $row['department'];         
            
               // output of HTML table row
                    echo "<tr>
         
                    <td>".$departmentid."</td>
                    <td>".$department."</td>
                                                      
                    <td class='action-column'>
                    <a class='edit' href='edit_department.php?id=$departmentid'>Update</a>
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
            <a href="add_department.php"><button class="depAdd" name="departmentadd">Add Department</button></a>
         </div>
 
</body>
</html>
