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
                                        <h5 class="mb-0">Qbank Demo Questions</h5>
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

            ajax: '/load_qbank_demo_question_to_table',
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
                                    data-question_id="${data.qbank_question_id}"
                                    >Edit</button>
                            <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger"
                                    data-question_id="${data.qbank_question_id}"
                                    >Delete</button>
                            <button class="qpreview-btn btn btn-sm mb-1 waves-effect waves-light btn-info"
                                    data-question_id="${data.qbank_question_id}"
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



                // load qbanks to the form
                loadQbanks();


                // load qbank system to the form
                loadQbankSystems();


                function loadQbanks(){

                    // Fetch recalls Years dynamically
                    $.ajax({

                    url: '/fetch_qbanks',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const qbankSelect = $('#qbank_id');
                        qbankSelect.html(data.qbankOptions);


                    },
                    error: function(error) {
                        console.error('Error fetching qbanks:', error);
                    }

                    });

                }




                function loadQbankSystems(){

                    // Fetch recalls system dynamically
                    $.ajax({

                    url: '/fetch_qbank_systems',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const qbankSystemSelect = $('#qbank_system_id');
                        qbankSystemSelect.html(data.qbankSystemOptions);


                    },
                    error: function(error) {
                        console.error('Error fetching qbank system:', error);
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

                url: `/edit_qbank_demo_question_loader/${questionId}`, // Updated URL
                method: 'GET',
                dataType: 'json',
                success: function(data) {


                    $('#question_track_id').val(data.question_track_id);
                    $('#qbank_id').val(data.qbank_id);
                    $('#qbank_system_id').val(data.qbank_system_id);

                    $('#qbank_question_id').val(data.qbank_question_id);

                    $('#question_text').summernote('code', data.question_text);
                    $('#option1').val( data.option1);
                    $('#option2').val( data.option2);
                    $('#option3').val( data.option3);
                    $('#option4').val( data.option4);
                    $('#option5').val( data.option5);
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
            url: '/update_qbank_demo_question',
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
                            url: '/delete_qbank_demo_question/' + question_id, // Adjust the URL to your delete route
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
        var previewUrl = '/qbank_demo_question_preview/' + questionId;

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
                      <input type="hidden" name="qbank_question_id" id="qbank_question_id">
                      <label for="tb-fname">Question Track ID</label>
                      <span class="text-danger" id="question_track_id_error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-floating mb-3">

                          <select class="form-select mr-sm-2" id="qbank_id" name="qbank_id">
                              <option  selected disabled>Choose QBanks</option>


                          </select>
                          <span class="text-danger" id="qbank_id_error"></span>

                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-floating mb-3">

                          <select class="form-select mr-sm-2" id="qbank_system_id" name="qbank_system_id" >
                              <option selected disabled>Choose QBank System</option>

                          </select>
                          <span class="text-danger" id="qbank_system_id_error"></span>
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
