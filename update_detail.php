
<?php
include('db_connect.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve values from the submitted form
    $fullName = $_POST['fullnam'];
    $username = $_POST['username'];
    $employeeID = $_POST['empid'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Update data in the 'employee_detail' table
    $updateQuery = "UPDATE employee_detail 
                    SET full_name='$fullName', username='$username', email='$email', address='$address'
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
//from above if form is not submitted then it executes get method and get value of id from url and fetch data of that row and after that it executes updatequery & update data if form submitted & finally redirect to viewdetail.php
// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
// Retrieve the value of the 'id' parameter from URL. i.e http://localhost/HR_Software/update_detail.php?id=36
$employeeID = $_GET['id'];

// Query to fetch data from the database
$query = "SELECT * FROM employee_detail WHERE employee_id=$employeeID";

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
            background-color: #f8f8f8; /* Adjust the color code as needed */
        }

        .custom-image {
            width: 1000px;
            height: 580px;
            border-top-left-radius: .25rem;
            border-bottom-left-radius: .25rem;
        }

        .input-field {
            border-radius: 10px;
            border: 3px solid #ced4da;
            padding: 12px 20px;
            margin-bottom: -4px;
            width: 100%;
            font-size: 1rem;
        }    
    </style>

    <title>Update employee Form</title>
</head>

<body>
    <section class="h-100 bg-light-white">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">

                                <img src="images/em_pic.png" alt="employeepic" class="custom-image img-fluid" />

                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">

                                 <form action="" method="post" class="row border border-0 border-dark mx-0 my-0">
                                        <h3 class="mb-5 text-uppercase">Update Employee</h3>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating mb-1">
                                                    <input type="text" id="floatingInputName"
                                                        class="form-control form-control-lg input-field"
                                                        placeholder="First name" name="fullnam" value="<?php echo $row['full_name']; ?>" autocomplete="" required/>
                                                    <label for="floatingInputName" style="margin-left: 7px;">Full
                                                        Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating mb-1">
                                                    <input type="text" id="floatingInputusername"
                                                        class="form-control form-control-lg input-field"
                                                        placeholder="username" name="username" value="<?php echo $row['username']; ?>" autocomplete="" required/>
                                                    <label for="floatingInputusername"
                                                        style="margin-left: 7px;">Username</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating mb-1">
                                                    <input type="hidden" id="floatingInputEmployeeID"
                                                        class="form-control form-control-lg input-field"
                                                        placeholder="Empid" name="empid" value="<?php echo $row['employee_id']; ?>" autocomplete="" required/>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">

                                                <div class="form-floating mb-1">
                                                    <input type="email" id="email"
                                                        class="form-control form-control-lg input-field"
                                                        placeholder="email@gmail.com" name="email" value="<?php echo $row['email']; ?>" autocomplete="" required/>
                                                    <label for="email"
                                                        style="margin-left: 7px;">Email</label>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="form-floating mb-1">
                                            <input type="text" id="floatingInputAddress"
                                                class="form-control form-control-lg input-field" placeholder="Address"
                                                name="address" value="<?php echo $row['address']; ?>" autocomplete="" required>
                                            <label for="floatingInputAddress"
                                                style="margin-left: 7px;">Address</label>
                                        </div>

                                        <div class="d-flex justify-content-center pt-4">
                                            <button type="submit" class="btn btn-primary btn-lg ms-1" name="submit">Update
                                                form</button>
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
