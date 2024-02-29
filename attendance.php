<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Attendance Form</title>

<link rel="stylesheet" href="css/attendance.css">
</head>
<body>

<div class="container">
  <h2>Attendance Form</h2>
  <form id="attendance">
    <div>
      <label for="employee">Employee ID:</label>
      <input type="text" id="employee" class = "input-spacing" name="employee" required>
    </div>
    <div>
    <label for="status" class="label-spacing">Status:</label>
    <select id="status" name="status" class="input-spacing">
    <option value="in">Time In</option>
    <option value="out">Time Out</option>
    </select>

    </div>
    <button type="submit">Submit</button>
  </form>
</div>

</body>
</html>
