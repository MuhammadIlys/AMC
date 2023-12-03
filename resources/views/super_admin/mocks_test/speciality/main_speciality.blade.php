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
                                        <h5 class="mb-0">Speciality List</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">

                                        <table id="zero_config2" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                            <thead>
                                                <!-- start row -->
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;">Speciality ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Speciality Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Subject Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 39.7969px;">Action</th>
                                                </tr>
                                                <!-- end row -->
                                            </thead>


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

                var table = $('#zero_config2').DataTable({
                    ajax: '/get_speciality_data',
                    columns: [
                        { data: 'speciality_id' },
                        { data: 'speciality_name' },
                        {
                            data: 'subjects',
                            render: function (data) {
                                return data.map(subject => subject.subject_name).join(', ');
                            }
                        },
                        {
                            data: null,
                            render: function (data, type, row) {
                                return `
                                    <button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary" data-id="${data.speciality_id}" data-name="${data.speciality_name}" data-subjects="${data.subjects.map(subject => subject.subject_id).join(',')}">Edit</button>
                                    <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger" data-id="${row.speciality_id}">Delete</button>
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

                //##########################################################################


                 // Function to populate and show the modal for editing
                function editSpecialityModal(specialityId, specialityName, selectedSubjectIds) {
                    $('#speciality_name').val(specialityName);

                    $('#editModal').modal('show');
                }

                function loadDataIntoModel(specialityId){

                    $.ajax({
                        url: '/load_data_to_model/' + specialityId, // Replace with your route
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var allSubjects = response.allSubjects;
                            var selectedSubjects = response.selectedSubjects;
                             $('#speciality_id').val(specialityId);
                            // Clear the select dropdown
                            var select = $('#subject_ids');
                            select.empty();


                            // Populate the select dropdown
                            var select = $('#subject_ids');
                            allSubjects.forEach(function(subject) {
                                select.append('<option value="' + subject.subject_id + '"' + (selectedSubjects.includes(subject.subject_id) ? ' selected' : '') + '>' + subject.subject_name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching subjects:', error);
                        }
                    });
                }


                // Handle Edit button click in table
                $('#zero_config2').on('click', '.edit-btn', function () {


                    var specialityId = $(this).data('id');
                    var specialityName = $(this).data('name');
                    var selectedSubjectIds = $(this).data('subjects').split(',');

                    editSpecialityModal(specialityId, specialityName, selectedSubjectIds);
                    loadDataIntoModel(specialityId);


                });


                // Handle update button click in modele


                $('#updateSpecialityBtn').click(function() {
                    var specialityId = $('#speciality_id').val();
                    var specialityName = $('#speciality_name').val();
                    var selectedSubjects = $('#subject_ids').val();

                    $.ajax({
                        url: '/update_speciality/' + specialityId, // Replace with your route
                        type: 'PUT',
                        headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                        data: {
                            speciality_name: specialityName,
                            subject_ids: selectedSubjects
                        },
                        success: function(response) {

                            displaySuccessAlert("Sucess","Speciality update sucessfully!");

                            // Refresh the table data
                            table.ajax.reload();
                            console.log('Update successful:', response);
                            // Optionally, you can display a success message or perform additional actions
                        },
                        error: function(xhr, status, error) {
                            displaySuccessAlert("Error",error);

                        }
                    });
                });




                // Handle Delete button click
                $('#zero_config2').on('click', '.delete-btn', function () {
                    var specialityId = $(this).data('id');

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
                            axios.delete(`/delete_speciality/${specialityId}`)
                                .then(response => {
                                    // Successful deletion, refresh the table
                                    displaySuccessAlert('Success', response.data.message);
                                    $('#zero_config2').DataTable().ajax.reload();
                                })
                                .catch(error => {
                                    displayErrorAlert('Error', 'Error deleting record');
                                });
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
                        iconColor: '#28a745', // Change the success icon color
                        timerProgressBar: true // Show a progress bar during the timer
                    });
                }






            });





        </script>



   <!-- Bootstrap Modal for Editing -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editModalLabel">Edit Speciality</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit form content -->
                <form action="#" method="POST" id="editSpecialityForm">

                    <input type="hidden" name="speciality_id" id="speciality_id">
                    <div class="form-group">
                        <label for="speciality_name">Speciality Name:</label>
                        <input type="text" class="form-control" id="speciality_name" name="speciality_name" >
                    </div>

                    <div class="form-group">
                        <label for="subject_ids">Select Subjects:</label>
                        <select class="form-control" name="subject_ids[]" id="subject_ids" multiple>
                            <!-- Subject options will be loaded dynamically via JavaScript -->
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" id="updateSpecialityBtn">Update Subjects</button>
                </form>
            </div>
        </div>
    </div>
</div>






        @endsection

