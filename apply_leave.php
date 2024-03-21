<?php
include('dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
        }

        .content {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h2 {
            color: #3E54AC;
            text-align: center;
            margin-top: 15px;
            margin-bottom: 26px;
            margin-right: 37px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group input,
        .input-group textarea {
            width: 100%;
            padding: 12px 20px;
            border-radius: 10px;
            border: 2px solid #ced4da;
            font-size: 1rem;
            box-sizing: border-box;
            margin-top: 8px;
        }

        .input-group button {
            width: 100%;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #007FFF;
            border: none;
            cursor: pointer;
            color: #ffffff;
        }

        .input-group button:hover {
            background-color: #0076CE;
        }

        .text-group {
            text-align: center;
            margin-top: 10px;
        }

        .text-group a {
            color: #007FFF;
        }

        .form-control {
            margin-top: 8px;
        }
    </style>
</head>
<body>
<div class="container" style="margin-top: 80px;">
    <div class="content">
        <h2>Leave Request</h2>
        <form action="leave.php" method="post">
            <div class="input-group">
                <label for="from-date" class="sr-only">From Date:</label>
                <input type="date" id="from-date" name="from_date" class="form-control" placeholder="From Date" required>
            </div>
            <div class="input-group">
                <label for="to-date" class="sr-only">To Date:</label>
                <input type="date" id="to-date" name="to_date" class="form-control" placeholder="To Date" required>
            </div>
            <div class="input-group">
                <label for="reason" class="sr-only">Reason:</label>
                <textarea id="reason" name="reason" class="form-control" rows="2" placeholder="Reason" required></textarea>
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="text">Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
