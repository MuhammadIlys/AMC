<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome AceAmcQ</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      background-color: #f5f5f5;
    }

    header, footer {
      width: 100%;

      color: white;
      text-align: center;

    }

    .content {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-grow: 1;
      width: 100%;
      padding: 30px;
    }

    .login-container,
    .register-container {
      padding: 30px;
      background-color: #f5f5f5; /* Background color for both sections */
      border-radius: 10px;
      border: 1px solid #ccc; /* Border for the containers */
    }


    .form-group {
      margin-bottom: 20px;
    }

    .form-group:last-child {
      margin-bottom: 0;
    }

    /* Style the input fields */
    .form-control {
      border: none;
      border-bottom: 2px solid #ccc; /* Only bottom border */
      border-radius: 0;
      padding: 0;
      background: none; /* Remove input background */
    }

    .form-control:focus {
      box-shadow: none; /* Remove focus box shadow */
    }

    .form-control::placeholder {
      color: #ccc;
    }


    .navbar-nav .nav-link:hover {
      background-color: rgba(0, 0, 0, 0.1);
    }

    .navbar-nav .nav-link.active {
      background-color: rgba(0, 0, 0, 0.2);
      color: white;
    }

    .nav-link{

      text-align:center;
    }

    .offcanvas{

      width:16% !important;
    }

    @media (max-width: 767px) {
      .offcanvas {
        width: 50% !important;
      }
    }

    .row-blue {
    background-color: #013884;
}


.row-productmenu {
    text-align: center;
    height: 55px;
}

.exam-scores-pad {
    padding: 15px 0;
}

.heading-text {
    font-size: 16px;
    color: #fff;
}


@media only screen and (max-width: 767px) {
  .fix-register-inputs{

    padding-top: 18px;
  }
}

