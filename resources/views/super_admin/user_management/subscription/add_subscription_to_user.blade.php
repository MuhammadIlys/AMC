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
                                    <h5 class="mb-0">Add New Subscription</h5>
                                </div>

                                <form id="add_subscription_form">
                                    <div class="row">
                                      <input type="hidden" name="user_id" id="user_id" value="{{ $id }}">
                                      <div class="col-md-6">

                                          <div class="form-floating mb-3">
                                            <input type="datetime-local" class="form-control" value="2023-05-13T22:33:00" id="start_date" name="start_date">
                                            <label for="start_date">Subscription Start Date and Time</label>
                                            <span id="start_date_error" class="text-danger"></span>
                                          </div>

                                      </div>

                                      <div class="col-md-6">

                                        <div class="form-floating mb-3">
                                            <input type="datetime-local" class="form-control" value="2023-05-13T22:33:00" id="end_date" name="end_date">
                                            <label for="end_date">Subscription Ending Date and Time</label>
                                            <span id="end_date_error" class="text-danger"></span>
                                        </div>

                                      </div>

                                       <!-- Create a container for the radio buttons -->
                                       <div id="radioButtonsContainer" class="col-md-12">

                                       </div>
                                       <span id="subscription_id_error" class="text-danger"></span>




                                        <div class="col-12">
                                            <div class="d-md-flex align-items-center mt-3">

                                                  <div class="ms-auto mt-3 mt-md-0">
                                                  <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                                                      <div class="d-flex align-items-center">
                                                      <i class="ti ti-send me-2 fs-4"></i>
                                                      Add Subscription
                                                      </div>
                                                  </button>
                                                  </div>
                                            </div>
                                          </div>



                                    </div>

                                </form>




                                <div class="table-responsive">

                                    <div id="zero_config_wrapper" class="dataTables_wrapper">

                                        <table id="subscription_table" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                            <thead>
                                                <tr>
                                                    <th class="sorting" style="width: 141.234px;"> ID </th>
                                                    <th class="sorting" style="width: 236.094px;">First Name</th>
                                                    <th class="sorting" style="width: 141.234px;"> Subscription </th>
                                                    <th class="sorting" style="width: 236.094px;">Subscription Status</th>
                                                    <th class="sorting" style="width: 236.094px;">Start Date</th>
                                                    <th class="sorting" style="width: 236.094px;">End Date</th>
                                                    <th class="sorting" style="width: 39.7969px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data will load dynamically -->
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


