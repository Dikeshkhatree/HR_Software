<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="css/view_rate.css"/>
   
</head>
<body>
   <div class="main-container">
   <div class="table-container">
      <p class="TableInfo">Employee Horly_Rate</p>
      <div class="table-div">
    
    <table>
        <thead>
                <th>Employee ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Hourly Rate</th>
                <th>Action</th>
           
        </thead>
        <tbody>
            <?php
            // Include the file with the database connection
            include("db_connect.php");
            $limit = 7; // Number of records per page
            $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1

            // Calculate the offset for the SQL query
            $offset = ($page - 1) * $limit;
       // SQL query to retrieve data from the 'schedule' table
            $selectQuery = "SELECT * FROM rate ORDER BY employee_id DESC  LIMIT $offset, $limit";

            // Execute the SQL query
            $result = $conn->query($selectQuery);
            $totalrecordquery = "select count(*) AS total from rate";
            $total_records_result = $conn->query($totalrecordquery);
            $total_records = $total_records_result->fetch_assoc()['total'];
            
            // Calculate total number of pages
            $total_pages = ceil($total_records / $limit);

          // Iterate through each row in the result set & loop continues until there are no more rows left 
                while ($row = $result->fetch_assoc()) {
          // Extract data from the database and assign it to variables given below.
                    $employeeID = $row['employee_id'];
                    $username = $row['user_name'];
                    $role = $row['role'];
                    $rate = $row['hourly_rate'];               
            
               // output of HTML table row
                    echo "<tr>
                    <td>".$employeeID."</td>
                    <td>".$username."</td>
                    <td>".$role."</td>     
                    <td>".$rate."</td>
                                                       
                    <td class='action-column'>
                  
                    <!-- $employeeID is a PHP variable holding the value of the id parameter. -->
  
                    <a class='edit' href='edit_rate.php?id=$employeeID'>Update</a>
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
            <a href="add_rate.php"><button class="rateAdd" name="rateadd">Add Rate</button></a>
         </div>
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