/* Tablets */
@media only screen and (min-width: 768px) and (max-width: 991px) {
    .fix-register-inputs{

        padding-top: 18px;
    }
}

  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="https://aceamcq.com/"><img width="80" height="80" src="{{ url('/sitelogo/aceamcqlogo.png') }}" alt="aceamc logo" srcset=""></a>
          <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
    </nav>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Our Products</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="https://aceamcq.com/#SUBSCRIBE"><svg class="svg-inline--fa fa-book fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M448 360V24c0-13.3-10.7-24-24-24H96C43 0 0 43 0 96v320c0 53 43 96 96 96h328c13.3 0 24-10.7 24-24v-16c0-7.5-3.5-14.3-8.9-18.7-4.2-15.4-4.2-59.3 0-74.7 5.4-4.3 8.9-11.1 8.9-18.6zM128 134c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm0 64c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm253.4 250H96c-17.7 0-32-14.3-32-32 0-17.6 14.4-32 32-32h285.4c-1.9 17.1-1.9 46.9 0 64z"></path></svg><!-- <i class="fa fa-book"></i> Font Awesome fontawesome.com --> AMC Qbanks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://aceamcq.com/#SUBSCRIBE"><svg class="svg-inline--fa fa-book fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M448 360V24c0-13.3-10.7-24-24-24H96C43 0 0 43 0 96v320c0 53 43 96 96 96h328c13.3 0 24-10.7 24-24v-16c0-7.5-3.5-14.3-8.9-18.7-4.2-15.4-4.2-59.3 0-74.7 5.4-4.3 8.9-11.1 8.9-18.6zM128 134c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm0 64c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm253.4 250H96c-17.7 0-32-14.3-32-32 0-17.6 14.4-32 32-32h285.4c-1.9 17.1-1.9 46.9 0 64z"></path></svg><!-- <i class="fa fa-book"></i> Font Awesome fontawesome.com --> AMC Recalls</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://aceamcq.com/#SUBSCRIBE"><svg class="svg-inline--fa fa-book fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M448 360V24c0-13.3-10.7-24-24-24H96C43 0 0 43 0 96v320c0 53 43 96 96 96h328c13.3 0 24-10.7 24-24v-16c0-7.5-3.5-14.3-8.9-18.7-4.2-15.4-4.2-59.3 0-74.7 5.4-4.3 8.9-11.1 8.9-18.6zM128 134c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm0 64c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm253.4 250H96c-17.7 0-32-14.3-32-32 0-17.6 14.4-32 32-32h285.4c-1.9 17.1-1.9 46.9 0 64z"></path></svg><!-- <i class="fa fa-book"></i> Font Awesome fontawesome.com --> AMC Mocks</a>
            </li>
            <hr>



          </ul>
        </div>
      </div>


  </header>

  <div class="container-fluid">

    <div id="Body_ExamScoresBanner" class="row row-blue row-productmenu">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <p class="heading-text exam-scores-pad submit-scores-banner">
                Do you have any question?

                <button id="contact_us"  class="btn btn-sm btn-danger" type="button">Contact Us</button>
            </p>
        </div>
    </div>

  </div>

  <div class="content">
    <div class="container">

      <div class="row" >
        <!-- Login Section -->
        <div class="col-md-6" style="margin-bottom: 30px">
            <h5>Login</h5>
            <p>Sign in using your AceAmcQ account</p>
          <div class="login-container">

                <!-- Laravel login form -->
                <form method="POST" action="{{ url('/') }}/login">
                    @csrf


                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="#"  rel="noopener noreferrer" id="btn-forgot" style="color:#013884">Forgot Password?</a>
                        </div>
                        <div class="col-sm-6" style="text-align: right">
                            <button type="submit" class="btn " style="background-color: #013884; color:white;">Login</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>



        <!-- Registration Section -->
        <div class="col-md-6">
            <h5>Registration</h5>
            <p>Create your AceAmcQ account</p>
          <div class="register-container">

              <!-- Laravel registration form -->
              <form method="POST" action="{{ url('/') }}/register">
                @csrf

                @if(session('error2'))
                        <div class="alert alert-danger">{{ session('error2') }}</div>
                    @endif

                    @if(session('account_success'))
                        <div class="alert alert-success">{{ session('account_success') }}</div>
                    @endif


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name') }}" required>
                            @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="last_name" class="form-control fix-register-inputs" placeholder="Last Name" value="{{ old('last_name') }}" required>
                            @if ($errors->has('last_name'))
                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                        @endif
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 17px;">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required>
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <!-- Correct the name attribute for password confirmation -->
                            <input type="password" name="password_confirmation" class="form-control fix-register-inputs" placeholder="Confirm Password" value="{{ old('password_confirmation') }}" required>
                            @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 17px;">
                    <select name="country" id="country" class="form-control" value="{{ old('country') }}" required>
                        <option value="" disabled selected>Select Your Country</option>

                        <!-- Add more countries as needed -->
                    </select>
                    @if ($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                    @endif
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="age_confirmation" id="age_confirmation" required>
                    <label class="form-check-label">By clicking "Register", I confirm that I am over the age of 13 and agree to AceAmcq <a
                        href="#" style="color: #013884">Terms of Use</a> and <a
                        href="#" style="color: #013884">Privacy Policy</a>.</label>
                </div>
                <button type="submit" class="btn " style="background-color: #013884; color:white">Register</button>
            </form>

          </div>


        </div>



      </div>



    </div>
  </div>

  <!-- Footer -->
  <footer class="footer py-3 bg-light">
    <div class="container text-center">
      <span class="text-muted">© 2023 AceAmcQ</span>
    </div>
  </footer>
  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 <!-- Bootstrap JS (optional, for toggling offcanvas) -->
<script src="https://unpkg.com/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Font Awesome JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    #forgot-form {
        display: none;
    }
