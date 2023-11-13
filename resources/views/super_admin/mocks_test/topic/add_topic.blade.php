@extends('super_admin.templates.main')
@section('main-container')

        <div class="container-fluid"><!--  container start -->

        <div class="card">
                  <div class="card-body">
                    <h5 class="mb-3">Add Topic</h5>
                    <form id="add_topic_form">
                      <div class="row">

                        <div class="col-md-6">

                            <div class="form-floating mb-3">
                                <select class="form-select mr-sm-2" id="subject_id" name="subject_id">
                                    <option value="" disabled selected>Choose Subject</option>
                                    <!-- Options will be loaded dynamically using jQuery -->
                                </select>
                                <label for="subject_id">Subject</label>
                                <span id="subject_name_error" class="text-danger"></span>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-floating mb-3">
                                <select class="form-select mr-sm-2" id="speciality_id" name="speciality_id" disabled>
                                    <option value="" disabled selected>Choose Speciality</option>
                                    <!-- Options will be loaded dynamically -->
                                </select>
                                <label for="speciality_id">Speciality</label>
                                <span id="speciality_name_error" class="text-danger"></span>
                            </div>

                        </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="topic_name" name="topic_name" placeholder="Topic Name ">
                            <label for="topic_name">Topic Name</label>
                            <span id="topic_name_error" class="text-danger"></span>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="d-md-flex align-items-center mt-3">

                                <div class="ms-auto mt-3 mt-md-0">
                                <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                                    <div class="d-flex align-items-center">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Add Topic
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


                // Fetch subjects dynamically
                $.ajax({
                    url: '/fetch_subjects', // Replace with your actual endpoint for fetching subjects
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const subjectSelect = $('#subject_id');
                        subjectSelect.html(data.subjectOptions);
                    },
                    error: function(error) {
                        console.error('Error fetching subjects:', error);
                    }
                });

                  // Event listener for subject dropdown
                    $('#subject_id').on('change', function() {
                        const subjectId = $(this).val();

                        // Fetch related specialities for the selected subject
                        $.ajax({
                            url: `/load_specialities/${subjectId}`, // Adjusted URL
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                const specialitySelect = $('#speciality_id');
                                specialitySelect.html(response.specialityOptions);
                                specialitySelect.prop('disabled', false);
                            },
                            error: function(error) {
                                console.error('Error fetching specialities:', error);
                            }
                        });
                    });




               $('form').on('submit', function (event) {
                    event.preventDefault(); // Prevent the form from submitting normally

                    // Get the selected subject, speciality, and topic name
                    const subjectId = $('#subject_id').val();
                    const specialityId = $('#speciality_id').val();
                    const topicName = $('#topic_name').val();

                    // Send the data to the server to add the topic
                    $.ajax({
                        url: '/add_topic', // Replace with the actual Laravel route
                        method: 'POST',
                        headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                        dataType: 'json',
                        data: {
                            subject_id: subjectId,
                            speciality_id: specialityId,
                            topic_name: topicName,
                        },
                        success: function (response) {

                            // Clear previous error messages
                            $('#subject_name_error').text('');
                            $('#speciality_name_error').text('');
                            $('#topic_name_error').text('');


                            if(response.status=='1'){
                                displaySuccessAlert("success", response.message);
                            }else{

                                displayErrorAlert("Error", response.message);
                            }

                            $('#add_topic_form')[0].reset();

                        },
                        error: function (xhr) {
                             // Clear previous error messages
                             $('#subject_name_error').text('');
                            $('#speciality_name_error').text('');
                            $('#topic_name_error').text('');

                            displayErrorAlert("Error", xhr.responseJSON?.message)

                            // Display Laravel validation errors if available
                        const errors = xhr.responseJSON?.errors;

                        if (errors) {
                            // Clear previous error messages
                            $('#subject_name_error').text(errors.subject_id?.[0] || '');
                            $('#speciality_name_error').text(errors.speciality_id?.[0] || '');
                            $('#topic_name_error').text(errors.topic_name?.[0] || '');
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






            });// ready function end


        </script>









        @endsection

