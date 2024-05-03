<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>viewpay</title>
   <link rel="stylesheet" href="css/viewpay.css" />
   <style>
       @media print {
           .container {
               position: absolute;
               top: 30%;
               left: -2%;
               transform: translate(-50%, -50%);
           }
       }
   </style>
   <script>
       function printSalaryDetails() {
           // Hide unwanted elements
           var elementsToHide = document.querySelectorAll("body > :not(.container)");
           elementsToHide.forEach(function(element) {
               element.style.display = "none";
           });

           // Hide the "Print form" button
           var printButton = document.querySelector(".action-button");
           printButton.style.display = "none";

           // Print the salary details section
           window.print();

           // Show the hidden elements
           elementsToHide.forEach(function(element) {
               element.style.display = "";
           });

           // Show the "Print form" button
           printButton.style.display = "";
       }
   </script>
</head>
<body>
   <?php include('home.php'); ?>
   
   <div class="container">
       <div class="header-bg">
           <h2>Salary Details</h2>
       </div>
       <?php
       // Include the file with the database connection
       include("db_connect.php");

       // Check if the employeeID & fromdate parameter is set in the URL
       if(isset($_GET['id']) && isset($_GET['date_range'])) {
           // Retrieve employeeID from the URL
           $employeeID = $_GET['id'];
           $date_range = $_GET['date_range'];

           // SQL query to retrieve leave details based on employeeID and fromdate
           $selectQuery = "SELECT * FROM payroll WHERE employee_id = $employeeID AND date_range = '$date_range'";

           // Execute the SQL query
           $result = $conn->query($selectQuery);

           // Check if any rows are returned
           if ($result->num_rows > 0) {
               // Fetch the salary details
               $row = $result->fetch_assoc();

               // Extract data from the database
               $date = $row['date'];
               $daterange = $row['date_range'];
               $employeeID = $row['employee_id'];
               $username = $row['username'];
               $role = $row['role'];
               $salary = $row['salary'];

               // Display salary details
               echo "<div class='salary-details'>
                         <p><strong>Date:</strong> $date</p>
                         <p><strong>Date Range:</strong> $daterange</p>
                         <p><strong>Employee ID:</strong> $employeeID</p>
                         <p><strong>Username:</strong> $username</p>
                         <p><strong>Role:</strong> $role</p>
                         <p><strong>Total Salary:</strong> $salary</p>
                         <button class='action-button' onclick='printSalaryDetails()'>Print form</button>
                     </div>";
           } else {
               // No leave details found for the provided employeeID
               echo "<script>alert('Details not found');</script>";
           }
       } else {
           // Employee ID not found in the URL
           echo "<script>alert('Employee ID not found');</script>";
       }
       ?>
       <div class="image-container">
           <img src="images/salary.png" alt="SalaryImage">
       </div>
   </div>
</body>
</html>
