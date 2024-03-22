<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="css/view_attendance.css"/>
   
</head>
<body>
   <div class="main-container">
   <div class="table-container">
      <p class="TableInfo">Attendance History</p>
      <div class="table-div">
    
    <table>
        <thead>

                <th>Date</th>           
                <th>Employee ID</th>             
                <th>Username</th>             
                <th>Time In</th>
                <th>Time Out</th>
                <th>Status</th>
                <th>Total Hour</th>
                <th>Action</th>
           
        </thead>
        <tbody>
            <?php
            // Include the file with the database connection
            include("db_connect.php");

       // SQL query to retrieve data from the 'attendance' table
            $selectQuery = "SELECT * FROM attendance";

            // Execute the SQL query
            $result = $conn->query($selectQuery);

          // Iterate through each row in the result set & loop continues until there are no more rows left 
                while ($row = $result->fetch_assoc()) {
          // Extract data from the database and assign it to variables given below.
                    $Date=$row['date'];  // this 'date' is database name & other all
                    $employeeID = $row['employee_id'];
                    $username = $row['user_name'];
                    $timein = $row['time_in'];
                    $timeout = $row['time_out'];
                    $status = $row['status'];
                    $hourswork = $row['hours_worked'];                 
            
               // output of HTML table row
                    echo "<tr>
                    <td>".$Date."</td>             
                    <td>".$employeeID."</td>                   
                    <td>".$username."</td>                   
                    <td>".$timein."</td>     
                    <td>".$timeout."</td>
                    <td>".$status."</td>
                    <td>".$hourswork."</td>
                                                       
                    <td class='action-column'>
                  
                    <!-- $employeeID is a PHP variable holding the value of the id parameter. -->
  
                    <a class='edit' href='update_attendance.php?id=$employeeID'>Edit</a>  
                    <a class='delete' href='delete_attendance.php?id=$employeeID'>Delete</a>
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