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
                                        <h5 class="mb-0">Question List</h5>
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
            ajax: '{{ route('get_question_data') }}',
            columns: [
                { data: 'question_track_id' },
                {
                    data: 'question_text',
                    render: function (data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Ensure that text wraps and add a tooltip with the full content
                            if (data.length > 10) {
                                return '<div class="dt-wrap-text" title="' + data + '">' + data + '</div>';
                            }
                        }
                        return data;
                    }
                },

                {
                    data: null,
                    render: function (data) {
                        // Create and return the action buttons as HTML with only the required data attributes
                        return `
                            <button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary"
                                    data-question_id="${data.question_id}"
                                    data-speciality_id="${data.speciality_id}"
                                    data-topic_id="${data.topic_id}"
                                    data-subject_id="${data.subject_id}">Edit</button>
                            <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger"
                                    data-question_id="${data.question_id}"
                                    data-speciality_id="${data.speciality_id}"
                                    data-topic_id="${data.topic_id}"
                                    data-subject_id="${data.subject_id}">Delete</button>
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


            function loadspecialitiesbeforechanges(id){

                const subjectId = id;
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
            }


            function loadtopicbeforechange(subjectId, specialityId ){

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
            }



             // change handle when the subject is changed
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




        // Edit button click function
        $('#question_table').on('click', '.edit-btn', function () {
            // Retrieve data attributes from the clicked button
            const data = $(this).data();

            // Access the specific data attributes
            const questionId = data.question_id;
            const specialityId = data.speciality_id;
            const topicId = data.topic_id;
            const subjectId = data.subject_id;

            $('#subjects').val(subjectId);

            loadspecialitiesbeforechanges(subjectId);
            loadtopicbeforechange(subjectId, specialityId);



            $("#update_question").modal("show");
            setTimeout(function(){

                $('#specialities').val(specialityId);
            $('#topic').val(topicId);

            }, 4000);

            // load question data to model for editing
            $.ajax({
                        url: `/edit_question_loader/${questionId}`, // Updated URL
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {

                            $('#question_track_id').val(data.question_track_id);
                            $('#question_id').val(data.question_id);

                            $('#question_text').summernote('code', data.question_text);
                            $('#option1').summernote('code', data.option1);
                            $('#option2').summernote('code', data.option2);
                            $('#option3').summernote('code', data.option3);
                            $('#option4').summernote('code', data.option4);
                            $('#option5').summernote('code', data.option5);
                            $('#question_explanation').summernote('code', data.question_explanation);

                            $('#question_type').val(data.question_type);
                            $('#correct_option').val(data.correct_option);

                        },
                        error: function(error) {
                            console.error('Error fetching topics:', error);
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
                        url: '/delete/question/' + question_id, // Adjust the URL to your delete route
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
      url: '/update-question', // Replace with the actual URL for updating the question
      data: formData,
      success: function(response) {


        $('#question-form')[0].reset();
        displaySuccessAlert('Success','Question update Successfully!');
        // Remove the row from the DataTable
        table.destroy();
        table = initializeDataTable();
        $('#update_question').modal('hide');
      },
      error: function(error) {

        displayErrorAlert('Error',error.responseText);

      }

    });

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
                      <input type="hidden" name="question_id" id="question_id">
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
