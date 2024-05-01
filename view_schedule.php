<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="css/view_schedule.css"/>
   
</head>
<body>
   <div class="main-container">
   <div class="table-container">
      <p class="TableInfo">Schedule List</p>
      <div class="table-div">
    
    <table>
        <thead>

                <th>Date</th>
                <th>Employee ID</th>
                <th>Username</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Action</th>
           
        </thead>
        <tbody>
            <?php
            // Include the file with the database connection
            include("db_connect.php");

       // SQL query to retrieve data from the 'schedule' table
            $selectQuery = "SELECT * FROM schedule ORDER BY Date DESC";

            // Execute the SQL query
            $result = $conn->query($selectQuery);

          // Iterate through each row in the result set & loop continues until there are no more rows left 
                while ($row = $result->fetch_assoc()) {
          // Extract data from the database and assign it to variables given below.
                    $Date=$row['Date'];  // this 'Date' is database name & other all
                    $employeeID = $row['employee_id'];
                    $username = $row['username'];
                    $starttime = $row['start_time'];
                    $endtime = $row['end_time'];               
            
               // output of HTML table row
                    echo "<tr>
                    <td>".$Date."</td>   
                    <td>".$employeeID."</td>
                    <td>".$username."</td>
                    <td>".$starttime."</td>     
                    <td>".$endtime."</td>
                                                       
                    <td class='action-column'>
                  
                    <!-- $employeeID is a PHP variable holding the value of the id parameter. -->
  
                    <a class='edit' href='edit_schedule.php?id=$employeeID'>Update</a>
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
            <a href="add_schedule.php"><button class="scheduleAdd" name="scheduleadd">Add Schedule</button></a>
         </div>
 
</body>
</html>
