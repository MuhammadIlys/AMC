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
                                        <h5 class="mb-0">Topic List</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">

                                        <table id="topic_table" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                            <thead>
                                                <!-- start row -->
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;">Topic ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Topic Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Subject Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Speciality Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 39.7969px;">Action</th>
                                                </tr>
                                                <!-- end row -->
                                            </thead>
                                            <tbody>
                                             <!-- boy will load dynamically -->

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


        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

     <script>

            $(document).ready(function () {

                    // Function to initialize DataTable
              function initializeDataTable() {
                return $('#topic_table').DataTable({
                    ajax: '/get_topic_data',
                    columns: [
                        { data: 'topic_id' },
                        { data: 'topic_name' },
                        {
                            data: 'subjects',
                            render: function (data) {
                                const uniqueSubjects = [...new Set(data.map(subject => subject.subject_name))];
                                return uniqueSubjects.join(', ');
                            }
                        },
                        {
                            data: 'specialities',
                            render: function (data) {
                                const uniqueSpecialities = [...new Set(data.map(speciality => speciality.speciality_name))];
                                return uniqueSpecialities.join(', ');
                            }
                        },
                        {
                            data: null,
                            render: function (data, type, row) {
                                return `
                                    <button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary" data-id="${data.topic_id}" data-name="${data.topic_name}" data-subjects="${data.subjects.map(subject => subject.subject_id).join(',')}"  data-specialities="${data.specialities.map(speciality => speciality.speciality_id).join(',')}">Edit</button>
                                    <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger" data-id="${row.topic_id}">Delete</button>
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

//########################################################################################

            // Handle Delete button click
            $('#topic_table').on('click', '.delete-btn', function () {
                    var topicId = $(this).data('id');

                    // Display a confirmation alert
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this record!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User confirmed deletion, send AJAX request to delete the record
                            axios.delete(`/delete_topic/${topicId}`)
                                .then(response => {
                                    // Successful deletion, refresh the table
                                    displaySuccessAlert('Success', response.data.message);
                                    // Reload the DataTable
                                    table.destroy();
                                    table = initializeDataTable();
                                })
                                .catch(error => {
                                    displayErrorAlert('Error', 'Error deleting record');
                                });
                        }
                    });
                });

//########################################################################################

            // Handle Edit button click in table
            $('#topic_table').on('click', '.edit-btn', function () {


                var topicId = $(this).data('id');
                var topicName = $(this).data('name');
                var selectedSubjectIds = $(this).data('subjects');
                var selectedSpecialtiesIds = $(this).data('specialities');



                // Check if the data attributes are strings and then split
                if (typeof selectedSubjectIds === 'string') {
                    selectedSubjectIds = selectedSubjectIds.split(',');
                }

                if (typeof selectedSpecialtiesIds === 'string') {
                    selectedSpecialtiesIds = selectedSpecialtiesIds.split(',');
                }





            $('#topicId').val(topicId);
            $('#topicName').val(topicName);


            loadSubjectToModel(selectedSubjectIds);
            loadSpecialities(selectedSubjectIds,selectedSpecialtiesIds);

            changeHandler(selectedSpecialtiesIds);

            $('#topicModal').modal('show');



            // editSpecialityModal(specialityId, specialityName, selectedSubjectIds);
            // loadDataIntoModel(specialityId);


            });


            // load subject to the model from database

            function loadSubjectToModel(selectedSubjectIds){

                 // Fetch subjects dynamically
                 $.ajax({
                    url: '/fetch_subjects', // Replace with your actual endpoint for fetching subjects
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const subjectSelect = $('#subjects');
                        subjectSelect.html(data.subjectOptions);
                         // Set the selected options based on the selectedSubjectIds array
                        subjectSelect.val(selectedSubjectIds);
                        // Ensure the selected options are visible
                        subjectSelect.trigger('change');

                    },
                    error: function(error) {
                        console.error('Error fetching subjects:', error);
                    }
                });
            }


               // Function to load specialties based on the selected subjects
            function loadSpecialities(selectedSubjectIds,selectedspecialtiesIds) {
                // Check if there are any selected subjects
                if (selectedSubjectIds.length === 0) {
                    $('#specialities').html('<option value="" disabled selected>No Subjects found</option>');
                    return;
                }

                // Send the array of selected subject IDs to the server
                $.ajax({
                    url: '/fetch_specialities',
                    method: 'POST',
                    headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                    dataType: 'json',
                    data: { selectedSubjects: selectedSubjectIds },
                    success: function (data) {
                        const specialitySelect = $('#specialities');
                        specialitySelect.html(data.specialityOptions);

                        specialitySelect.val(selectedspecialtiesIds);
                    },
                    error: function (error) {
                        console.error('Error fetching specialties:', error);
                    }
                });
            }

            function changeHandler(selectedspecialtiesIds){
            // Event handler for when the subject select changes
            $('#subjects').change(function () {
                var selectedSubjectIds = $(this).val();
              //  var selectedspecialtiesIds = $(this).data('specialities').split(',');
                loadSpecialities(selectedSubjectIds,selectedspecialtiesIds);
            });

        }



                    // JavaScript for handling the form submission
            $('#updateTopic').click(function() {

                    var topicId = parseInt($('#topicId').val());
                    var topicName = $('#topicName').val();
                    var selectedSubjects = $('#subjects').val() || [];
                    var selectedSpecialties = $('#specialities').val() || [];

                    // Create an array of subject and specialty objects
                    var selectedData = [];

                    selectedSubjects.forEach(function(subjectId) {
                        selectedSpecialties.forEach(function(specialityId) {
                            selectedData.push({
                                subject_id: parseInt(subjectId),
                                speciality_id: parseInt(specialityId),
                            });
                        });
                    });

                    var data = {
                        topicId: topicId,
                        topicName: topicName,
                        selectedData: selectedData,
                    };

                    $.ajax({
                        type: 'POST',
                        url: '/update_topic/' + topicId,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: data,
                        success: function(response) {
                            // Handle a successful response
                            if (response.message) {
                                displaySuccessAlert('success', "Association Update sucessfully!");
                                table.destroy();
                                table = initializeDataTable();
                                $('#topicModal').modal('hide');
                            } else {
                                displayErrorAlert('Unexpected response format:', response);
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle the error response here
                            console.error('Error updating topic:', error);
                            alert('An error occurred while updating the topic. Please try again.');
                        }
                    });
                });









//########################################################################################

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
                        iconColor: '#28a745', // Change the success icon color
                        timerProgressBar: true // Show a progress bar during the timer
                    });
                }








        });// ready function end

    </script>




<!-- The Modal -->
<div class="modal fade" id="topicModal" tabindex="-1" aria-labelledby="topicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="topicModalLabel">Edit Topic</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="topicForm">
            <!-- Select dropdown for subjects -->
            <div class="mb-3">
              <label for="subjects" class="form-label">Subjects</label>
              <select multiple class="form-select" id="subjects" name="subjects[]">
                <!-- Options will be loaded dynamically using AJAX -->
              </select>
            </div>

            <!-- Select dropdown for specialities -->
            <div class="mb-3">
              <label for="specialities" class="form-label">Specialities</label>
              <select multiple class="form-select" id="specialities" name="specialities[]">
                <!-- Options will be loaded dynamically using AJAX -->
              </select>
            </div>

            <!-- Input field for topic name -->
            <div class="mb-3">
              <label for="topicName" class="form-label">Topic Name</label>
              <input type="text" class="form-control" id="topicName" name="topicName">
              <input type="hidden" name="topicId" id="topicId">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="updateTopic">Update Topic</button>
        </div>
      </div>
    </div>
  </div>

@endsection
