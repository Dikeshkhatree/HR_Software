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
                <th>Address</th>
                <th>Action</th>
           
        </thead>
        <tbody>
            <?php
            // Include the file with the database connection
            include("db_connect.php");

       // SQL query to retrieve data from the 'employee_detail' table
            $selectQuery = "SELECT * FROM add_detail";

            // Execute the SQL query
            $result = $conn->query($selectQuery);

          // Iterate through each row in the result set & loop continues until there are no more rows left 
                while ($row = $result->fetch_assoc()) {
          // Extract data from the database and assign it to variables given below.
                    $username=$row['username'];  // this 'username' is database name & other all
                    $employeeID = $row['employee_id'];
                    $email = $row['email'];
                    $join_date = $row['joining_date'];
                    $role = $row['role'];
                    $address = $row['address'];                 
            
               // output of HTML table row
                    echo "<tr>
                    <td>".$join_date."</td>
                    <td>".$username."</td>    
                    <td>".$employeeID."</td>
                    <td>".$email."</td>     
                    <td>".$role."</td>
                    <td>".$address."</td>
                                                       
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
            <a href="add_detail.php"><button class="employeeAdd" name="employeeadd">Add Employee</button></a>
         </div>
 
</body>
</html>