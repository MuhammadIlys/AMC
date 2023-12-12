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
                    <h5 class="mb-3">Add Recall Question</h5>
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

                                <select class="form-select mr-sm-2" id="recalls_year_id" name="recalls_year_id">
                                    <option  selected disabled>Choose Recalls Year</option>


                                </select>
                                <span class="text-danger" id="recalls_year_id_error"></span>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">

                                <select class="form-select mr-sm-2" id="recalls_month_id" name="recalls_month_id">
                                    <option disabled selected>Choose  Recalls Month</option>

                                </select>
                                <span class="text-danger" id="recalls_month_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">

                                <select class="form-select mr-sm-2" id="recalls_system_id" name="recalls_system_id" >
                                    <option selected disabled>Choose  Recalls System</option>

                                </select>
                                <span class="text-danger" id="recalls_system_id_error"></span>
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

                        <div class="col-md-6 ">
                            <div class="form-floating mb-3">

                              <input type="text" class="form-control" name="option1" id="option1" >
                              <label for="option1"> Option 1</label>

                              <span class="text-danger" id="option1_error"></span>

                            </div>
                          </div>

                          <div class="col-md-6 ">
                            <div class="form-floating mb-3">

                              <input type="text" class="form-control" name="option2" id="option2"  >

                              <label for="option2"> Option 2</label>
                              <span class="text-danger" id="option2_error"></span>

                            </div>
                          </div>

                          <div class="col-md-6 ">
                            <div class="form-floating mb-3">

                              <input type="text" class="form-control" name="option3" id="option3"  >

                              <label for="option3"> Option 3</label>
                              <span class="text-danger" id="option2_error"></span>

                            </div>
                          </div>

                          <div class="col-md-6 ">
                            <div class="form-floating mb-3">

                              <input type="text" class="form-control" name="option4" id="option4" >
                              <label for="option4">option 4</label>

                              <span class="text-danger" id="option4_error"></span>

                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-floating mb-3">

                              <input type="text" class="form-control" name="option5" id="option5"  >
                              <label for="option5">option 5</label>
                              <span class="text-danger" id="option5_error"> </span>

                            </div>
                          </div>

                        <div class="col-md-12">
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
                                <button id="submitbtn"  type="submit" class="btn btn-info font-medium rounded-pill px-4">
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

                // load recalls year to the form
                loadRecallsYears();

                // load recalls month to the form
                loadRecallsMonths();


                // load recalls system to the form
                loadRecallsSystems();


                function loadRecallsYears(){

                    // Fetch recalls Years dynamically
                    $.ajax({

                    url: '/fetch_recalls_years',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const recallsYearSelect = $('#recalls_year_id');
                        recallsYearSelect.html(data.recallsYearOptions);


                    },
                    error: function(error) {
                        console.error('Error fetching recalls year:', error);
                    }

                    });

                }


                function loadRecallsMonths(){

                    // Fetch recalls Years dynamically
                    $.ajax({

                    url: '/fetch_recalls_months',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const recallsMonthSelect = $('#recalls_month_id');
                        recallsMonthSelect.html(data.recallsMonthOptions);


                    },
                    error: function(error) {
                        console.error('Error fetching recalls month:', error);
                    }

                    });

                }


                function loadRecallsSystems(){

                    // Fetch recalls system dynamically
                    $.ajax({

                    url: '/fetch_recalls_systems',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const recallsSystemSelect = $('#recalls_system_id');
                        recallsSystemSelect.html(data.recallsSystemOptions);


                    },
                    error: function(error) {
                        console.error('Error fetching recalls system:', error);
                    }


                    });

                }



                $('#question-form').on('submit', function (e) {
                    e.preventDefault();

                    // Disable the button
                    $('#submitbtn').prop('disabled', true);

                    // Serialize the form data
                    var formData = $(this).serialize();

                    $.ajax({
                        type: 'POST',
                        url: "/create_recalls_question",
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
                        },
                        complete: function() {
                        // Enable the button after the request is complete (success or error)
                          $('#submitbtn').prop('disabled', false);
                        }

                    });
                });








            });// ready function end





        </script>


@endsection
