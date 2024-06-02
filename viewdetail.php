<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="css/viewdetail.css"/>
   
</head>
<body>
   <div class="main-container">
   <div class="table-container">
      <p class="TableInfo">Employee Details</p>
      <div class="table-div">
    
    <table>
        <thead>

              <th>Joining Date</th>
                <th>Username</th>
                <th>Employee ID</th>
                <th>Email</th>
                <th>Role</th>
                <th>Department</th>
                <th>Action</th>
           
        </thead>
        <tbody>
            <?php
            // Include the file with the database connection
            include("db_connect.php");
            // Pagination variables
            $limit = 6; // Number of records per page
            $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1

            // Calculate the offset for the SQL query
            $offset = ($page - 1) * $limit;
       // SQL query to retrieve data from the 'employee_detail' table
            $selectQuery = "SELECT * FROM employee ORDER BY joining_date DESC LIMIT $offset, $limit";

            // Execute the SQL query
            $result = $conn->query($selectQuery);

            $totalrecordquery = "select count(*) AS total from employee";
            $total_records_result = $conn->query($totalrecordquery);
            $total_records = $total_records_result->fetch_assoc()['total'];
            
            // Calculate total number of pages
            $total_pages = ceil($total_records / $limit);
          // Iterate through each row in the result set & loop continues until there are no more rows left 
                while ($row = $result->fetch_assoc()) {
          // Extract data from the database and assign it to variables given below.
                    $username=$row['username'];  // this 'username' is database name & other all
                    $employeeID = $row['employee_id'];
                    $email = $row['email'];
                    $join_date = $row['joining_date'];
                    $role = $row['role'];      
                    $department = $row['department'];                 
            
               // output of HTML table row
                    echo "<tr>
                    <td>".$join_date."</td>
                    <td>".$username."</td>    
                    <td>".$employeeID."</td>
                    <td>".$email."</td>     
                    <td>".$role."</td>
                    <td>".$department."</td>
                                                       
                    <td class='action-column'>
                  
                    <!-- $employeeID is a PHP variable holding the value of the id parameter. -->
  
                    <a class='edit' href='update_detail.php?id=$employeeID'>Edit</a>  
                    <a class='delete' href='deleteemp_detail.php?id=$employeeID'>Delete</a>
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
            <a href="employee.php"><button class="employeeAdd" name="employeeadd">Add Employee</button></a>
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