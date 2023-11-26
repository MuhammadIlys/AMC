@extends('super_admin.templates.main')
@section('main-container')

        <div class="container-fluid"><!--  container start -->

        <div class="row">
                        <div class="col-12">
                            <!-- ---------------------
                                    start Zero Configuration
                                ---------------- -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <h5 class="mb-0">Mocks Subscribe Users</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">

                                        <table id="user_table" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                            <thead>
                                                <!-- start row -->
                                                <tr><th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;"> User ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;"> First Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Last Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Email </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Country Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 39.7969px;">Action</th>
                                                </tr>
                                                <!-- end row -->
                                            </thead>
                                            <tbody>
                                             <!-- boy will load dynamically -->

                                            </tbody>



                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- ---------------------
                                    end Zero Configuration
                                ---------------- -->
                        </div>
                    </div>





        </div><!--  container end -->


        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

     <script>

        $(document).ready(function () {



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

                    // Function to initialize DataTable
                    function initializeDataTable() {
                        return $('#user_table').DataTable({
                            ajax: '/get_mocks_user_data', // Update the URL to fetch user data
                            columns: [
                                { data: 'id' }, // Use 'id' as the primary key for users
                                { data: 'first_name' }, // Column for First Name
                                { data: 'last_name' }, // Column for Last Name
                                { data: 'email' }, // Column for Email
                                { data: 'country' }, // Column for Country Name

                                {
                                    data: null,
                                    render: function (data, type, row) {
                                        return `
                                            <button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary" data-id="${data.id}" data-firstname="${data.first_name}" data-lastname="${data.last_name}" data-email="${data.email}"  data-country="${data.country}">Edit</button>
                                            <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger" data-id="${data.id}">Delete</button>
                                            <button class="subscription-btn btn-success btn btn-sm mb-1 waves-effect waves-light " data-id="${data.id}">Add Mocks</button>
                                        `;
                                    }
                                }
                            ],
                            rowCallback: function (row, data, index) {
                                // Apply even/odd classes to rows
                                $(row).removeClass('even odd');
                                $(row).addClass(index % 2 === 0 ? 'even' : 'odd');
                            }
                        });
                    }


            // Initialize DataTable
            var table = initializeDataTable();

//########################################################################################

            // Handle Delete button click
            $('#user_table').on('click', '.delete-btn', function () {
                    var userId = $(this).data('id');

                    // Display a confirmation alert
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this record!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User confirmed deletion, send AJAX request to delete the record
                            axios.delete(`/delete_user/${userId}`)
                                .then(response => {
                                    // Successful deletion, refresh the table
                                    displaySuccessAlert('Success', response.data.message);
                                    // Reload the DataTable
                                    table.destroy();
                                    table = initializeDataTable();
                                })
                                .catch(error => {
                                    displayErrorAlert('Error', 'Error deleting record');
                                });
                        }
                    });
                });

//########################################################################################

            // Handle Edit button click in table
        $('#user_table').on('click', '.edit-btn', function () {


                var firstName = $(this).data('firstname');
                var lastName = $(this).data('lastname');
                var email = $(this).data('email');
                var country = $(this).data('country');
                var id = $(this).data('id');

                $('#first_name').val(firstName);
                $('#last_name').val(lastName);
                $('#email').val(email);
                $('#country').val(country);
                $('#user_id').val(id);




                $('#edit_user_model').modal('show');


        });






        $('#updateUser').click(function() {

            var firstName = $('#first_name').val();
            var lastName = $('#last_name').val();
            var email = $('#email').val();
            var country = $('#country').val();
            var userId = $('#user_id').val();

            var data = {
                userId: userId,
                first_name: firstName, // Use snake_case to match Laravel validation rules
                last_name: lastName,
                email: email,
                country: country
            };

            $.ajax({
                type: 'POST',
                url: '/update_user',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    if (response.message) {
                        displaySuccessAlert('Success', 'User updated successfully!');
                        table.destroy();
                        table = initializeDataTable();
                        $('#edit_user_model').modal('hide');
                    } else {
                        displayErrorAlert('Unexpected response format:', response);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        // Clear previous error messages
                        $('.text-danger').empty();

                        $.each(errors, function(key, value) {
                            var errorField = $('#' + key + '_error');
                            errorField.text(value[0]); // Display the error message in the span
                        });
                    } else {
                        displayErrorAlert('Error updating user:', xhr.responseText);

                    }
                }
            });
        });


//########################################################################################



        // Handle add subscription
        $('#user_table').on('click', '.subscription-btn', function () {

            var id = $(this).data('id');
            // Create a URL with the 'id' parameter
            var url = '/add_mocks_to_mocks_user_view/' + id;
            // Navigate to the URL using the GET method
            window.location.href = url;

        });
























        });// ready function end

    </script>




<div class="modal fade" id="edit_user_model" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="questionModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form id="edit_user_form">
                <div class="row">
                  <input type="hidden" name="user_id" id="user_id">
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
                          <select class="form-select mr-sm-2" id="country" name="country">
                              <option value="" disabled selected>Choose Country</option>
                              <!-- Options will be loaded dynamically using jQuery -->
                          </select>
                          <label for="country">Country</label>
                          <span id="country_error" class="text-danger"></span>
                      </div>

                  </div>




                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="updateUser" type="button" class="btn btn-primary" form="question-form">Update User</button>
        </div>
      </div>
    </div>
  </div>





  <div class="modal fade" id="add_subscription_model" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="questionModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form id="add_subscription_form">
                <div class="row">
                  <input type="hidden" name="user_id" id="user_id">
                  <div class="col-md-6">

                      <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" value="2008-05-13T22:33:00">
                        <label for="topic_name">Subscription Start Date and Time</label>
                        <span id="first_name_error" class="text-danger"></span>
                      </div>

                  </div>

                  <div class="col-md-6">

                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" value="2008-05-13T22:33:00">
                        <label for="topic_name">Subscription Ending Date and Time</label>
                        <span id="first_name_error" class="text-danger"></span>
                    </div>

                  </div>

                  <div class="col-md-4">
                      <div class=" form-check form-check-inline mb-3 ">
                        <input class="form-check-input success check-outline outline-success" type="checkbox" id="success2-outline-check" value="option1" checked="">
                        <label class="form-check-label" for="success2-outline-check">Checked</label>
                        <span id="email_error" class="text-danger"></span>
                      </div>
                  </div>






                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="updateUser" type="button" class="btn btn-primary" form="question-form">Add Subscription</button>
        </div>
      </div>
    </div>
  </div>

@endsection
