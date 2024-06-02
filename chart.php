<?php
include('home.php'); // Include any necessary files
include('fetchdata.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>chart and boxes</title>
<link rel="stylesheet" href="css/chart.css"/>
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<div class="flex-container">
  <div class="box">
<i class="bx bx-user" style="color: blue;"></i>
    <div class="text">
      <h3><?php echo $totalEmployees; ?></h3>
      <p>Total Employee</p>
    </div>
  </div>
  <div class="box">
  <i class="bx bx-check-circle" style="color: green;"></i>
    <div class="text">
      <h3><?php echo $onTimeEmployees; ?></h3>
      <p>On Time</p>
    </div>
  </div>
  <div class="box">
  <i class="bx bx-time-five" style="color: red;"></i>
    <div class="text">
      <h3><?php echo $lateEmployees; ?></h3>
      <p>Late</p>
    </div>
  </div>
  <div class="box">
  <i class="bx bx-calendar-minus" style="color: purple;"></i>
    <div class="text">
      <h3><?php echo $Employeesleaveapply?></h3>
      <p>Apply Leave</p>
    </div>
  </div>
</div>

<div id="myChart"></div>

<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  const data = google.visualization.arrayToDataTable([ //This part converts an array of data into a DataTable 
    ['Status', 'Number of Employees'],
    ['On Time', <?php echo $onTimeEmployees; ?>],
    ['Late', <?php echo $lateEmployees; ?>],
    ['Present', <?php echo $presentEmployees; ?>],
    ['Absent', <?php echo $absentEmployees; ?>]
   
  ]);

  const options = {
    title: '',
    pieSliceText: 'value',
    slices: {
      0: { color: '#28a745' },
      1: { color: '#dc3545' },
      2: { color: '#ff9900' },
      3: { color: '#007bff' },
      4: { color: '#6c757d' }
    },
    backgroundColor: 'transparent' // Remove background color
  };

  const chart = new google.visualization.PieChart(document.getElementById('myChart'));
  chart.draw(data, options);
}
</script>

</body>
</html>
