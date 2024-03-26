<?php
include('db_connect.php'); // Include your database connection file

// Query to count the total number of employees
$sqlTotal = "SELECT COUNT(*) AS total_employees FROM add_detail";
$resultTotal = $conn->query($sqlTotal);

// Fetch result row for total employees
$rowTotal = $resultTotal->fetch_assoc(); 
// Get total employee count
$totalEmployees = $rowTotal['total_employees'];

// for on time status
// Get today's date
$todayDate = date('Y-m-d');
$sqlOnTime = "SELECT COUNT(*) AS ontime_employees  
              FROM attendance 
              WHERE date = '$todayDate' AND status = 'On Time'";

$resultOnTime = $conn->query($sqlOnTime);

// Fetch result row for on time employees
$rowOnTime = $resultOnTime->fetch_assoc(); 
// Get total on time employee count for today
$onTimeEmployees = $rowOnTime['ontime_employees'];

//for late status
// Get today's date
$todayDate = date('Y-m-d');
$sqlLate = "SELECT COUNT(*) AS late_employees  
              FROM attendance 
              WHERE date = '$todayDate' AND status = 'Late'";

$resultlate = $conn->query($sqlLate);
$rowlate = $resultlate->fetch_assoc(); 
$lateEmployees = $rowlate['late_employees'];

//for total leave applied
$todayDate = date('Y-m-d');
$sqlLeaveapply = "SELECT COUNT(*) AS leave_apply  
              FROM apply_leave
              WHERE Date = '$todayDate'";

$resultleaveapply = $conn->query($sqlLeaveapply);
$rowapply = $resultleaveapply->fetch_assoc(); 
$Employeesleaveapply = $rowapply['leave_apply'];

// Close MySQL connection
$conn->close();
?>
