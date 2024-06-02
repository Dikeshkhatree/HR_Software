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

           var printButton = document.querySelector(".pay");
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

       function payWithKhalti() {
           // Fetch salary amount dynamically
           var xhr = new XMLHttpRequest();
           xhr.onreadystatechange = function() {
               if (xhr.readyState === XMLHttpRequest.DONE) {
                   if (xhr.status === 200) {
                       var salary = xhr.responseText;
                       var amountInPaisa = salary * 100; // Convert salary to paisa
                       checkout.show({amount: amountInPaisa});
                   } else {
                       console.error("Error fetching salary:", xhr.responseText);
                   }
               }
           };
           xhr.open("GET", "fetch_salary.php?id=<?php echo $_GET['id']; ?>&date_range=<?php echo $_GET['date_range']; ?>", true);
           xhr.send();
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
               $netsalary = $row['netsalary'];

               // Display salary details
               echo "<div class='salary-details'>
                         <p><strong>Date:</strong> $date</p>
                         <p><strong>Date Range:</strong> $daterange</p>
                         <p><strong>Employee ID:</strong> $employeeID</p>
                         <p><strong>Username:</strong> $username</p>
                         <p><strong>Role:</strong> $role</p>
                         <p><strong>Net Salary:</strong> $netsalary</p>
                         <button class='action-button' onclick='printSalaryDetails()'>Print form</button>
                         <button class='pay' id='payment-button' onclick='payWithKhalti()'>Pay with Khalti</button>
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

    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var config = { // obj with properties
            // replace the publicKey with yours
            "publicKey": "test_public_key_74c4891d244a4637b0dfb122077b8eba",
            "productIdentity": "1234567890",
            "productName": "Salary Payment",
            "productUrl": "https://www.yourcompany.com",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": { //obj
                onSuccess: onSuccess,
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        function onSuccess(payload) {
           var xhr = new XMLHttpRequest(); //XMLHttpRequest object create
           xhr.open("POST", "update_payment_status.php", true);
           xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
           xhr.onreadystatechange = function() {
               if (xhr.readyState === XMLHttpRequest.DONE) {
                   if (xhr.status === 200) {
                       console.log("Payment status updated successfully.");
                       swal({
                           title: "Success!",
                           text: "Payment recorded successfully!",
                           icon: "success",
                           button: "OK",
                       }).then(() => {
                           window.location.href = window.location.href + "&success=true";
                       });
                   } else {
                       console.error("Error updating payment status:", xhr.responseText);
                   }
               }
           };
           xhr.send("employee_id=<?php echo $employeeID; ?>&date_range=<?php echo $date_range; ?>&payment_status=success");
       }

        var checkout = new KhaltiCheckout(config);
    </script>
</body>
</html>
