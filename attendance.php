<?php
include('dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Attendance Form</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
  }
  
  .attendance-container {
    max-width: 370px; /* Reduced width */
    margin: 120px auto;
    padding: 45px 20px; /* Adjust padding: top/bottom 30px, left/right 20px */
    background-color: #fff;
    border-radius: 14px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  }
  
  .attendance-heading {
    text-align: center;
    margin-bottom: 47px;
    margin-top: -8px;
  }
  
  .attendance-label {
    font-weight: bold;
   
  }
  
  .attendance-input {
    width: 100%;
    padding: 11px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 8px;
  }

  .attendance-button {
    width: 100%;
    padding: 15px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
  }
  
  .attendance-button:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>
<div class="attendance-container">
  <h2 class="attendance-heading">Attendance Form</h2>
  <form id="attendance">
    <div>
      <label for="employee" class="attendance-label">Employee ID:</label>
      <input type="text" id="employee" class="attendance-input" name="employee" required>
    </div>
    <div>
      <label for="status" class="attendance-label">Status:</label>
      <select id="status" name="status" class="attendance-input">
        <option value="in">Time In</option>
        <option value="out">Time Out</option>
      </select>
    </div>
    <button type="submit" class="attendance-button">Submit</button>
  </form>
</div>
</body>
</html>
