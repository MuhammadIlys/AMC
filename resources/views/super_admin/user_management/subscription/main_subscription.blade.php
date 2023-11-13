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
                                        <h5 class="mb-0">Subscription List</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">

                                        <table id="subscription_table" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                            <thead>
                                                <!-- start row -->
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;"> Subscription ID </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Subscription Name </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;"> Demo Link</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Lunch Link</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Renewal Link</th>
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


              // Function to initialize DataTable
                function initializeDataTable() {
                    return $('#subscription_table').DataTable({
                        ajax: '/get_subscription_data', // Update the URL to fetch subscription data
                        columns: [
                            { data: 'subscription_id' }, // Use 'subscription_id' as the primary key for subscriptions
                            { data: 'subscription_name' }, // Column for Subscription Name
                            { data: 'demo_link' }, // Column for Demo Link
                            { data: 'lunch_link' }, // Column for Lunch Link
                            { data: 'renewal_link' }, // Column for Renewal Link

                            {
                                data: null,
                                render: function (data, type, row) {
                                    return `
                                        <button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary" data-id="${data.subscription_id}" data-name="${data.subscription_name}" data-demo="${data.demo_link}" data-lunch="${data.lunch_link}" data-renew="${data.renewal_link}">Edit</button>
                                        <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger" data-id="${data.subscription_id}">Delete</button>
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
                            axios.delete(`/delete_subscription/${subscriptionId}`)
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
    $('#subscription_table').on('click', '.edit-btn', function () {

        var subscriptionName = $(this).data('name');
        var demoLink = $(this).data('demo');
        var lunchLink = $(this).data('lunch');
        var renewLink = $(this).data('renew');
        var id = $(this).data('id');



        // Populate the form fields with subscription data
        $('#subscription_name').val(subscriptionName);
        $('#demo_link').val(demoLink);
        $('#lunch_link').val(lunchLink);
        $('#renew_link').val(renewLink);

        // You can store the ID in a hidden input field if needed
        $('#subscription_id').val(id);

        $('.text-danger').empty();

        // Show the edit subscription modal
        $('#edit_subscription_model').modal('show');
    });







    $('#updateSubscription').click(function() {
        var subscriptionId = $('#subscription_id').val();
        var subscriptionName = $('#subscription_name').val();
        var demoLink = $('#demo_link').val();
        var lunchLink = $('#lunch_link').val();
        var renewLink = $('#renew_link').val();

        var data = {
            subscription_id: subscriptionId,
            subscription_name: subscriptionName,
            demo_link: demoLink,
            lunch_link: lunchLink,
            renew_link: renewLink
        };

        $.ajax({
            type: 'POST',
            url: '/update_subscription', // Replace with the actual Laravel route for updating subscriptions
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
                  <input type="hidden" name="subscription_id" id="subscription_id">
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="subscription_name" name="subscription_name" placeholder="Topic Name ">
                      <label for="subscription_name">Subscription Name</label>
                      <span id="subscription_name_error" class="text-danger"></span>
                    </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="demo_link" name="demo_link" placeholder="Demo Link ">
                        <label for="demo_link">Demo Link</label>
                        <span id="demo_link_error" class="text-danger"></span>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="lunch_link" name="lunch_link" placeholder="Lunch Link ">
                        <label for="lunch_link">Lunch Link</label>
                        <span id="lunch_link_error" class="text-danger"></span>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="renew_link" name="renew_link" placeholder="Renew Link ">
                        <label for="renew_link">Renew Link</label>
                        <span id="renew_link_error" class="text-danger"></span>
                      </div>
                  </div>


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
