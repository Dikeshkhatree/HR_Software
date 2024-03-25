<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Leave Detail</title>
   <style>
       /* General Styles */
       body {
           font-family: Arial, sans-serif;
           background-color: #f9f9f9;
           margin: 0;
           padding: 0;
       }

       .container {
           max-width: 800px;
           margin: 20px auto;
           margin-left: 400px;
           padding: 20px;
           background-color: #fff;
           border-radius: 10px;
           box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
           margin-top: 112px;
       }
       /* CSS for Images */
.image-container {
    display: flex;
    justify-content: flex-end; /* Align images to the right */
    margin-top: -427px; /* Adjust margin as needed */
}

.image-container img {
    width: 450px; /* Adjust width of images */
    height: 360px; /* Maintain aspect ratio */
    margin-left: 10px; /* Adjust margin between images */
    border-radius: 5px; /* Add border radius for rounded corners */
}

       .leave-details {
           margin-bottom: 72px;
       }

       .leave-details h2 {
           font-size: 24px;
           color: #333;
           border-bottom: 1px solid #ddd;
           padding-bottom: 10px;
           margin-bottom: 20px;
           text-align: center;
       }

       .leave-details p {
           font-size: 16px;
           color: #666;
           margin-bottom: 10px;
           line-height: 1.9; /* Adjust line height */
       }

       /* CSS for status colors */
       .status-approved {
           color: green;
           font-weight: bold;     
       }

       .status-not-approved {
           color: red;
           font-weight: bold; 
       }

       .status-waiting {
           color: blue;
           font-weight: bold; 
       }

       /* Colorful Styling */
       .header-bg {
           background-color: #007bff;
           color: #fff;
           padding: 20px 20px;
           border-radius: 3px;
           margin-bottom: 35px;
           width: 800px;
           margin-left: -20px;
           margin-top: -25px;
       }

       /* Button Style */
       .action-button {
           background-color: #00bbf0;
           color: #fff;
           border: none;
           padding: 10px 20px;
           border-radius: 5px;
           cursor: pointer;
           font-size: 16px;
           transition: background-color 0.3s;
           margin-top: 25px;
           margin-bottom: -15px;
           margin-left: 5px;
       }

       .action-button:hover {
           background-color: #0077a3;
       }


    
/* for update status */
.custom-container {
    width: 400px; /* Adjust the width */
    height: auto; /* Adjust the height */
    margin: 0 auto; /* Center the container horizontally */
    background-color: #fff;
    position: absolute;
    padding: 30px; /* Increase padding for better spacing */
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    z-index: 2;
    top: -100%; /* Initial position off-screen at the top */
    left: 50%; /* Center horizontally */
    transform: translate(-50%, 0);
    transition: top 0.4s ease;
}

.custom-container.showpopup {
    top: 35%; /* Move to the middle of the screen */
}


       .update-overlay{
        width: 100%;
        height: 100vh;
        background: rgba(50, 50, 50, 0.7);
        position: fixed;
        left: 0;
        top: 0;
        z-index: -1;
        opacity: 0;
    }
    .showOverlay{
        opacity: 0.5;
        z-index: 1;
    }
    .showpopup{
        top: 50%;  
    }
       .custom-form {
           display: flex;
           flex-direction: column;
       }

       .custom-label {
           font-weight: bold;
           margin-bottom: 5px;
       }

       .custom-select {
           padding: 10px;
           margin-bottom: 20px;
           border: 1px solid #ccc;
           border-radius: 4px;
       }

       .custom-button {
           padding: 10px 20px;
           background-color: #007bff;
           color: #fff;
           border: none;
           border-radius: 4px;
           cursor: pointer;
           margin-left: 10px;
       }

       .custom-button:hover {
           background-color: #0056b3;
       }
   </style>
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
       if(isset($_GET['id'])) {
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
               $reason = $row['reason'];
               $status = $row['status'];
               
               // Display leave details
               echo "<div class='leave-details'>
                         <p><strong>Apply Date:</strong> $Date</p>
                         <p><strong>Employee ID:</strong> $employeeID</p>
                         <p><strong>Username:</strong> $username</p>
                         <p><strong>From Date:</strong> $fromdate</p>
                         <p><strong>To Date:</strong> $todate</p>
                         <p><strong>Reason:</strong> $reason</p>
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
       ?>
         <div class="image-container">
           <img src="images/leave.jpg" alt="LeaveImage">
          
       </div>
   </div>
   <!-- for update status -->
    <!-- for closing update popup when clicked outside -->
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
