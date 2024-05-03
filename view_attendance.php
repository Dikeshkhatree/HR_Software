<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View attendance details</title>
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

               // Pagination variables
               $limit = 20; // Number of records per page
               $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1

               // Calculate the offset for the SQL query
               $offset = ($page - 1) * $limit;

               // SQL query to retrieve data from the 'attendance' table with pagination
               $selectQuery = "SELECT * FROM attendance ORDER BY date DESC LIMIT $offset, $limit";
               $result = $conn->query($selectQuery);

               $totalrecordquery = "select count(*) AS total from attendance";
               $total_records_result = $conn->query($totalrecordquery);
               $total_records = $total_records_result->fetch_assoc()['total'];
               
               // Calculate total number of pages
               $total_pages = ceil($total_records / $limit);

               // Iterate through each row in the result set & loop continues until there are no more rows left 
               while ($row = $result->fetch_assoc()) {
                  // Extract data from the database and assign it to variables given below.
                  $Date=$row['date'];
                  $employeeID = $row['employee_id'];
                  $username = $row['user_name'];
                  $timein = $row['time_in'];
                  $timeout = $row['time_out'];
                  $status = $row['status'];
                  $hourswork = $row['hours_worked'];             
                  
                  // Determine the class based on status
    $status_class = ($status == 'Late') ? 'late' : 'on-time';

                  // output of HTML table row
                  echo "<tr>
                     <td>".$Date."</td>             
                     <td>".$employeeID."</td>                   
                     <td>".$username."</td>                   
                     <td>".$timein."</td>     
                     <td>".$timeout."</td>
                     <td ><p class='".$status_class."'>".$status."</p></td>
                     <td>".$hourswork."</td>
                     <td class='action-column'>
                        <a class='edit' href='edit_attendance.php?id=$employeeID & date=$Date'>Edit</a>
                        <a class='delete' href='delete_att.php?id=$employeeID'>Delete</a>
                     </td>
                  </tr>";
               }
               ?>
            </tbody>
         </table>
      </div>
   </div>
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