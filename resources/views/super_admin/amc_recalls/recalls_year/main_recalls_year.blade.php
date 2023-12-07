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
                                        <h5 class="mb-0">Recalls Years</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">

                                        <table id="recalls_year_table" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                            <thead>
                                                <!-- start row -->
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;">Recalls Year ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Recalls Year</th>
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

                var table = $('#recalls_year_table').DataTable({
                                ajax: '/get_recalls_year_data',
                                columns: [
                                    { data: 'recalls_year_id', name: 'recalls_year_id' },
                                    { data: 'year', name: 'year' }, // Adjust the column name based on your actual JSON structure
                                    {
                                        data: null,
                                        render: function (data, type, row) {
                                            return `
                                                <button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary" data-id="${data.recalls_year_id}" >Edit</button>
                                                <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger" data-id="${row.recalls_year_id}">Delete</button>
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




    function loadDataIntoModel(yearId) {
        $.ajax({
            url: '/load_recalls_year_to_edit/' + yearId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var recallsYear = response.recallsYear;

                // Populate data into the modal
                $('#year_id').val(recallsYear.recalls_year_id);
                $('#recalls_year').val(recallsYear.year);

                // Show the modal
                $('#recalls_year_edit_model').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

        // Handle Edit button click in table
        $('#recalls_year_table').on('click', '.edit-btn', function () {
            var yearId = $(this).data('id');
            loadDataIntoModel(yearId);
        });

        // Handle update button click in modal
        $('#updateRecallsBtn').click(function() {
            var yearId = $('#year_id').val();
            var recallsYear = $('#recalls_year').val();

            $.ajax({
                url: '/update_recalls_year/' + yearId,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    recalls_year: recallsYear
                },
                success: function(response) {

                    $('#recalls_year_error').text('');

                    displaySuccessAlert("Success", "Recalls Year updated successfully!");

                    // Optionally, you can close the modal or perform additional actions

                    // Hide the modal
                    $('#recalls_year_edit_model').modal('hide');

                    // Refresh the table data (assuming you have a DataTable variable named 'table')
                    table.ajax.reload();
                },
                error: function(xhr, status, error) {

                    $('#recalls_year_error').text(xhr.responseJSON.errors.recalls_year[0]);
                    displayErrorAlert("Error", xhr.responseJSON.errors.recalls_year[0]);
                }
            });
        });





                // Handle Delete button click
                $('#recalls_year_table').on('click', '.delete-btn', function () {
                    var yearId = $(this).data('id');

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
                            axios.delete(`/delete_recalls_year/${yearId}`)
                                .then(response => {
                                    // Successful deletion, refresh the table
                                    displaySuccessAlert('Success', response.data.message);
                                    $('#recalls_year_table').DataTable().ajax.reload();
                                })
                                .catch(error => {
                                    displayErrorAlert('Error', 'Error deleting record');
                                });
                        }
                    });
                });





            });





        </script>



<!-- The Modal -->
<div class="modal fade" id="recalls_year_edit_model" tabindex="-1" aria-labelledby="topicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="topicModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="edit_recall_year">

            <input type="hidden" name="year_id" id="year_id">

            <div class="form-floating">
                <input type="text"  class="form-control" id="recalls_year" name="recalls_year">
                <label for="recalls_year">Recalls Year</label>
                <span class="text-danger" id="recalls_year_error"></span>
            </div>

          </form>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary" id="updateRecallsBtn">Update</button>
        </div>
      </div>
    </div>
  </div>



        @endsection

