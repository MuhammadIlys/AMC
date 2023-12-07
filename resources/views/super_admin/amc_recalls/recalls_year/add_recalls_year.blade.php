@extends('super_admin.templates.main')
@section('main-container')



        <div class="container-fluid"><!--  container start -->

        <div class="card">
                  <div class="card-body">
                    <h5 class="mb-3">Add Recalls Year</h5>
                    <form method="POST" id="recalls_year_form">
                        @csrf
                      <div class="row">


                        <div class="col-md-9">
                          <div class="form-floating">
                            <input type="text" name="recalls_year_name" class="form-control" id="recalls_year_name" >
                            <label for="tb-pwd">Recalls Year</label>
                            <span class="text-danger" id="recalls_year_name_error"></span>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="d-md-flex align-items-center mt-3">

                                <div class="ms-auto mt-3 mt-md-0">
                                <button id="add_recalls_year" class="btn btn-info font-medium rounded-pill px-4">
                                    <div class="d-flex align-items-center">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Add Recalls Year
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


<!-- JavaScript/jQuery for AJAX submission -->

<script>


    $(document).ready(function() {

        $('#add_recalls_year').click(function(e) {

            e.preventDefault(); // Prevent the default click behavior (e.g., for links)
            // Disable the button
            $(this).prop('disabled', true);

            // Serialize form data
            var formData = $('#recalls_year_form').serialize();

            $.ajax({
                url: '/add_recalls_year',
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function(response) {

                    $('#recalls_year_form')[0].reset();
                    // Display SweetAlert on success
                    displaySuccessAlert('Success', 'Year Add Sucessfully!');

                    // Clear previous error messages
                    $('#recalls_year_name_error').text('');

                },
                error: function(xhr) {

                    $('#recalls_year_name_error').text(xhr.responseJSON?.message);

                    // Display Laravel validation errors if available
                    const errors = xhr.responseJSON?.errors;

                    if (errors) {
                        // Clear previous error messages
                        $('#recalls_year_name_error').text(errors.recalls_year_name?.[0] || '');

                    }
                },
                complete: function() {
                    // Enable the button after the request is complete (success or error)
                    $('#add_recalls_year').prop('disabled', false);
                }
            });
        });


    });





    </script>


        @endsection

