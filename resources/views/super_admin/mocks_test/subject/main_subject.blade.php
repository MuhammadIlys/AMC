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
                                        <h5 class="mb-0">Subject List</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">


                                            <table id="zero_config" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                                <!-- Table header and columns -->
                                                <thead>
                                                    <tr>
                                                        <th>Subject ID</th>
                                                        <th>Subject Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Table rows will be dynamically populated here -->
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




     <script>

        $(document).ready(function() {


            var table = $('#zero_config').DataTable(); // Initialize DataTables instance

            // Function to fetch subject data and update the table
            function fetchAndDisplaySubjects() {
                $.ajax({
                    url: '{{ route("super_admin.load_subject") }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Update subject data in the table
                        displaySubjectsInTable(response.data);
                    },
                    error: function(xhr) {
                        console.error('Error fetching subject data:', xhr);
                    }
                });
            }

            // Call the function to fetch and display subjects when the page loads
            fetchAndDisplaySubjects();

            function displaySubjectsInTable(subjectData) {
                var tbody = $('#zero_config tbody');

                // Clear existing rows
                table.clear();

                // Iterate through subjectData and add rows for each subject
                subjectData.forEach(function(subject, index) {
                    var rowClass = index % 2 === 0 ? 'even' : 'odd';
                    var row = [
                        subject.subject_id,
                        subject.subject_name,
                        `<button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary" data-id="${subject.subject_id}">Edit</button>
                        <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger" data-id="${subject.subject_id}">Delete</button>`
                    ];
                    table.row.add(row).draw();
                });

                // Attach event handlers for edit and delete buttons
                attachEventHandlers();
            }

            function attachEventHandlers() {
              // Update this inside the click event handler for the edit button
                $('#zero_config').on('click', '.edit-btn', function() {
                    var subjectId = $(this).data('id');
                    // Generate the URL using the subjectId
                    var url2 = `/edit_subject/${subjectId}`;
                    // Perform AJAX call to fetch subject data for editing
                    $.ajax({
                        url: url2,
                        type: 'GET',
                        success: function(response) {
                            // Fill the modal with the subject data
                            $('#subject_name').val(response.subject.subject_name);
                            $('#subject_id').val(response.subject.subject_id);

                            // Show the modal
                            $('#editSubjectModal').modal('show');
                        },
                        error: function(xhr) {
                            console.error('Error fetching subject for editing:', xhr.responseText);
                        }
                    });
                });


                   // Update this to handle the "Update" button click inside the modal
                    $('#updateSubjectBtn').on('click', function() {
                        var subjectId = $('#subject_id').val();
                        var subjectName = $('#subject_name').val();

                        // Perform AJAX call to update the subject
                        $.ajax({
                            url: `/update_subject/${subjectId}`,
                            type: 'PUT',
                            headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                            data: {
                                subject_name: subjectName
                            },
                            success: function(response) {
                                console.log('Subject updated successfully:', response.message);
                                 // Refresh the data in the table
                                 fetchAndDisplaySubjects();

                                // Close the modal
                                $('#editSubjectModal').modal('hide');


                            },
                            error: function(xhr) {
                                console.error('Error updating subject:', xhr.responseText);
                            }
                        });
                    });




                  // Event handler for delete button
                $('#zero_config').on('click', '.delete-btn', function() {
                    var subjectId = $(this).data('id');

                    // Confirm the deletion using SweetAlert
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Perform AJAX call for deletion using the subjectId
                            $.ajax({
                                url: `/delete_subject/${subjectId}`,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {

                                    displaySuccessAlert('Success', 'Subject deleted successfully:');
                                    // Refresh the data in the table
                                    fetchAndDisplaySubjects();
                                },
                                error: function(xhr) {

                                    displayErrorAlert('Error', 'Error deleting subject');
                                    console.error('Error deleting subject:', xhr.responseText);
                                }
                            });
                        }
                    });
                });







            }


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


        });

        </script>




       <!-- Add this HTML to your page for the modal -->
        <div id="editSubjectModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editSubjectForm">
                            <div class="form-group">
                                <label for="subject_name">Subject Name</label>
                                <input type="text" class="form-control" id="subject_name" name="subject_name">
                            </div>
                            <input type="hidden" id="subject_id" name="subject_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="updateSubjectBtn">Update</button>
                    </div>
                </div>
            </div>
        </div>


        @endsection

