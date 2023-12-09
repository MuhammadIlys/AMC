@extends('super_admin.templates.main')
@section('main-container')



        <div class="container-fluid"><!--  container start -->

        <div class="card">
                  <div class="card-body">
                    <h5 class="mb-3">Add Qbanks</h5>
                    <form method="POST" id="qbank_form">
                        @csrf
                      <div class="row">


                        <div class="col-md-9">
                          <div class="form-floating">
                            <input type="text" name="qbank_name" class="form-control" id="qbank_name" >
                            <label for="tb-pwd">Qbank Name</label>
                            <span class="text-danger" id="qbank_name_error"></span>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="d-md-flex align-items-center mt-3">

                                <div class="ms-auto mt-3 mt-md-0">
                                <button id="add_qbank" class="btn btn-info font-medium rounded-pill px-4">
                                    <div class="d-flex align-items-center">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Add Qbank
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

        $('#add_qbank').click(function(e) {

            e.preventDefault(); // Prevent the default click behavior (e.g., for links)
            // Disable the button
            $(this).prop('disabled', true);

            // Serialize form data
            var formData = $('#qbank_form').serialize();

            $.ajax({
                url: '/add_qbank',
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function(response) {

                    $('#qbank_form')[0].reset();
                    // Display SweetAlert on success
                    displaySuccessAlert('Success', 'Qbank Add Sucessfully!');

                    // Clear previous error messages
                    $('#qbank_name_error').text('');

                },
                error: function(xhr) {

                    $('#qbank_name_error').text(xhr.responseJSON?.message);

                    // Display Laravel validation errors if available
                    const errors = xhr.responseJSON?.errors;

                    if (errors) {
                        // Clear previous error messages
                        $('#qbank_name_error').text(errors.qbank_name?.[0] || '');

                    }
                },
                complete: function() {
                    // Enable the button after the request is complete (success or error)
                    $('#add_qbank').prop('disabled', false);
                }
            });
        });


    });





    </script>


        @endsection

