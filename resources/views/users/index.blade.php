<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>User Main Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .content {
      flex: 1;
      padding: 0px;
    }

    .footer {
      flex-shrink: 0;
    }

    .tab-content {
      text-align: center;

    }

    .nav-tabs {
      justify-content: center;
      background-color:#EDEDED;

    }

    .nav-link {
      color: #333;

    }

    .nav-link.active {
      color: #1e88e5 !important;
    }

    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
      background-color: transparent;
      border: none;
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

.vertical-line {
      border-left: 2px solid #000;
      height: 100%;
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




  </style>
</head>

<body>
    <header>
        <!-- Header -->
        <nav class="navbar navbar-light ">
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
                <a class="nav-link" href="#"><i class="fa fa-book"></i> AMC Qbanks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-book"></i> AMC Recalls</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-book"></i> AMC Mocks</a>
            </li>
            <hr>

            <li class="nav-item">
                <a class="nav-link" href="{{url('/user_logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
            </li>


            </ul>
        </div>
        </div>
    </header>



  <!-- Content -->
  <div  class="container-fluid content">

  <div id="Body_ExamScoresBanner" class="row mr--0 row-blue row-productmenu   ">
	<div class="col-lg-12 col-md-12 col-sm-12 col-12" >

        <p class="heading-text exam-scores-pad submit-scores-banner">
            Do you have any question?

            <button id="contact_us"  class="btn btn-sm btn-danger" type="button">Contact Us</button>
        </p>

    </div>



</div>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#subscription" data-toggle="tab">Subscription</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#profile" data-toggle="tab">Profile</a>
      </li>
    </ul>

    <div class="tab-content mt-3">

      <!-- Subscription Tab -->
        <div id="subscription" class="tab-pane fade show active">
            <div class="container mt-4">


                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-12 col-12">

                        <div id="subsctipion-container">


                        @if (!$activeSubscriptions->isEmpty())
                        @foreach ($activeSubscriptions as $subscription)
                            <div style="background-color: #DCF0E7; padding:10px; margin: auto; margin-bottom:10px;"
                                class="row row-active row-subscriptionentry sub-row-pad-y">

                                <div class="col-sm-6 md-border-right-sub course-padding-mem-area">
                                    <div class="table-subscription">
                                        <div class="align-vert-center text-left pl-3">
                                            <div class="p-subscription-title"  id="subscription_name">
                                                {{ $subscription->subscription_name }}
                                            </div>
                                            <div id="Body_PageContent_rpAllSubscriptions_rpSubSubscriptions_0_activeSubPnl_0">
                                                <div class="p-subscription-desc"><span style="color: #1d89e4;">Expires:</span> <span id="expiry_date"> {{ $subscription->pivot->expiry_timestamp }}</span>
                                                    EDT <i class="fal fa-info-circle" id="cpaEliteRenewalInfo_9660667" data-toggle="popover"
                                                    data-container="body" data-placement="top" style="margin-right: 10px; cursor: pointer;
                                                    color: #0C9CCE; display:none" data-original-title="" title=""></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="Body" class="col-sm-6 col-12 center-xs">

                                    <div class="table-subscription mt-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" id="btn1" class="btn btn-sm btn-success ml-2 float-right"><a style="color:white; text-decoration:none;" href="{{ url($subscription->lunch_link, ['id' => encrypt($subscription->subscription_id)]) }}"> Lunch </a></button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" id="btn2" class="btn btn-sm btn-primary ml-2 float-right"><a style="color:white; text-decoration:none;" href="{{ url($subscription->renewal_link) }}"> Extend </a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                        @endif



                        @if (!$expiredSubscriptions->isEmpty())
                        @foreach ($expiredSubscriptions as $expiredsubscription)
                            <div style="background-color: #DCF0E7; padding:10px; margin: auto; margin-bottom:10px;"
                                class="row row-active row-subscriptionentry sub-row-pad-y">

                                <div class="col-sm-6 md-border-right-sub course-padding-mem-area">
                                    <div class="table-subscription">
                                        <div class="align-vert-center text-left pl-3">
                                            <div class="p-subscription-title"  id="subscription_name">
                                                {{ $expiredsubscription->subscription_name }}
                                            </div>
                                            <div id="Body_PageContent_rpAllSubscriptions_rpSubSubscriptions_0_activeSubPnl_0">
                                                <div class="p-subscription-desc"><span style="color: #1d89e4;">Expires:</span> <span id="expiry_date"> {{ $expiredsubscription->pivot->expiry_timestamp }} EDT</span>
                                                     <i class="fal fa-info-circle" id="cpaEliteRenewalInfo_9660667" data-toggle="popover"
                                                    data-container="body" data-placement="top" style="margin-right: 10px; cursor: pointer;
                                                    color: #0C9CCE; display:none" data-original-title="" title=""></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="Body" class="col-sm-6 col-12 center-xs">

                                    <div class="table-subscription mt-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" id="btn1" class="btn btn-sm btn-danger ml-2 float-right"><a style="color:white; text-decoration:none;" href="{{ url($expiredsubscription->demo_link) }}"> Expired </a></button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" id="btn2" class="btn btn-sm btn-primary ml-2 float-right"><a style="color:white; text-decoration:none;" href="{{ url($expiredsubscription->renewal_link) }}"> Renew </a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                        @endif



                        @if (!$notSubscribedSubscriptions->isEmpty())
                        @foreach ($notSubscribedSubscriptions as $notsubscription)
                            <div style="background-color: #DCF0E7; padding:10px; margin: auto; margin-bottom:10px;"
                                class="row row-active row-subscriptionentry sub-row-pad-y">

                                <div class="col-sm-6 md-border-right-sub course-padding-mem-area">
                                    <div class="table-subscription">
                                        <div class="align-vert-center text-left pl-3">
                                            <div class="p-subscription-title"  id="subscription_name">
                                                {{ $notsubscription->subscription_name }}
                                            </div>
                                            <div id="Body_PageContent_rpAllSubscriptions_rpSubSubscriptions_0_activeSubPnl_0">
                                                <div class="p-subscription-desc"><span style="color: #1d89e4;">Expires:</span> <span id="expiry_date"> Unlimited Time</span>
                                                     <i class="fal fa-info-circle" id="cpaEliteRenewalInfo_9660667" data-toggle="popover"
                                                    data-container="body" data-placement="top" style="margin-right: 10px; cursor: pointer;
                                                    color: #0C9CCE; display:none" data-original-title="" title=""></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="Body" class="col-sm-6 col-12 center-xs">

                                    <div class="table-subscription mt-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" id="btn1" class="btn btn-sm btn-info ml-2 float-right"><a style="color:white; text-decoration:none;" href="{{ url($notsubscription->demo_link) }}"> Try Demo </a></button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" id="btn2" class="btn btn-sm btn-primary ml-2 float-right"><a style="color:white; text-decoration:none;" href="{{ url($notsubscription->renewal_link ) }}"> Subscribe </a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                        @endif






                        </div> <!-- subscription container end -->





                    </div> <!-- column end -->
                </div><!-- row end -->




            </div><!--container end -->

        </div><!--subscription tab end -->

      <!-- User Profile Tab -->
      <div id="profile" class="tab-pane fade">

        <!-- Add user profile content here -->

   <div class="container">
  <div class="row">
    <!-- User Information Form -->
    <div class="col-md-5">
      <h6>User Information</h6>
      <form id="userInformationForm">
        <div class="row">
          <div class="col">
            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
          <input type="text" class="form-control mt-2" id="first_name" name="first_name" placeholder="First Name" value="{{ $user->first_name }}"  required>
           <span class="text-danger" id="first_name_error"></span>
          </div>
          <div class="col">
            <input type="text" class="form-control mt-2" id="last_name" name="last_name" placeholder="Last Name" value="{{ $user->last_name }}" required>
            <span class="text-danger" id="last_name_error"></span>
          </div>

        </div>
        <input type="text" class="form-control mt-2" id="address" name="address" placeholder="Address" value="{{ $user->address }}" required>
        <span class="text-danger" id="address_error"></span>
        <div class="row">
          <div class="col">
          <input type="text" class="form-control mt-2" id="address2" name="address2" placeholder="Address2" value="{{ $user->address2}}" >
          <span class="text-danger" id="address2_error"></span>
        </div>
          <div class="col">
            <input type="text" class="form-control mt-2" id="city" name="city" placeholder="City" value="{{ $user->city}}" required >
            <span class="text-danger" id="city_error"></span>
        </div>

        </div>

        <div class="row">

          <div class="col">
            <select class="form-control mt-2" id="country" name="country"  value="{{ $user->country }}"   required>
                <option value="" disabled selected>Select Your Country</option>

                <!-- Add more security questions as needed -->
            </select>
            <span class="text-danger" id="country_error"></span>
          </div>


          <div class="col">
            <input type="text" class="form-control mt-2" id="phone" name="phone" placeholder="Phone Nunmber" value="{{ $user->phone }}" required>
            <span class="text-danger" id="phone_error"></span>
        </div>

        </div>


        <input type="email" class="form-control mt-2" id="email" name="email" placeholder="Email" value="{{ $user->email }}"  required>
        <span class="text-danger" id="email_error"></span>

        <div class="form-check mt-2">
          <input type="checkbox" class="form-check-input" id="receive_service_update" name="receive_service_update"   {{ $user->receive_service_update == 0 ? 'checked' : '' }} >
          <label class="form-check-label" for="receive_service_update">I do not want to receive notifications about my subscription (renewal reminders and service updates).</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="receive_promotion_update" name="receive_promotion_update" {{ $user->receive_promotion_update == 0 ? 'checked' : '' }}>
          <label class="form-check-label" for="receive_promotion_update">I do not want to receive promotions about future products and special offers.</label>
        </div>
        <!-- Add more user information fields as needed -->
        <button type="submit" class="btn btn-primary mt-2">Update</button>
      </form>
    </div>

    <!-- Vertical Line -->
    <div class="col-md-1 vertical-line"></div>

    <!-- Change Password and Security Question Form -->
    <div class="col-md-5">
      <h6>Change Password </h6>
      <form id="change_password_form">
        <input type="hidden" name="user_id3"  id="user_id3" value="{{ $user->id  }}" >
        <input type="password" class="form-control mt-2" id="current_password" name="current_password" placeholder="Current Password" required>
        <span class="text-danger" id="current_password_error"></span>
        <input type="password" class="form-control mt-2" id="new_password" name="new_password" placeholder="New Password" required>
        <span class="text-danger" id="new_password_error"></span>
        <input type="password" class="form-control mt-2" id="confirm_password" name="new_password_confirmation"  placeholder="Confirm New Password" required>
        <span class="text-danger" id="confirm_password_error"></span>
        <div style="text-align: left;" class="form-check mt-2">
          <input type="checkbox" class="form-check-input" id="show_password" name="show_password">
          <label class="form-check-label" for="show_password">show password</label>
        </div>

        <!-- Add more password fields as needed -->
        <button id="password_btn" class="btn btn-primary mt-2">Update</button>
      </form>


    </div>
  </div>

  <!-- Horizontal Line -->
  <hr>

</div>

</div>  <!-- profile tab end div -->






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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


   <script>
     $(document).ready(function() {

              // Function to populate the select element with a list of all countries
              function populateCountries() {
            const countrySelect = $('#country');
            $.ajax({
                url: 'https://restcountries.com/v3.1/all',
                method: 'GET',
                success: function (response) {
                    response.forEach(function (country) {
                        const option = $('<option ></option>');
                        option.val(country.name.common);
                        option.text(country.name.common);

                        // Check if the current option's value matches the user's country
                        if ('{{ $user->country }}' === country.name.common) {
                            option.attr('selected', 'selected');
                        }
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



        $("#userInformationForm").submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Reset previous error messages
            $(".text-danger").text("");

            // Get the form data
            var formData = $(this).serializeArray();

            // Check the state of the checkboxes and add them to the form data
            if ($("#receive_service_update").is(":checked")) {
                formData.push({ name: "receive_service_update", value: 0 });
            } else {
                formData.push({ name: "receive_service_update", value: 1 });
            }

            if ($("#receive_promotion_update").is(":checked")) {
                formData.push({ name: "receive_promotion_update", value: 0 });
            } else {
                formData.push({ name: "receive_promotion_update", value: 1 });
            }

            // Send an AJAX request to update the user information
            $.ajax({
                type: "POST", // or "PUT" depending on your update logic
                url: "/update_user_profile_info", // Replace with your Laravel route
                headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                data: formData,
                success: function(response) {
                    // Handle the response if needed
                    displaySuccessAlert("Success", "Information update sucessfully!");




                },
                error: function(err) {
                    // Handle errors if the request fails
                    if (err.status === 422) {
                        // Handle validation errors
                        var errors = err.responseJSON.errors;

                        for (var field in errors) {
                            $("#" + field + "_error").text(errors[field][0]);
                        }
                    } else {
                        displayErrorAlert("Error", "Something Went Wrong!");
                    }
                }
            });
        });


        $('#password_btn').on('click', function (e) {
            e.preventDefault();

            // Get form data
            var formData = $('#change_password_form').serialize();

            // Make Ajax request
            $.ajax({
                url: '/change_user_password',
                type: 'POST',
                headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                data: formData,
                success: function (response) {
                    // Handle success, e.g., show a success message

                    displaySuccessAlert("Success", "Password updated successfully!");
                },
                error: function (xhr) {
                    // Handle errors, e.g., display error messages
                    var errors = xhr.responseJSON.errors;

                    if (errors) {
                        // Display errors for each field
                        $('#current_password_error').text(errors.current_password);
                        $('#new_password_error').text(errors.new_password);
                        $('#confirm_password_error').text(errors.confirm_password);
                    }
                }
            });
        });

        // Show/hide password based on checkbox state
        $('#show_password').change(function () {


            var passwordFields = $('#current_password, #new_password, #confirm_password');

            if ($(this).is(':checked')) {
                passwordFields.attr('type', 'text');
            } else {
                passwordFields.attr('type', 'password');
            }
        });










        function displaySuccessAlert(title, message) {
                    Swal.fire({
                        icon: 'success',
                        title: title,
                        text: message,
                        showConfirmButton: false,
                        timer: 2000,
                        customClass: {
                            popup: 'animated tada' // Add your custom animation class
                        },
                        background: '#fff', // Change the background color
                        iconColor: '#28a745', // Change the success icon color
                        timerProgressBar: true // Show a progress bar during the timer
                    });
                }


                function displayErrorAlert(title, message) {
                Swal.fire({
                    icon: 'error',
                    title: title,
                    text: message,
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        popup: 'animated tada' // Add your custom animation class
                    },
                    background: '#fff', // Change the background color
                    iconColor: '#dc3545', // Change the error icon color to red
                    timerProgressBar: true // Show a progress bar during the timer
                });
            }






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






    });// ready function end

   </script>




</body>



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
                            <input type="text" class="form-control" name="name" id="name" placeholder="name" value="{{ $user->first_name . ' ' . $user->last_name }}"  required>
                            <span class="text-danger"  id="name_error"></span>
                        </div>
                    </div>
                    <div class="col-sm-6" style=" margin-bottom:20px;">

                        <div class="form-group">
                            <input type="email" class="form-control" name="email3" id="email3" placeholder="Email" value="{{ $user->email}}" required>
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
