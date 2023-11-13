@extends('super_admin.templates.main')
@section('main-container')



        <div class="container-fluid"><!--  container start -->

        <div class="card">
                  <div class="card-body">
                    <h5 class="mb-3">Add Subject</h5>
                    <form method="POST" id="subjectForm">
                        @csrf
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-floating mb-3">
                            <input type="text" name="subject_id"  class="form-control" id="tb-fname" placeholder="Enter Name here">
                            <label for="tb-fname">Subject ID</label>
                            <span class="text-danger" id="subject_id_error"></span>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="subject_name" class="form-control" id="tb-pwd" placeholder="Topic Name ">
                            <label for="tb-pwd">Subject Name</label>
                            <span class="text-danger" id="subject_name_error"></span>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="d-md-flex align-items-center mt-3">

                                <div class="ms-auto mt-3 mt-md-0">
                                <button id="add_subject" class="btn btn-info font-medium rounded-pill px-4">
                                    <div class="d-flex align-items-center">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Add Subject
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
    $('#add_subject').click(function(e) {
        e.preventDefault(); // Prevent the default click behavior (e.g., for links)

        // Serialize form data
        var formData = $('#subjectForm').serialize();

        $.ajax({
            url: '{{ route("super_admin.add_subject") }}',
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function(response) {

                $('#subjectForm')[0].reset();
                // Display SweetAlert on success
                displaySuccessAlert('Success', 'Subject Add Sucessfully!');

                // Clear previous error messages
                $('#subject_name_error').text('');
                $('#subject_id_error').text('');
            },
            error: function(xhr) {

                displayErrorAlert("Error", xhr.responseJSON?.message)
                // Display Laravel validation errors if available
                const errors = xhr.responseJSON?.errors;

                if (errors) {
                    // Clear previous error messages
                    $('#subject_name_error').text(errors.subject_name?.[0] || '');
                    $('#subject_id_error').text(errors.subject_id?.[0] || '');
                }
            }
        });
    });
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



</script>


        @endsection

