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

                <th>Full Name</th>
                <th>Username</th>
                <th>Employee ID</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
           
        </thead>
        <tbody>
            <?php
            // Include the file with the database connection
            include("db_connect.php");

       // SQL query to retrieve data from the 'employee_detail' table
            $selectQuery = "SELECT * FROM employee_detail";

            // Execute the SQL query
            $result = $conn->query($selectQuery);

          // Iterate through each row in the result set & loop continues until there are no more rows left 
                while ($row = $result->fetch_assoc()) {
          // Extract data from the database and assign it to variables given below.
                    $fullName=$row['full_name'];
                    $username=$row['username']; 
                    $employeeID=$row['employee_id'];  
                    $email=$row['email'];  
                    $address=$row['address'];                     
            
               // output of HTML table row
                    echo "<tr>
                    <td>".$fullName."</td>
                    <td>".$username."</td>
                    <td>".$employeeID."</td>
                    <td>".$email."</td>
                    <td>".$address."</td>
                                                       
                    <td class='action-column'>
                  
                    <!-- $employeeID is a PHP variable holding the value of the id parameter. -->

                    <a class='create' href='signuppage.php'>Create</a>
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
            <a href="add_detail.php"><button class="employeeAdd" name="employeeadd">Add Details</button></a>
         </div>
 
</body>
</html>