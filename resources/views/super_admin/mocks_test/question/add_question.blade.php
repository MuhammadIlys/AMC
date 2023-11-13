@extends('super_admin.templates.main')
@section('main-container')


<style>

    .summernotemargin{
        margin-bottom:10px !important;
    }
</style>




        <div class="container-fluid"><!--  container start -->

        <div class="card">
                  <div class="card-body">
                    <h5 class="mb-3">Add Question</h5>
                    <form id="question-form" >
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="question_track_id" name="question_track_id" placeholder="Enter Name here">
                            <label for="tb-fname">Question Track ID</label>
                            <span class="text-danger" id="question_track_id_error"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">

                                <select class="form-select mr-sm-2" id="subjects" name="subjects">
                                    <option  selected disabled>Choose Subject</option>


                                </select>
                                <span class="text-danger" id="subjects_error"></span>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">

                                <select class="form-select mr-sm-2" id="specialities" name="specialities">
                                    <option disabled selected>Choose  Speciality</option>

                                </select>
                                <span class="text-danger" id="specialities_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">

                                <select class="form-select mr-sm-2" id="topic" name="topic" >
                                    <option selected disabled>Choose  Topic</option>

                                </select>
                                <span class="text-danger" id="topic_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote" name="question_text" id="question_text" rows="4" cols="50">
                                Enter Question
                            </textarea>
                            <span class="text-danger" id="question_text_error"></span>

                          </div>
                        </div>

                        <div class="col-md-6 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote2" name="option1" id="option1" rows="4" cols="50">
                                Option 1
                            </textarea>
                            <span class="text-danger" id="option1_error"></span>

                          </div>
                        </div>

                        <div class="col-md-6 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote2" name="option2" id="option2"  rows="4" cols="50">
                                Option 2
                            </textarea>
                            <span class="text-danger" id="option2_error"></span>

                          </div>
                        </div>

                        <div class="col-md-6 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote2" name="option3" id="option3"  rows="4" cols="50">
                                Option 3
                            </textarea>
                            <span class="text-danger" id="option2_error"></span>

                          </div>
                        </div>

                        <div class="col-md-6 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote2" name="option4" id="option4"  rows="4" cols="50">
                                Option 4
                            </textarea>
                            <span class="text-danger" id="option4_error"></span>

                          </div>
                        </div>

                        <div class="col-md-12 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote2" name="option5" id="option5"  rows="4" cols="50">
                                Option 5
                            </textarea>
                            <span class="text-danger" id="option5_error"></span>

                          </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">

                                <select class="form-select mr-sm-2" name="correct_option" id="correct_option" >
                                    <option selected disabled>Choose  correct Option</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                    <option value="5">Option 5</option>
                                </select>

                                <span class="text-danger" id="correct_option_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">

                                <select class="form-select mr-sm-2" id="question_type" name="question_type">
                                    <option selected disabled >Choose  Question Type</option>
                                    <option value="1">Hard</option>
                                    <option value="2">Pair</option>
                                    <option value="3">Easy</option>
                                </select>
                                <span class="text-danger" id="question_type_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-floating">

                            <textarea class="summernote" name="question_explanation" id="question_explanation" rows="4" cols="50">
                                Enter question_explanation
                            </textarea>
                            <span class="text-danger" id="question_explanation_error"></span>

                          </div>
                        </div>


                        <div class="col-12">
                          <div class="d-md-flex align-items-center mt-3">

                                <div class="ms-auto mt-3 mt-md-0">
                                <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                                    <div class="d-flex align-items-center">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Add Question
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

            $(document).ready(function () {

                // load subject to the form
                loadSubject();

                // load speciality related to subject

                changeSubjectHandler();


                //load topic related to speciality

                changeSpecialityHandler();

                function loadSubject(){

                    // Fetch subjects dynamically
                    $.ajax({

                    url: '/fetch_subjects', // Replace with your actual endpoint for fetching subjects
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const subjectSelect = $('#subjects');
                        subjectSelect.html(data.subjectOptions);


                    },
                    error: function(error) {
                        console.error('Error fetching subjects:', error);
                    }

                    });

                }

                function changeSubjectHandler(){

                    $('#subjects').on('change', function() {
                        const subjectId = $(this).val();

                        // Fetch related specialities for the selected subject
                        $.ajax({
                            url: `/load_specialities/${subjectId}`, // Adjusted URL
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                const specialitySelect = $('#specialities');
                                specialitySelect.html(response.specialityOptions);
                                specialitySelect.prop('disabled', false);
                            },
                            error: function(error) {
                                console.error('Error fetching specialities:', error);
                            }
                        });
                    });
                }


                function changeSpecialityHandler(){

                    $('#specialities').on('change', function() {
                        const subjectId = $('#subjects').val();
                        const specialityId = $(this).val();

                        // Fetch related topics for the selected subject and speciality
                        $.ajax({
                            url: `/load_topics/${subjectId}/${specialityId}`, // Updated URL
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                const topicSelect = $('#topic');
                                topicSelect.html(response.topicOptions);

                            },
                            error: function(error) {
                                console.error('Error fetching topics:', error);
                            }
                        });
                    });

                }


                $('#question-form').on('submit', function (e) {
                    e.preventDefault();

                    // Serialize the form data
                    var formData = $(this).serialize();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('questions.create') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        success: function (data) {
                            // Handle the success response, e.g., show a success message
                            $('#question-form')[0].reset();
                            displaySuccessAlert("Success",data.message);
                        },
                        error: function (data) {
                            // Handle validation errors
                            if (data.status === 422) {
                                // Clear any previous validation error messages
                                $('.text-danger').text('');

                                // Loop through the errors and display them next to the respective form fields
                                $.each(data.responseJSON.errors, function (fieldName, errorMessage) {
                                    $('#' + fieldName + '_error').text(errorMessage[0]);
                                });
                            }
                        }
                    });
                });








            });// ready function end





        </script>


@endsection
