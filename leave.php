<?php
session_start();
include('db_connect.php');

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $reason = $_POST['reason'];
      
    // Set the status to "Waiting for Approval"
    $status = "Waiting for Approval";

    // Retrieve the username from the session when user logged in, it's value stored in session vaiable.
    $username = $_SESSION['user'];

    // Query to retrieve the username from the table
    $query = "SELECT * FROM add_detail WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 0) {
        // User not found in add_detail table, display error message
        echo '<script>alert("User not found.");
        window.location.href = "apply_leave.php";
        </script>';
        exit(); // Stop further execution

    } else {
        // Fetch the employee ID
        $row = mysqli_fetch_assoc($result);
        $employeeID = $row['employee_id'];
       
    //SQL statement to insert data into database
    $insertQuery = "INSERT INTO apply_leave (employee_id, user_name, from_date, to_date, reason, status) VALUES ($employeeID, '$username', '$from_date', '$to_date', '$reason', '$status')";  
    
    // Execute the SQL query
    if ($conn->query($insertQuery) === TRUE) {
        // Leave request added successfully, display a success message
        echo '<script>alert("Leave applied successfully!");
        window.location.href = "apply_leave.php";
        </script>';
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}
}
?>
