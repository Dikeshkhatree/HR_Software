<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>salary Details</title>
   <link rel="stylesheet" href="css/view_salary.css"/>
   <style>
    @media print {
        .table-container {
            width: 100%;
            margin-right: 260px;
            /* margin-left: -30px; */
        }
        .sidebar, .navbar, .action-column, .action-button {
            display: none !important;
        }
    }
    /* for pagination */
.pagination {
   margin-top: 20px;
   display: flex;
   justify-content: flex-end;
   margin-right: 90px;
 }
 
 .pagination ul {
   display: inline-block;
   padding-left: 0;
   margin: 0;
 }
 
 .pagination li {
   display: inline;
 }
 
 .pagination li a {
   padding: 4px 11px;
   text-decoration: none;
   color: black;
   border-radius: 5px;
   margin: 0 2px;
   font-weight: 500;
 }

 .pagination li.active a {
   background-color: #005eff;
   border-radius: 50%;
   color: white;
 }

</style>
<script>
function printSalaryDetails() {
           // Hide unwanted elements
           var elementsToHide = document.querySelectorAll(".sidebar, .action-column, .action-button, .hideAction");
           elementsToHide.forEach(function(element) {
               element.style.display = "none";
           });

           // Print the salary details section
           window.print();

           // Show the hidden elements
           elementsToHide.forEach(function(element) {
               element.style.display = "";
           });
       }
   </script>


</head>
<body>
       <?php include('home.php'); ?>
   <div class="main-container">
   
   <div class="table-container">
    <div class="table-top">
        <p class="TableInfo">Salary Details</p>
        <button class='action-button' onclick='printSalaryDetails()'>Print form</button>
    </div>
      <div class="table-div">
    
    <table>
        <thead>

              <th>Date Range</th>
                <th>Employee ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Total Salary</th>
                <th>Net Salary(10% Tax)</th>
                <th>Payment</th>
                <th class ="hideAction">Action</th>
           
        </thead>
        <tbody>
        <?php
// Include the file with the database connection
include("db_connect.php");
  // Pagination variables
  $limit = 10; // Number of records per page
  $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1

  // Calculate the offset for the SQL query
  $offset = ($page - 1) * $limit;
// SQL query to retrieve data from the 'payroll' table
$selectQuery = "SELECT * FROM payroll ORDER BY date DESC  LIMIT $offset, $limit";

// Execute the SQL query
$result = $conn->query($selectQuery);

// Initialize an array to keep track of displayed date ranges
$displayedDateRanges = array();

$totalrecordquery = "select count(*) AS total from payroll";
$total_records_result = $conn->query($totalrecordquery);
$total_records = $total_records_result->fetch_assoc()['total'];

// Calculate total number of pages
$total_pages = ceil($total_records / $limit);
// Iterate through each row in the result set
while ($row = $result->fetch_assoc()) {
    // Extract data from the database
    $daterange = $row['date_range'];
    $employeeID = $row['employee_id'];
    $username = $row['username'];
    $role = $row['role'];
    $salary = $row['salary'];
    $netsalary = $row['netsalary'];
    $payment = $row['paid'];

     // Determine the class based on status
     $payment_class = ($payment == 'pending') ? 'red' : 'green';
    
    // Check if the date range has been displayed before
    if (!in_array($daterange, $displayedDateRanges)) {
        // If not displayed before, display the date range
        echo "<tr>
                <td>".$daterange."</td>
                <td>".$employeeID."</td>
                <td>".$username."</td>      
                <td>".$role."</td>
                <td>".$salary."</td>
                <td>".$netsalary."</td>
                <td ><p class='".$payment_class."'>".$payment."</p></td>
                <td class='action-column'>
                    <a class='view' href='viewpay.php?id=$employeeID&date_range=$daterange'>View</a>
                    <a class='edit' href='update_salary.php?date_range=$daterange'>Update</a>  
                </td>
              </tr>";
        
        // Add the displayed date range to the array
        $displayedDateRanges[] = $daterange;
    } else {
        // If the date range has been displayed before, display a placeholder
        echo "<tr>
        <td>&quot;</td>
        <td>".$employeeID."</td>
        <td>".$username."</td>      
        <td>".$role."</td>
        <td>".$salary."</td>
        <td>".$netsalary."</td>
        <td ><p class='".$payment_class."'>".$payment."</p></td>
        <td class='action-column'>
            <a class='view' href='viewpay.php?id=$employeeID&date_range=$daterange'>View</a>
            <a class='edit' href='update_salary.php?date_range=$daterange'>Update</a>  
        </td>
      </tr>";

    }
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