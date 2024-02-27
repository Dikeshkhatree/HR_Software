
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
        .form-floating > .form-select {
    padding-top: 1.4rem; /* Adjust as needed */
    
}
.large-width {
    width: 105%; /* Adjust as needed */
}

       
    </style>

    <title>Add employee Form</title>
</head>

<body>
    <section class="h-100 bg-light-white">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">

                                <img src="images/add_details.png" alt="employeepic" class="custom-image img-fluid" />

                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">

                                 <form action="insert_detail.php" method="post" class="row border border-0 border-dark mx-0 my-0">
                                        <h3 class="mb-5 text-uppercase">Add Employee Details</h3>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating mb-1">
                                                    <input type="text" id="floatingInputName"
                                                        class="form-control form-control-lg input-field"
                                                        placeholder="First name" name="fullnam" autocomplete="" required/>
                                                    <label for="floatingInputName" style="margin-left: 7px;">Full
                                                        Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating mb-1">
                                                    <input type="text" id="floatingInputusername"
                                                        class="form-control form-control-lg input-field"
                                                        placeholder="username" name="username" autocomplete="" required/>
                                                    <label for="floatingInputusername"
                                                        style="margin-left: 7px;">Username</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating mb-1">
                                                    <input type="number" id="floatingInputEmployeeID"
                                                        class="form-control form-control-lg input-field"
                                                        placeholder="Empid" name="empid"  autocomplete="" required/>
                                                    <label for="floatingInputEmployeeID"
                                                        style="margin-left: 7px;">Employee ID</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">

                                                <div class="form-floating mb-1">
                                                    <input type="email" id="floatingInputEmail"
                                                        class="form-control form-control-lg input-field"
                                                        placeholder="email@gmail.com" name="email" autocomplete="" required/>
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
                             name="joining_date" autocomplete="" required/>
                              <label for="floatingInputJoiningDate"
                              style="margin-left: 2px;">Date of Joining</label>
                                 </div>
                                  </div>

                                  <div class="col-md-6 mb-4">
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
<div class="col-md-11 mb-4">

<div class="form-floating mb-1">
    <input type="text" id="floatingInputAddress" class="form-control form-control-lg input-field large-width" placeholder="Address" name="address" autocomplete="" required>
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

</body>

</html>
