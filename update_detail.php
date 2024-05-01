<?php
include('db_connect.php');
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve values from the submitted form
    $username = $_POST['user_nam'];
    $employeeID = $_POST['empid'];
    $email = $_POST['email'];
    $join_date = $_POST['join_date']; // Assuming the format is 'MM/DD/YYYY'
    $role = $_POST['role'];
    $address = $_POST['address'];

    // Update data in the 'employee_detail' table
    $updateQuery = "UPDATE employee 
                    SET  username='$username', email='$email', joining_date='$join_date', role='$role', address='$address'
                    WHERE employee_id=$employeeID";
       
// Execute the update query
    $result = mysqli_query($conn, $updateQuery);
       
    // Check for success or failure
    if ($result) {
        // Use PHP's header for redirection
        header('Location: viewdetail.php');
        exit;
    } else {
        die("Update failed: " . mysqli_error($conn));
    }
}
include('home.php');
//from above if form is not submitted then it executes get method and get value of id from url and fetch data of that row and after that it executes updatequery & update data if form submitted & finally redirect to viewdetail.php
// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
// Retrieve the value of the 'id' parameter from URL. i.e http://localhost/HR_Software/update_detail.php?id=36
$employeeID = $_GET['id'];

// Query to fetch data from the database
$query = "SELECT * FROM employee WHERE employee_id=$employeeID";

// Execute the query
$result = mysqli_query($conn, $query);

// Fetch the single row from the database table with specified ID.
$row = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">

    <style>
        .bg-light-white {
            background-color: #f6f6f6;
        }

        .custom-image {
            width: 100%;
            max-width: 100%;
            height: auto;
        }

        .input-field {
            border-radius: 10px;
            border: 3px solid #ced4da;
            padding: 12px 20px;
            margin-bottom: 0px;
            width: 100%;
            font-size: 1rem;
        }
        .form-floating > .form-select {
    padding-top: 1.39rem; /* Adjust as needed */
 }
 .h-100 {
    height: 20% !important;
    margin-right: -13px;
    margin-top: -7px;
}
    </style>

    <title>Update Employee Details</title>
</head>

<body>
    <section class="h-100 bg-light-white">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xl-12">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="images/add_details.png" alt="Employee Picture" class="custom-image img-fluid" />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <form action="" method="post" class="row border border-0 border-dark mx-0 my-0">
                                        <h3 class="mb-5 text-uppercase">Update Employee Details</h3>
                                        <input type="hidden" id="floatingInputEmployeeID" class="form-control form-control-lg input-field" placeholder="Employee ID" name="empid" value="<?php echo $row['employee_id']; ?>" autocomplete="" required/>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-1">
                                                    <input type="text" id="floatingInputUserName" class="form-control form-control-lg input-field" placeholder="User Name" name="user_nam" value="<?php echo $row['username']; ?>" autocomplete="" required/>
                                                    <label for="floatingInputUserName" style="margin-left: 2px;">Username</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-1">
                                                    <input type="email" id="floatingInputEmail" class="form-control form-control-lg input-field" placeholder="email@gmail.com" name="email" value="<?php echo $row['email']; ?>" autocomplete="" required/>
                                                    <label for="email" style="margin-left: 7px;">Email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-1">
                                                    <input type="date" id="floatingInputJoiningDate" class="form-control form-control-lg input-field" name="join_date" value="<?php echo $row['joining_date']; ?>" autocomplete="" required/>
                                                    <label for="floatingInputJoiningDate" style="margin-left: 2px;">Date of Joining</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-1">
                                                    <select id="floatingSelectRole" class="form-select form-select-lg input-field" name="role" required>
                                                        <option value="" disabled>Select Role</option>
                                                        <option value="AI/ML engineer">AI/ML Engineer</option>
                                                        <option value="Graphics designer">Graphics Designer</option>
                                                        <option value="Web developer">Web Developer</option>
                                                        <option value="Software developer">Software Developer</option>
                                                    </select>
                                                    <label for="floatingSelectRole" style="margin-left: 7px;">Role</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-1">
                                                    <input type="text" id="floatingInputAddress" class="form-control form-control-lg input-field large-width" placeholder="Address" name="address" value="<?php echo $row['address']; ?>" autocomplete="" required>
                                                    <label for="floatingInputAddress" style="margin-left: 2px;">Address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center pt-4">
                                            <button type="submit" class="btn btn-primary btn-lg ms-1" name="submit">Update form</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
