<?php
include('home.php');
session_start();
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
            background-color: #f6f6f6; /* Adjust the color code as needed */
        }
        .custom-image {
            width: 800px;
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
        .form-floating > .form-select {
    padding-top: 1.4rem; /* Adjust as needed */
    
}
.large-width {
    width: 105%; /* Adjust as needed */
}
.h-100 {
    height: 20% !important;
    margin-right: -13px;
    margin-top: -31px;
}
.error {
    color: red;
    text-align: center;
    margin-left: -149px;
    margin-top: -34px;
    margin-bottom: 31px;
        }
    </style>

    <title>Add employee Form</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <section class="h-100 bg-light-white">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-12">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">

                                <img src="images/add_details.png" alt="employeepic" class="custom-image img-fluid" />

                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">

                                 <form action="insert_detail.php" method="post" class="row border border-0 border-dark mx-0 my-0">                          
                                        <h3 class="mb-5 text-uppercase">Add Employee Details</h3>
                                        <?php                               
                                // Display error message if it exists
                                if (isset($_SESSION['error_message'])) {
                                    echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
                                    unset($_SESSION['error_message']); // Clear the message after displaying
                                }
                                ?>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating mb-1">
                                                 <input type="text" id="floatingInputUserName"
                                                        class="form-control form-control-lg input-field"
                                                        placeholder="User Name" name="user_nam">
                                                    <label for="floatingInputUserName" style="margin-left: 7px;">Username
                                                    </label>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6 mb-4">
                                            <div class="form-floating mb-1">
                                                <select id="floatingSelectDepartment" class="form-select form-select-lg input-field" name="department">
                                                    <option value="">Select Department</option>
                                                    <?php
                                                    // Include the file containing the database connection
                                                    include('db_connect.php');
                                                    // Fetch department values from the database
                                                    $sql = "SELECT department FROM department";
                                                    $result = $conn->query($sql);

                                                    // Display department options
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
                                                        }
                                                    }
                                                    // Close the database connection
                                                    $conn->close();
                                                    ?>
                                                </select>
                                                <label for="floatingSelectDepartment" style="margin-left: 7px;">Department</label>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating mb-1">
                                                    <input type="text" id="floatingInputEmployeeID"
                                                        class="form-control form-control-lg input-field"
                                                        placeholder="Empid" name="empid">
                                                    <label for="floatingInputEmployeeID"
                                                        style="margin-left: 7px;">Employee ID</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating mb-1">
                                                    <input type="text" id="floatingInputEmail"
                                                        class="form-control form-control-lg input-field"
                                                        placeholder="email@gmail.com" name="email">
                                                      <label for="email"
                                                        style="margin-left: 7px;">Email</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                      <div class="col-md-6 mb-4">
                                    <div class="form-floating mb-1">
                            <input type="date" id="floatingInputJoiningDate"
                              class="form-control form-control-lg input-field"
                             name="join_date">
                              <label for="floatingInputJoiningDate"
                              style="margin-left: 2px;">Date of Joining</label>
                                 </div>
                                  </div>

                                  <div class="col-md-6 mb-4">
    <div class="form-floating mb-1">
        <select id="floatingSelectRole" class="form-select form-select-lg input-field" name="role">
            <option value="">Select Role</option>
            <option value="AI/ML engineer">AI/ML Engineer</option>
            <option value="IOS developer">IOS Developer</option>
            <option value="Graphics designer">Graphics Designer</option>
            <option value="Web developer">Web Developer</option>
        </select>
        <label for="floatingSelectRole" style="margin-left: 7px;">Role</label>
    </div>
</div>
</div>

<div class="col-md-11 mb-4">
<div class="form-floating mb-1">
    <input type="text" id="floatingInputAddress" class="form-control form-control-lg input-field large-width" placeholder="Address" name="address">
    <label for="floatingInputAddress" style="margin-left: 7px;">Address</label>
</div>

                                        <div class="d-flex justify-content-center pt-4">
                                            <button type="submit" class="btn btn-primary btn-lg ms-1" name="submit">Submit
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
    <?php
    // Check if there is a success parameter in the URL
    if (isset($_GET['success']) && isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true) {
        if ($_GET['success'] === "true") {
            // Display success message using SweetAlert
            echo '<script>
            swal({
                title: "Success!",
                text: "Mail sent successfully!",
                icon: "success",
                button: "OK",
              });
            </script>';
        } else {
            // Display error message using SweetAlert
            echo '<script>
            swal({
                title: "Error!",
                text: "Mail unsuccessful!",
                icon: "error",
                button: "OK",
              });
            </script>';
        }
        // Reset the session variable to prevent the message from appearing on page refresh
        unset($_SESSION['form_submitted']);
    }
    ?>
</body>

</html>
