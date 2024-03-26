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
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
<style>
  @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
  /* Styles for 4 boxes */
  .flex-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-left: 205px;
    
  }

  .box {
    width: 285px;
    height: 118px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    margin-top: 72px;
    justify-content: center;
    align-items: center;
    color: black;
    font-size: 24px;
    font-weight: bold;
    text-transform: uppercase;
    transition: transform 0.3s ease;
    
  }

  .box:hover {
    transform: scale(1.05);
  }

  .box i {
    width: 80px;
    border-radius: 10px;
    font-size: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: -35px;
    
  }

.box .text {
  margin-left: 42px;
}
.box .text h3 {
  font-size: 30px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
  color: #333;
}

.box .text p {
  font-size: 18px;
  margin-top: 12px;
  font-family: 'Poppins', sans-serif;
  font-weight: normal;
  color: #666; 
  text-transform: none;
}
/* Styles for pie chart */
#myChart {
  width: 100%;
  max-width: 800px;
  height: 600px;
  margin: -16px auto;
  margin-left: 472px;
}
</style>

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
  const data = google.visualization.arrayToDataTable([
    ['Status', 'Number of Employees'],
    ['On Time', 30],
    ['Absent', 10],
    ['Late', 20],
    ['Present', 20],
    ['Leave Applied', 10]
  ]);

  const options = {
    title: '',
    pieSliceText: 'value',
    slices: {
      0: { color: '#3366cc' },
      1: { color: '#dc3912' },
      2: { color: '#ff9900' },
      3: { color: '#109618' },
      4: { color: '#990099' }
    },
    backgroundColor: 'transparent' // Remove background color
  };

  const chart = new google.visualization.PieChart(document.getElementById('myChart'));
  chart.draw(data, options);
}
</script>

</body>
</html>
