<?php
include('db_connect.php');

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data
    $employeeID = $_POST['employee_id'];
    $hourlyrate = $_POST['hourly_rate'];
   
    // Query to retrieve the username from the table
    $query = "SELECT * FROM employee WHERE employee_id = $employeeID";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 0) {
        // User not found in employee table, display error message
        echo '<script>alert("Employee ID not found.");
        window.location.href = "add_rate.php";
        </script>';
        exit(); // Stop further execution
    } else {
        // Fetch the role from employee
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];
        $username = $row['username'];
           
        // SQL statement to insert data into database
        $insertQuery = "INSERT INTO rate (employee_id, user_name, role, hourly_rate) VALUES ($employeeID, '$username', '$role', $hourlyrate)";
    
        // Execute the SQL query
        if ($conn->query($insertQuery) === TRUE) {
            // Leave request added successfully, display a success message
            echo '<script>alert("Added successfully!");
            window.location.href = "add_rate.php";
            </script>';
        } else {
            // Display error message if query execution fails
            echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
        }
    }
}
?>
