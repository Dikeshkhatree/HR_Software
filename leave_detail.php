<?php
include('home.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Leave Detail</title>
   <link rel="stylesheet" href="css/leave_detail.css" />
   <!-- SweetAlert CSS -->
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
   <div class="container">
       <div class="header-bg">
           <h2>Leave Details</h2>
       </div>
       <?php
       // Include the file with the database connection
       include("db_connect.php");

       // Check if the employeeID & fromdate parameter is set in the URL
       if(isset($_GET['id']) && isset($_GET['fromdate'])) {
           // Retrieve employeeID from the URL
           $employeeID = $_GET['id'];
           $fromdate = $_GET['fromdate'];

           // SQL query to retrieve leave details based on employeeID and fromdate
           $selectQuery = "SELECT * FROM apply_leave WHERE employee_id = $employeeID AND from_date = '$fromdate'";

           // Execute the SQL query
           $result = $conn->query($selectQuery);

           // Check if any rows are returned
           if ($result->num_rows > 0) {
               // Fetch the leave details
               $row = $result->fetch_assoc();

               // Extract data from the database
               $Date = $row['Date'];  // this 'Date' is database name & other all
               $employeeID = $row['employee_id'];
               $username = $row['user_name'];
               $fromdate = $row['from_date'];
               $todate = $row['to_date'];
               $reason = $row['leave_type'];
               $status = $row['status'];
               
               // Display leave details
               echo "<div class='leave-details'>
                         <p><strong>Apply Date:</strong> $Date</p>
                         <p><strong>Employee ID:</strong> $employeeID</p>
                         <p><strong>Username:</strong> $username</p>
                         <p><strong>From Date:</strong> $fromdate</p>
                         <p><strong>To Date:</strong> $todate</p>
                         <p><strong>Leave-type:</strong> $reason</p>
                         <p><strong>Status:</strong> <span class='" . ($status == "Approved" ? "status-approved" : ($status == "Waiting for Approval" ? "status-waiting" : "status-not-approved")) . "'>$status</span></p>
                         <button class='action-button' name='submit' onClick='showUpdatePopup()'>Take Action</button>
                     </div>";
           } else {
               // No leave details found for the provided employeeID
               echo "<script>alert('Details not found');</script>";
           }
       } else {
           // Employee ID not found in the URL
           echo "<script>alert('Employee ID not found');</script>";
       }

       // Display success message if it exists
       if (isset($_SESSION['success_message'])) {
           echo '<script>
               swal({
                   title: "Success!",
                   text: "' . $_SESSION['success_message'] . '",
                   icon: "success",
                   button: "OK",
               });
           </script>';
           unset($_SESSION['success_message']); // Clear the message after displaying
       }

       // Display error message if it exists
       if (isset($_SESSION['error_message'])) {
           echo '<script>
               swal({
                   title: "Error!",
                   text: "' . $_SESSION['error_message'] . '",
                   icon: "error",
                   button: "OK",
               });
           </script>';
           unset($_SESSION['error_message']); // Clear the message after displaying
       }
       ?>
       <div class="image-container">
           <img src="images/leave.jpg" alt="LeaveImage">
       </div>
   </div>
   <!-- for update status -->
   <div class="update-overlay" onClick="closeUpdatePopup()"></div>
   <div class="custom-container">
       <form class="custom-form" method='POST' action='update_status.php'>
           <input type='hidden' name='employeeID' value='<?php echo $employeeID ?>'>
           <input type='hidden' name='from_date' value='<?php echo $fromdate ?>'>
           <label class="custom-label" for='status'>Update Status:</label>
           <select class="custom-select" name='status' id='status'>
               <option value='Approved'>Approved</option>
               <option value='Not Approved'>Not Approved</option>
           </select>
           <button class='custom-button' name='submit'>Submit</button>
       </form>
   </div>
   
   <script>
   function showUpdatePopup(){
       document.querySelector('.custom-container').classList.add('showpopup');
       document.querySelector('.update-overlay').classList.add('showOverlay');
   } 

   function closeUpdatePopup(){
       document.querySelector('.custom-container').classList.remove('showpopup');
       document.querySelector('.update-overlay').classList.remove('showOverlay');
   }
   </script>
</body>
</html>
