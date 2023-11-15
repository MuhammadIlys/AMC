<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Registration Page</title>
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
      padding: 10px 0;
    }

    .content {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-grow: 1;
      width: 100%;
    }

    .login-container,
    .register-container {
      padding: 30px;
      background-color: #f5f5f5; /* Background color for both sections */
      border-radius: 10px;
      border: 1px solid #ccc; /* Border for the containers */
    }

    .login-container {
      margin-right: 20px;
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
    background-color: #1e88e5;
}

.mr--0 {
    margin-right: 0;
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



  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Brand</a>
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
              <a class="nav-link" href="#"><svg class="svg-inline--fa fa-book fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M448 360V24c0-13.3-10.7-24-24-24H96C43 0 0 43 0 96v320c0 53 43 96 96 96h328c13.3 0 24-10.7 24-24v-16c0-7.5-3.5-14.3-8.9-18.7-4.2-15.4-4.2-59.3 0-74.7 5.4-4.3 8.9-11.1 8.9-18.6zM128 134c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm0 64c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm253.4 250H96c-17.7 0-32-14.3-32-32 0-17.6 14.4-32 32-32h285.4c-1.9 17.1-1.9 46.9 0 64z"></path></svg><!-- <i class="fa fa-book"></i> Font Awesome fontawesome.com --> AMC Qbanks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><svg class="svg-inline--fa fa-book fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M448 360V24c0-13.3-10.7-24-24-24H96C43 0 0 43 0 96v320c0 53 43 96 96 96h328c13.3 0 24-10.7 24-24v-16c0-7.5-3.5-14.3-8.9-18.7-4.2-15.4-4.2-59.3 0-74.7 5.4-4.3 8.9-11.1 8.9-18.6zM128 134c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm0 64c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm253.4 250H96c-17.7 0-32-14.3-32-32 0-17.6 14.4-32 32-32h285.4c-1.9 17.1-1.9 46.9 0 64z"></path></svg><!-- <i class="fa fa-book"></i> Font Awesome fontawesome.com --> AMC Recalls</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><svg class="svg-inline--fa fa-book fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M448 360V24c0-13.3-10.7-24-24-24H96C43 0 0 43 0 96v320c0 53 43 96 96 96h328c13.3 0 24-10.7 24-24v-16c0-7.5-3.5-14.3-8.9-18.7-4.2-15.4-4.2-59.3 0-74.7 5.4-4.3 8.9-11.1 8.9-18.6zM128 134c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm0 64c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm253.4 250H96c-17.7 0-32-14.3-32-32 0-17.6 14.4-32 32-32h285.4c-1.9 17.1-1.9 46.9 0 64z"></path></svg><!-- <i class="fa fa-book"></i> Font Awesome fontawesome.com --> AMC Mocks</a>
            </li>
            <hr>

            <li class="nav-item">
              <a class="nav-link" href="#"><svg class="svg-inline--fa fa-sign-out fa-w-16" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="sign-out" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><g><path fill="currentColor" d="M156.5,447.7l-12.6,29.5c-18.7-9.5-35.9-21.2-51.5-34.9l22.7-22.7C127.6,430.5,141.5,440,156.5,447.7z M40.6,272H8.5 c1.4,21.2,5.4,41.7,11.7,61.1L50,321.2C45.1,305.5,41.8,289,40.6,272z M40.6,240c1.4-18.8,5.2-37,11.1-54.1l-29.5-12.6 C14.7,194.3,10,216.7,8.5,240H40.6z M64.3,156.5c7.8-14.9,17.2-28.8,28.1-41.5L69.7,92.3c-13.7,15.6-25.5,32.8-34.9,51.5 L64.3,156.5z M397,419.6c-13.9,12-29.4,22.3-46.1,30.4l11.9,29.8c20.7-9.9,39.8-22.6,56.9-37.6L397,419.6z M115,92.4 c13.9-12,29.4-22.3,46.1-30.4l-11.9-29.8c-20.7,9.9-39.8,22.6-56.8,37.6L115,92.4z M447.7,355.5c-7.8,14.9-17.2,28.8-28.1,41.5 l22.7,22.7c13.7-15.6,25.5-32.9,34.9-51.5L447.7,355.5z M471.4,272c-1.4,18.8-5.2,37-11.1,54.1l29.5,12.6 c7.5-21.1,12.2-43.5,13.6-66.8H471.4z M321.2,462c-15.7,5-32.2,8.2-49.2,9.4v32.1c21.2-1.4,41.7-5.4,61.1-11.7L321.2,462z M240,471.4c-18.8-1.4-37-5.2-54.1-11.1l-12.6,29.5c21.1,7.5,43.5,12.2,66.8,13.6V471.4z M462,190.8c5,15.7,8.2,32.2,9.4,49.2h32.1 c-1.4-21.2-5.4-41.7-11.7-61.1L462,190.8z M92.4,397c-12-13.9-22.3-29.4-30.4-46.1l-29.8,11.9c9.9,20.7,22.6,39.8,37.6,56.9 L92.4,397z M272,40.6c18.8,1.4,36.9,5.2,54.1,11.1l12.6-29.5C317.7,14.7,295.3,10,272,8.5V40.6z M190.8,50 c15.7-5,32.2-8.2,49.2-9.4V8.5c-21.2,1.4-41.7,5.4-61.1,11.7L190.8,50z M442.3,92.3L419.6,115c12,13.9,22.3,29.4,30.5,46.1 l29.8-11.9C470,128.5,457.3,109.4,442.3,92.3z M397,92.4l22.7-22.7c-15.6-13.7-32.8-25.5-51.5-34.9l-12.6,29.5 C370.4,72.1,384.4,81.5,397,92.4z"></path><circle fill="currentColor" cx="256" cy="364" r="28"><animate attributeType="XML" repeatCount="indefinite" dur="2s" attributeName="r" values="28;14;28;28;14;28;"></animate><animate attributeType="XML" repeatCount="indefinite" dur="2s" attributeName="opacity" values="1;0;1;1;0;1;"></animate></circle><path fill="currentColor" opacity="1" d="M263.7,312h-16c-6.6,0-12-5.4-12-12c0-71,77.4-63.9,77.4-107.8c0-20-17.8-40.2-57.4-40.2c-29.1,0-44.3,9.6-59.2,28.7 c-3.9,5-11.1,6-16.2,2.4l-13.1-9.2c-5.6-3.9-6.9-11.8-2.6-17.2c21.2-27.2,46.4-44.7,91.2-44.7c52.3,0,97.4,29.8,97.4,80.2 c0,67.6-77.4,63.5-77.4,107.8C275.7,306.6,270.3,312,263.7,312z"><animate attributeType="XML" repeatCount="indefinite" dur="2s" attributeName="opacity" values="1;0;0;0;0;1;"></animate></path><path fill="currentColor" opacity="0" d="M232.5,134.5l7,168c0.3,6.4,5.6,11.5,12,11.5h9c6.4,0,11.7-5.1,12-11.5l7-168c0.3-6.8-5.2-12.5-12-12.5h-23 C237.7,122,232.2,127.7,232.5,134.5z"><animate attributeType="XML" repeatCount="indefinite" dur="2s" attributeName="opacity" values="0;0;1;1;0;0;"></animate></path></g></svg><!-- <i class="fa fa-sign-out" aria-hidden="true"></i> Font Awesome fontawesome.com --> Logout</a>
            </li>


          </ul>
        </div>
      </div>


  </header>

  <div class="container-fluid">

    <div id="Body_ExamScoresBanner" class="row mr--0 row-blue row-productmenu   ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12" >
            <p class="heading-text exam-scores-pad submit-scores-banner">
                Do you have any question?
                <span class="fontweight-regular">Feel free to contact!</span>
                <button class="btn btn-sm btn-danger" type="button" >Contact Us</button>
            </p>

        </div>
    </div>
  </div>

  <div class="content">
    <div class="container">

      <div class="row">
        <!-- Login Section -->
        <div class="col-md-6">
            <h1 style="background-color:green">Login</h1>
            <p>Sign in using your AceAmcQ account</p>
          <div class="login-container">

                <!-- Laravel login form -->
                <form method="POST" action="{{ url('/') }}/login">
                    @csrf
                    @if(session('login_error'))
                        <div class="alert alert-danger">{{ session('login_error') }}</div>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="http://" target="_blank" rel="noopener noreferrer">Forgot Password?</a>
                        </div>
                        <div class="col-sm-6" style="text-align: right">
                            <button type="submit" class="btn btn-primary">Login</button>
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
                @if(session('registration_error'))
                    <div class="alert alert-danger">{{ session('registration_error') }}</div>
                @endif

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 17px;">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <!-- Correct the name attribute for password confirmation -->
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 17px;">
                    <select name="country" id="country" class="form-control" required>
                        <option value="" disabled selected>Select Your Country</option>

                        <!-- Add more countries as needed -->
                    </select>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" required>
                    <label class="form-check-label">By clicking "Register", I confirm that I am over the age of 13 and agree to <a
                            href="#">AceAmcq Terms of Use and Privacy Policy.</a></label>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
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



    });
  </script>
</body>

</html>