</style>
  <script>
    $(document).ready(function() {
      // Handle login form submission
      $("#loginForm").submit(function(e) {
        e.preventDefault();
        // Add your login logic here
        console.log("Login button clicked.");
      });

      // Handle registration form submission
      $("#registerForm").submit(function(e) {
        e.preventDefault();
        // Add your registration logic here
        console.log("Register button clicked.");
      });


              // Function to populate the select element with a list of all countries
              function populateCountries() {
            const countrySelect = $('#country');
            $.ajax({
                url: 'https://restcountries.com/v3.1/all',
                method: 'GET',
                success: function (response) {
                    response.forEach(function (country) {
                        const option = $('<option></option>');
                        option.val(country.name.common);
                        option.text(country.name.common);
                        countrySelect.append(option);
                    });
                },
                error: function (xhr) {
                    console.error('Error fetching country data: ' + xhr.statusText);
                }
            });
        }

        // Call the populateCountries function to load the options
        populateCountries();





        // forgot passoword form code

        // Add click event listener to the button
        $("#btn-forgot").click(function () {
                // Show the modal
                $("#forgotModal").modal("show");
            });



        // Add submit event listener to the form
        $("#forgot-form2").submit(function (event) {
            event.preventDefault();

            // Get form data
            var formData = {
                email: $("#email2").val(),
            };

            $.ajax({
                type: "POST",
                url: "/forgot_password",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function (response) {
                    if (response.errors) {
                        // Display the errors for the 'email' field
                        $('#forgot_password_error').text(response.errors.email[0]);
                    } else {
                        $('#forgot_password_error').text('');
                        $("#forgotModal").modal("hide");
                    }
                },
                error: function (xhr, status, error) {
                    // Handle the error response
                    var errorMessage = "An error occurred while processing your request.";
                    if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.email) {
                        errorMessage = xhr.responseJSON.errors.email[0];
                    }
                    $('#forgot_password_error').text(errorMessage);
                }
            });
        });



         // Add click event listener to the button
         $("#contact_us").click(function () {
                // Show the modal
                $("#contact_us_model").modal("show");
            });



                    // Add submit event listener to the form
            $("#contact_us_form").submit(function (event) {
                event.preventDefault();

                // Get form data
                var formData = {
                    name: $("#name").val(),
                    email: $("#email3").val(),
                    massage: $("#massage").val(),
                };

                $.ajax({
                    type: "POST",
                    url: "/contact_us",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function (response) {
                        if (response.errors) {
                            // Display validation errors
                            $('#massage_error').text(response.errors.massage[0]);
                            $('#email3_error').text(response.errors.email[0]);
                            $('#name_error').text(response.errors.name[0]);
                        } else if (response.error) {
                            // Display email sending error
                            $('#form_error').text(response.error);
                        } else {
                            // Clear errors and close modal
                            $('#massage_error').text('');
                            $('#email3_error').text('');
                            $('#name_error').text('');
                            $("#contact_us_model").modal("hide");
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle Ajax request error
                        $('#form_error').text("An error occurred while processing your request.");
                    }

                });
            });



    });
  </script>


</body>

<!--forgot password model model -->
<div class="modal fade" id="forgotModal" tabindex="-1" aria-labelledby="forgotModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="forgotModal">Forgot Password</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="forgot-form2" >


                <div class="row" style="padding: 20px;">

                    <div class="col-sm-9">

                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="email2" placeholder="Email" required>
                            <span class="text-danger"  id="forgot_password_error"></span>
                        </div>
                    </div>

                    <div class="col-sm-3" style="text-align: right">
                        <button type="submit" class="btn " style="background-color: #013884; color:white;">Submit</button>
                    </div>


                </div>



            </form>
        </div>

      </div>
    </div>
  </div>


<!--contact us model model -->
  <div class="modal fade" id="contact_us_model" tabindex="-1" aria-labelledby="forgotModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="forgotModal">Contact Us</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="contact_us_form" >

                <span class="text-danger"  id="form_error"></span>
                <div class="row" style="padding: 20px;">

                    <div class="col-sm-6" style=" margin-bottom:20px;">

                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name" placeholder="name" required>
                            <span class="text-danger"  id="name_error"></span>
                        </div>
                    </div>
                    <div class="col-sm-6" style=" margin-bottom:20px;">

                        <div class="form-group">
                            <input type="email" class="form-control" name="email3" id="email3" placeholder="Email" required>
                            <span class="text-danger"  id="email3_error"></span>
                        </div>
                    </div>

                    <div class="col-sm-12">

                        <div class="form-group">
                            <textarea  class="form-control" name="massage" id="massage" placeholder="Massage" required></textarea>
                            <span class="text-danger"  id="massage_error"></span>
                        </div>
                    </div>

                    <br><br>


                        <div class="col-sm-12" style="text-align: right; margin-top: 30px;" >
                            <button type="submit" class="btn " style="background-color: #013884; color:white;">Submit</button>
                        </div>




                </div>



            </form>
        </div>

      </div>
    </div>
  </div>

</html>