$(document).ready(function() {



    function initializeDataTable() {
        var userId={{ $id }}
    return $('#subscription_table').DataTable({
        ajax: {
            url: '/load_subcription_data_to_table',
            data: { userId: userId },
            dataSrc: '' // This tells DataTables to use the root of the JSON array
        },
        columns: [
            { data: 'id' },
            {
                data: 'user.first_name',
                render: function (data, type, row) {
                    return data;
                }
            },
            {
                data: 'subscription.subscription_name',
                render: function (data, type, row) {
                    return data;
                }
            },
            {
                data: 'activation_timestamp',
                render: function (data, type, row) {

                    const activationTimestamp = new Date(data);
                    const expiryTimestamp = new Date(row.expiry_timestamp);
                    const currentDate = new Date();

                    const status = currentDate < expiryTimestamp ? "Active" : "Inactive";

                    const badgeClass = status === "Active" ? "mb-1 badge rounded-pill text-bg-success" : "mb-1 badge rounded-pill text-bg-danger";

                    const badgeHTML = `<span class="badge ${badgeClass}">${status}</span>`;

                    return badgeHTML;


                }
            },
            {
                data: 'activation_timestamp',
                render: function (data, type, row) {
                    return data
                }
            },
            {
                data: 'expiry_timestamp',
                render: function (data, type, row) {
                    return data
                }
            },
            {
                data: null, // Use the correct property for the ID
                render: function (data, type, row) {
                    return `
                        <button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary" data-end_date="${data.expiry_timestamp}" data-start_date="${data.activation_timestamp}" data-id="${data.id}" data-subscription_id="${data.subscription_id}" data-user_id="${data.user_id}">Edit</button>
                        <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger" data-id="${data.id}">Delete</button>
                    `;
                }
            }
        ],
        rowCallback: function (row, data, index) {
            $(row).removeClass('even odd');
            $(row).addClass(index % 2 === 0 ? 'even' : 'odd');
        }
    });
}





    // Initialize DataTable
    var table = initializeDataTable();


    // Function to load radio buttons dynamically
    function loadRadioButtons() {
        $.ajax({
            url: '/get_subscription_names',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Clear the existing content in the container
                $('#radioButtonsContainer').empty();

                // Loop through the data and create radio buttons
                $.each(data, function(index, subscription) {
                    var radioContainer = $('<div class="form-check form-check-inline mb-3"></div>');
                    var radioInput = $('<input class="form-check-input" type="radio" id="subcription_id"  name="subcription_id" value="' + subscription.subscription_id + '">');
                    var radioLabel = $('<label class="form-check-label" for="subscription' + subscription.subscription_id + '">' + subscription.subscription_name + '</label>');

                    // Append the radio button to the container
                    radioContainer.append(radioInput);
                    radioContainer.append(radioLabel);

                    // Append the container to the radioButtonsContainer
                    $('#radioButtonsContainer').append(radioContainer);
                });
            },
            error: function() {
                // Handle errors
                console.error('Failed to load subscriptions');
            }
        });
    }

    // Load radio buttons on page load
    loadRadioButtons();


    function loadRadioButtons1() {
        $.ajax({
            url: '/get_subscription_names',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Clear the existing content in the container
                $('#radioButtonsContainer1').empty();

                // Loop through the data and create radio buttons
                $.each(data, function(index, subscription) {
                    var radioContainer = $('<div class="form-check form-check-inline mb-3"></div>');
                    var radioInput = $('<input class="form-check-input" type="radio" id="subcription_id1"  name="subcription_id1" value="' + subscription.subscription_id + '">');
                    var radioLabel = $('<label class="form-check-label" for="subscription' + subscription.subscription_id + '">' + subscription.subscription_name + '</label>');

                    // Append the radio button to the container
                    radioContainer.append(radioInput);
                    radioContainer.append(radioLabel);

                    // Append the container to the radioButtonsContainer
                    $('#radioButtonsContainer1').append(radioContainer);
                });
            },
            error: function() {
                // Handle errors
                console.error('Failed to load subscriptions');
            }
        });
    }

    // Load radio buttons on page load
    loadRadioButtons1();

    // Handle form submission
    $('#add_subscription_form').submit(function(event) {

        event.preventDefault(); // Prevent the default form submission

        // Clear previous error messages
        $('.text-danger').empty();
        var selectedValue = $('input[name="subcription_id"]:checked').val();


        // Create a JavaScript object to hold the form data
        var formData = {
            user_id: $('#user_id').val(),
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
            subscription_id:selectedValue
        };



     // Make an AJAX request to store the form data
        $.ajax({
            url: '/add_subscription_to_user',
            method: 'POST',
            data: formData, // Send the JavaScript object
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === '1') {
                    displaySuccessAlert('Success', response.message);
                    loadRadioButtons();
                    table.destroy();
                    table = initializeDataTable();
                }else{

                    displayErrorAlert('Error', response.message);
                    loadRadioButtons();

                }
            },
            error: function (xhr, status, error) {
                // Handle validation errors
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    $.each(errors, function (field, messages) {
                        // Display validation errors next to the corresponding form fields
                        $('#' + field + '_error').text(messages[0]);
                    });
                } else {
                    // Display a generic error message
                    displayErrorAlert('Error', 'An error occurred. Please try again.');
                }
            }
        });

    });





            // Handle Delete button click
            $('#subscription_table').on('click', '.delete-btn', function () {
                var subscriptionId = $(this).data('id');

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
                        axios.delete(`/delete_user_subscription/${subscriptionId}`)
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


        // Handle Edit button click in table
    $('#subscription_table').on('click', '.edit-btn', function () {


        var id = $(this).data('id');
        var endDate = $(this).data('end_date');
        var startDate = $(this).data('start_date');
        var subscriptionId = $(this).data('subscription_id');
        var userId = $(this).data('user_id');




        // Populate the form fields with subscription data
        $('#id').val(id);
        $('#start_date1').val(startDate);
        $('#end_date1').val(endDate);
        $('#user_id1').val(userId);
        $('input[name="subcription_id1"][value="' + subscriptionId + '"]').prop('checked', true);

        $('.text-danger').empty();

        // Show the edit subscription modal
        $('#edit_subscription_model').modal('show');


        });




    $('#updateSubscription').click(function() {

        var id = $('#id').val();
        var subscriptionId = $('input[name="subcription_id1"]:checked').val();
        var startDate = $('#start_date1').val();
        var endDate = $('#end_date1').val();
        var userId = $('#user_id1').val();



        var data = {
            id: id,
            subscriptionId: subscriptionId,
            startDate: startDate,
            endDate: endDate,
            userId: userId,

        };

        $.ajax({
            type: 'POST',
            url: '/update_user_subscription_data',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function(response) {
                if (response.message) {
                    displaySuccessAlert('Success', 'Subscription updated successfully!');
                    table.destroy();
                    table = initializeDataTable();
                    $('#edit_subscription_model').modal('hide');
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
                    displayErrorAlert('Error updating subscription:', xhr.responseText);
                }
            }
        });


    });









});// ready function end

    </script>



<div class="modal fade" id="edit_subscription_model" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="questionModalLabel">Update Subscription</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form id="add_subscription_form">

                <div class="row">
                  <input type="hidden" name="user_id1" id="user_id1" >
                  <input type="hidden" name="id" id="id">
                  <div class="col-md-6">

                      <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" value="" id="start_date1" name="start_date1">
                        <label for="start_date1">Subscription Start Date and Time</label>
                        <span id="start_date1_error" class="text-danger"></span>
                      </div>

                  </div>

                  <div class="col-md-6">

                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" value="" id="end_date1" name="end_date1">
                        <label for="end_date1">Subscription Ending Date and Time</label>
                        <span id="end_date1_error" class="text-danger"></span>
                    </div>

                  </div>

                   <!-- Create a container for the radio buttons -->
                   <div id="radioButtonsContainer1" class="col-md-12">

                   </div>
                   <span id="subscription_id_error" class="text-danger"></span>



                </div>

            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="updateSubscription" type="button" class="btn btn-primary" form="question-form">Update Subscription</button>
        </div>
      </div>
    </div>
  </div>

    @endsection
