<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="css/admin_view_leave.css"/>
</head>
<body>
   <div class="main-container">
       <div class="table-container">
           <p class="TableInfo">Leave History</p>
           <div class="table-div">
               <table>
                   <thead>
                       <th>Apply Date</th>
                       <th>Employee ID</th>
                       <th>Username</th>
                       <th>From Date</th>
                       <th>To Date</th>
                       <th>Leave Type</th>
                       <th>Remarks</th>
                       <th>Status</th>
                       <th>Action</th>
                   </thead>
                   <tbody>
                       <?php
                       // Include the file with the database connection
                       include("db_connect.php");

                       // SQL query to retrieve data from the 'apply_leave' table
                       $selectQuery = "SELECT * FROM apply_leave ORDER BY Date DESC";

                       // Execute the SQL query
                       $result = $conn->query($selectQuery);

                       // Iterate through each row in the result set & loop continues until there are no more rows left 
                       while ($row = $result->fetch_assoc()) {
                           // Extract data from the database and assign it to variables given below.
                           $Date = $row['Date'];  // this 'Date' is database name & other all
                           $employeeID = $row['employee_id'];
                           $username = $row['user_name'];
                           $fromdate = $row['from_date'];
                           $todate = $row['to_date'];               
                           $leavetype = $row['leave_type'];               
                           $reason = $row['reason'];               
                           $status = $row['status'];               
            
                           // Output of HTML table row
                           echo "<tr>
                                   <td>".$Date."</td>   
                                   <td>".$employeeID."</td>
                                   <td>".$username."</td>
                                   <td>".$fromdate."</td>
                                   <td>".$todate."</td>     
                                   <td>".$leavetype."</td>     
                                   <td>".$reason."</td>
   
                                   <td class='" . ($status == "Approved" ? "status-approved" : ($status == "Waiting for Approval" ? "status-waiting" : "status-not-approved")) . "'>
                                   <b>".$status."</b>
                               </td>
                                   <td class='action-column'>
                                       <!-- $employeeID & $fromdate is a PHP variable holding the value of the id and fromdate parameter. -->
                                       <a class='viewdetail' href='leave_detail.php?id=$employeeID & fromdate=$fromdate'>View Detail</a>
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
