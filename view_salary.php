<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>salary Details</title>
   <link rel="stylesheet" href="css/view_salary.css"/>
   
</head>
<body>
   <div class="main-container">
   <div class="table-container">
      <p class="TableInfo">Salary Details</p>
      <div class="table-div">
    
    <table>
        <thead>

              <th>Date Range</th>
                <th>Employee ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Total Salary</th>
                <th>Action</th>
           
        </thead>
        <tbody>
            <?php
            // Include the file with the database connection
            include("db_connect.php");

       // SQL query to retrieve data from the 'employee_detail' table
            $selectQuery = "SELECT * FROM payroll ORDER BY date DESC";

            // Execute the SQL query
            $result = $conn->query($selectQuery);

          // Iterate through each row in the result set & loop continues until there are no more rows left 
                while ($row = $result->fetch_assoc()) {
          // Extract data from the database and assign it to variables given below.
                    $daterange = $row['date_range'];
                    $employeeID = $row['employee_id'];
                    $username = $row['username'];
                    $role = $row['role'];
                    $salary = $row['salary'];
                                 
               // output of HTML table row
                    echo "<tr>
                    <td>".$daterange."</td>
                    <td>".$employeeID."</td>
                    <td>".$username."</td>      
                    <td>".$role."</td>
                    <td>".$salary."</td>
                                                       
                    <td class='action-column'>
                  
                    <!-- $employeeID is a PHP variable holding the value of the id parameter. -->
                    <a class='view' href='viewpay.php?id=$employeeID & date_range=$daterange'>View</a>
                    <a class='edit' href='update_salary.php?id=$employeeID'>Update</a>  
                  </td>
                  </tr>";
                }
            
            ?>
        </tbody>
    </table>
    </div>
   </div>
   </div>
</body>
</html>