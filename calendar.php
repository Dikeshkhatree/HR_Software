<?php
// Include the database connection file
include('db_connect.php');
include('dashboard.php');

// Start the session
// session_start();
// Get the logged-in user's username from the session
$username = $_SESSION['user'];

// Fetch attendance data for the logged-in user from the database
$sql = "SELECT date, time_in, time_out, status FROM attendance WHERE user_name = '$username'";
$result = mysqli_query($conn, $sql); // Assuming $conn is your database connection variable

// Fetch the date of joining for the logged-in user from the add_detail table
$joiningDateQuery = "SELECT joining_date FROM add_detail WHERE username = '$username'";
$joiningDateResult = mysqli_query($conn, $joiningDateQuery);
$row = mysqli_fetch_assoc($joiningDateResult);
$joiningDate = $row['joining_date'];

// Define an empty array to store event data
$events = array();

// Loop through each row in the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Create the event title with time in and time out on one line and status on another line
    $title = 'In:' . $row['time_in'] . ' - Out:' . $row['time_out'] . '<br>Status: ' . $row['status'] . '<br>(Present)';

    // Determine the background color based on status
    $backgroundColor = ($row['status'] == 'On Time') ? '#28a745' : '#dc3545';

    // Create an event object for each attendance record
    $event = array(
        'title' => $title,
        'start' => $row['date'], // Use the date as the event start date
        'end' => $row['date'], // Use the date as the event end date
        'backgroundColor' => $backgroundColor, // Set background color based on status
        'borderColor' => '#000', // Border color
        'textColor' => '#fff', // Text color
    );

    // Add the event object to the events array
    $events[] = $event;
}

// Close the database connection
mysqli_close($conn);

// Add absent days and week-off days (Saturdays) to the calendar
$startDate = $joiningDate; // Start from the joining date
$endDate = date('Y-m-d'); // End today

$currentDate = $startDate;
while ($currentDate <= $endDate) {
    // Check if the current day is Saturday
    if (date('D', strtotime($currentDate)) == 'Sat') { //'D' is format specifier to get day i.e sun,mon.. from date
        $event = array(
            'title' => 'Week-Off',
            'start' => $currentDate,
            'end' => $currentDate,
            'backgroundColor' => '#007bff', // Blue background for week-offs
            'borderColor' => '#000',
            'textColor' => '#fff',
        );
        $events[] = $event;
    }

    // Check if the current date is not in the events array
    $isAbsent = true;
    foreach ($events as $event) {
        if ($event['start'] == $currentDate) { //start is property of event objects
            $isAbsent = false;
            break;
        }
    }

    // If the current date is not in the events array, add it as an absent day
    if ($isAbsent) {
        $event = array(
            'title' => 'Absent',
            'start' => $currentDate,
            'end' => $currentDate,
            'backgroundColor' => '#ffc107', // Yellow background for absent days
            'borderColor' => '#000',
            'textColor' => '#000',
        );
        $events[] = $event;
    }

    // Move to the next day
    $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <!-- CSS for FullCalendar -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <!-- JS for jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JS for FullCalendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        #calendar {
            width: 110%; 
            margin-left: 50px; 
            margin-top: 70px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div id="calendar"></div>
</div>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: <?php echo json_encode($events); ?>, // Pass the events array to FullCalendar
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'month',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            eventRender: function(event, element) {
                element.find('.fc-title').html(event.title); // Use jQuery to update the event title HTML
            },
            eventClick: function(calEvent, jsEvent, view) {
                // Remove the <br> tag from the event title
                var title = calEvent.title.replace('<br>', ' ').replace('<br>', ''); // Remove it twice to ensure removal of all occurrences
                alert('Attendance: ' + title);
                $(this).css('border-color', 'red');
            }
        });
    });
</script>

</body>
</html>
