@extends('super_admin.templates.main')
@section('main-container')

        <div class="container-fluid"><!--  container start -->

        <div class="card">
                  <div class="card-body">
                    <h5 class="mb-3">Add Users</h5>
                    <form id="add_user_form">
                      <div class="row">

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name ">
                              <label for="topic_name">First Name</label>
                              <span id="first_name_error" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name ">
                              <label for="topic_name">Last Name</label>
                              <span id="last_name_error" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input type="email" class="form-control" id="email" name="email" placeholder="email">
                              <label for="topic_name">Email Address</label>
                              <span id="email_error" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input type="password" class="form-control" id="password" name="password" placeholder="password ">
                              <label for="topic_name">Password</label>
                              <span id="password_error" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-floating mb-3">
                                <select class="form-select mr-sm-2" id="country" name="country">
                                    <option value="" disabled selected>Choose Country</option>
                                    <!-- Options will be loaded dynamically using jQuery -->
                                </select>
                                <label for="country">Country</label>
                                <span id="country_error" class="text-danger"></span>
                            </div>

                        </div>



                        <div class="col-12">
                          <div class="d-md-flex align-items-center mt-3">

                                <div class="ms-auto mt-3 mt-md-0">
                                <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                                    <div class="d-flex align-items-center">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Add User
                                    </div>
                                </button>
                                </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>





        </div><!--  container end -->



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



        $('#add_user_form').on('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get the form data
            const formData = $(this).serialize();

            // Send the data to the server to add the user
            $.ajax({
                url: '/add_user', // Replace with the actual Laravel route
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                data: formData,
                success: function (response) {
                    // Clear previous error messages
                    $('#first_name_error').text('');
                    $('#last_name_error').text('');
                    $('#email_error').text('');
                    $('#password_error').text('');
                    $('#country_error').text('');

                    if (response.status === '1') {
                        displaySuccessAlert("Success", response.message);
                    } else {
                        displayErrorAlert("Error", response.message);
                    }

                    $('#add_user_form')[0].reset();
                },
                error: function (xhr) {
                    // Clear previous error messages
                    $('#first_name_error').text('');
                    $('#last_name_error').text('');
                    $('#email_error').text('');
                    $('#password_error').text('');
                    $('#country_error').text('');

                    displayErrorAlert("Error", xhr.responseJSON?.message);

                    // Display Laravel validation errors if available
                    const errors = xhr.responseJSON?.errors;

                    if (errors) {
                        $('#first_name_error').text(errors.first_name?.[0] || '');
                        $('#last_name_error').text(errors.last_name?.[0] || '');
                        $('#email_error').text(errors.email?.[0] || '');
                        $('#password_error').text(errors.password?.[0] || '');
                        $('#country_error').text(errors.country?.[0] || '');
                    }
                }
            });
        });










    });// ready function end


        </script>









        @endsection

