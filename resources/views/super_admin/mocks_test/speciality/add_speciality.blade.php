
@extends('super_admin.templates.main')
@section('main-container')
        <div class="container-fluid"><!--  container start -->

        <div class="card">
                  <div class="card-body">
                    <h5 class="mb-3">Add Speciality</h5>
                    <form  id="addSpecialtyForm" >
                      <div class="row">

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select mr-sm-2" name="subject_id" id="subject_id">
                                    <option value="">Choose Subject</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                    @endforeach
                                </select>
                                <label for="subject_id">Select Subject</label>
                                <span id="subject_error" class="text-danger"></span>
                            </div>

                        </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="tb-pwd" id="specialty_name" name="specialty_name">
                            <label for="tb-pwd">Speciality Name</label>
                            <span id="speciality_error" class="text-danger"></span>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="d-md-flex align-items-center mt-3">

                                <div class="ms-auto mt-3 mt-md-0">
                                <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                                    <div class="d-flex align-items-center">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Add Speciality
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
                $('#addSpecialtyForm').on('submit', function(event) {
                    event.preventDefault();

                    var formData = $(this).serialize();

                    $.ajax({

                        url: "{{ route('addSpeciality') }}",

                        type: "POST",
                        headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                        data: formData,
                        success: function(response) {
                            $('#subject_error').text('');
                            $('#speciality_error').text('');

                            $('#addSpecialtyForm')[0].reset();

                            if(response.status=='1'){
                                displaySuccessAlert("success", response.message);
                            }else{

                                displayErrorAlert("Error", response.message);
                            }


                        },
                        error: function(xhr) {
                            // Clear previous error messages
                            $('#subject_error').text('');
                            $('#speciality_error').text('');

                            displayErrorAlert("Error", xhr.responseJSON?.message)

                            // Display Laravel validation errors if available
                        const errors = xhr.responseJSON?.errors;

                        if (errors) {
                            // Clear previous error messages
                            $('#subject_error').text(errors.subject_id?.[0] || '');
                            $('#speciality_error').text(errors.specialty_name?.[0] || '');
                        }



                        }
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


            });


        </script>





@endsection
