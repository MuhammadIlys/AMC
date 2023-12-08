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
                                        <h5 class="mb-0">Recalls Demo Questions</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">

                                        <table id="question_table" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                            <thead>
                                                <!-- start row -->
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;">Question Track ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Question</th>

                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 39.7969px;">Action</th>
                                                </tr>
                                                <!-- end row -->
                                            </thead>
                                            <tbody>
                                             <!-- this will load dynamically-->


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

<style>

.dt-wrap-text {
    white-space: pre-wrap;
    word-wrap: break-word;
    max-width: none;
}


</style>


        <script>

$(document).ready(function () {


    function initializeDataTable() {
        return $('#question_table').DataTable({

            ajax: '/load_recalls_demo_question_to_table',
            columns: [
                {
                     data: 'question_track_id' ,
                     name: 'question_track_id'
                },

                {
                    data: 'question_text',
                    name: 'question_text',

                },

                {
                    data: null,
                    render: function (data) {
                        // Create and return the action buttons as HTML with only the required data attributes
                        return `
                            <button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary"
                                    data-question_id="${data.recalls_question_id}"
                                    >Edit</button>
                            <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger"
                                    data-question_id="${data.recalls_question_id}"
                                    >Delete</button>
                            <button class="qpreview-btn btn btn-sm mb-1 waves-effect waves-light btn-info"
                                    data-question_id="${data.recalls_question_id}"
                                    >Q.Preview</button>
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




        // Edit button click function
        $('#question_table').on('click', '.edit-btn', function () {
            // Retrieve data attributes from the clicked button
            const data = $(this).data();

            // Access the specific data attributes
            const questionId = data.question_id;



            // load question data to model for editing
            $.ajax({

                url: `/edit_recall_question_demo_loader/${questionId}`, // Updated URL
                method: 'GET',
                dataType: 'json',
                success: function(data) {


                    $('#question_track_id').val(data.question_track_id);
                    $('#recalls_year_id').val(data.recalls_year_id);
                    $('#recalls_month_id').val(data.recalls_month_id);
                    $('#recalls_system_id').val(data.recalls_system_id);

                    $('#recalls_question_id').val(data.recalls_question_id);

                    $('#question_text').summernote('code', data.question_text);
                    $('#option1').summernote('code', data.option1);
                    $('#option2').summernote('code', data.option2);
                    $('#option3').summernote('code', data.option3);
                    $('#option4').summernote('code', data.option4);
                    $('#option5').summernote('code', data.option5);
                    $('#question_explanation').summernote('code', data.question_explanation);
                    $('#correct_option').val(data.correct_option);

                    $('#update_question').modal('show');

                },
                error: function(error) {
                    console.error('Error fetching topics:', error);
                }
            });








        });



    ///    update the question


    // Listen for the form submission
    $('#question-form').submit(function(e) {


        e.preventDefault(); // Prevent the default form submission

        // Serialize the form data into a format that can be sent via AJAX
        var formData = $(this).serialize();

        // Make an AJAX POST request
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/update_recalls_demo_question',
            data: formData,
            success: function (response) {
                $('#question-form')[0].reset();
                displaySuccessAlert('Success', response.message);
                // Remove the row from the DataTable
                table.destroy();
                table = initializeDataTable();
                $('#update_question').modal('hide');
            },
            error: function (error) {
                // Handle validation errors
                if (error.status === 422 && error.responseJSON.errors) {
                    // Clear any previous validation error messages
                    $('.text-danger').text('');

                    // Loop through the errors and display them next to the respective form fields
                    $.each(error.responseJSON.errors, function (fieldName, errorMessage) {
                        $('#' + fieldName + '_error').text(errorMessage[0]);
                    });
                } else {
                    // Handle other errors
                    displayErrorAlert('Error', error.responseText);
                }
            }
        });

    });



    $('#question_table').on('click', '.delete-btn', function () {

        // Retrieve data attributes from the clicked button
        const data = $(this).data();

        const question_id = data.question_id;

        // Show a confirmation dialog using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to delete this question.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed the deletion, send an AJAX request to delete the record
                        $.ajax({
                            url: '/delete_recalls_demo_question/' + question_id, // Adjust the URL to your delete route
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                // Handle the success response, e.g., remove the row from the DataTable
                                if (response.success) {
                                    // Remove the row from the DataTable
                                    displaySuccessAlert('Success','Question Delete Successfully!');
                                    table.destroy();
                                    table = initializeDataTable();
                                }
                            },
                            error: function (error) {
                                // Handle any errors here
                                displayErrorAlert('Error',error);

                            }
                        });
                    }
                });
    });



    // question preview

    $('#question_table').on('click', '.qpreview-btn', function () {
        // Retrieve data attributes from the clicked button
        const data = $(this).data();
        var questionId = data.question_id;

        // Assuming your URL is '/question_preview' and you want to append the questionId parameter
        var previewUrl = '/question_preview/' + questionId;

        // Open the preview URL in a new tab
        window.open(previewUrl, '_blank');
    });










});// ready function end




        </script>





<div class="modal fade" id="update_question" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="questionModalLabel">Update Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="question-form" >
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="question_track_id" name="question_track_id" placeholder="Enter Name here">
                      <input type="hidden" name="recalls_question_id" id="recalls_question_id">
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
                              <option selected disabled>Choose Recalls System</option>

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



                  <div class="col-md-12">
                    <div class="form-floating">

                      <textarea class="summernote" name="question_explanation" id="question_explanation" rows="4" cols="50">
                          Enter question_explanation
                      </textarea>
                      <span class="text-danger" id="question_explanation_error"></span>

                    </div>
                  </div>



                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="question-form">Update Question</button>
        </div>
      </div>
    </div>
  </div>


@endsection
