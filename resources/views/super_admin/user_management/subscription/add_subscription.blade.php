@extends('super_admin.templates.main')
@section('main-container')

        <div class="container-fluid"><!--  container start -->

        <div class="card">
                  <div class="card-body">
                    <h5 class="mb-3">Add Subscription</h5>
                    <form id="add_subscription_form">
                      <div class="row">

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
                  </div>
                </div>





        </div><!--  container end -->



        <script>


        $(document).ready(function() {



            $('#add_subscription_form').on('submit', function (event) {
                event.preventDefault(); // Prevent the form from submitting normally

                // Get the values from the form fields
                const subscriptionName = $('#subscription_name').val();
                const demoLink = $('#demo_link').val();
                const lunchLink = $('#lunch_link').val();
                const renewLink = $('#renew_link').val();

                // Send the data to the server to add the subscription
                $.ajax({
                    url: '/add_subscription', // Replace with the actual Laravel route
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    data: {
                        subscription_name: subscriptionName,
                        demo_link: demoLink,
                        lunch_link: lunchLink,
                        renew_link: renewLink,
                    },
                    success: function (response) {
                        // Clear previous error messages
                        $('#subscription_name_error').text('');
                        $('#demo_link_error').text('');
                        $('#lunch_link_error').text('');
                        $('#renew_link_error').text('');

                        if (response.status == '1') {
                            displaySuccessAlert("Success", response.message);
                        } else {
                            displayErrorAlert("Error", response.message);
                        }

                        $('#add_subscription_form')[0].reset();
                    },
                    error: function (xhr) {
                        // Clear previous error messages
                        $('#subscription_name_error').text('');
                        $('#demo_link_error').text('');
                        $('#lunch_link_error').text('');
                        $('#renew_link_error').text('');

                        displayErrorAlert("Error", xhr.responseJSON?.message);

                        // Display Laravel validation errors if available
                        const errors = xhr.responseJSON?.errors;

                        if (errors) {
                            $('#subscription_name_error').text(errors.subscription_name?.[0] || '');
                            $('#demo_link_error').text(errors.demo_link?.[0] || '');
                            $('#lunch_link_error').text(errors.lunch_link?.[0] || '');
                            $('#renew_link_error').text(errors.renew_link?.[0] || '');
                        }
                    }
                });
            });










 });// ready function end


        </script>









        @endsection

