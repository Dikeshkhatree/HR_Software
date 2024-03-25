<?php
include('home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>chart and boxes</title>
<style>
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
    margin-top: 75px;
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

  /* Styles for pie chart */
  #myChart {
    width: 100%;
    max-width: 800px;
    height: 600px;
    margin: -25px auto;
    margin-left: 472px;
   
  }
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<div class="flex-container">
  <div class="box">Box 1</div>
  <div class="box">Box 2</div>
  <div class="box">Box 3</div>
  <div class="box">Box 4</div>
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
