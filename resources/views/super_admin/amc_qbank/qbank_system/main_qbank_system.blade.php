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
                                        <h5 class="mb-0">QBank System</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">

                                        <table id="qbank_system_table" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                            <thead>
                                                <!-- start row -->
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;">QBank System ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">System Name</th>
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

                var table = $('#qbank_system_table').DataTable({
                                ajax: '/get_qbank_system_data',
                                columns: [
                                    { data: 'qbank_system_id', name: 'qbank_system_id' },
                                    { data: 'system_name', name: 'system_name' }, // Adjust the column name based on your actual JSON structure
                                    {
                                        data: null,
                                        render: function (data, type, row) {
                                            return `
                                                <button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary" data-id="${data.qbank_system_id}" >Edit</button>
                                                <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger" data-id="${data.qbank_system_id}">Delete</button>
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




    function loadDataIntoModel(systemId) {
        $.ajax({
            url: '/load_qbank_system_to_edit/' + systemId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var qbankSystem = response.qbankSystem;

                // Populate data into the modal
                $('#system_id').val(qbankSystem.qbank_system_id);
                $('#qbank_system').val(qbankSystem.system_name);

                // Show the modal
                $('#qbank_system_edit_model').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

        // Handle Edit button click in table
        $('#qbank_system_table').on('click', '.edit-btn', function () {
            var systemId = $(this).data('id');
            loadDataIntoModel(systemId);
        });

        // Handle update button click in modal
        $('#updateQbankBtn').click(function() {
            var systemId = $('#system_id').val();
            var qbankSystem = $('#qbank_system').val();

            $.ajax({
                url: '/update_qbank_system/' + systemId,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    qbank_system: qbankSystem
                },
                success: function(response) {

                    $('#qbank_system_error').text('');

                    displaySuccessAlert("Success", "QBank Year updated successfully!");

                    // Optionally, you can close the modal or perform additional actions

                    // Hide the modal
                    $('#qbank_system_edit_model').modal('hide');

                    // Refresh the table data (assuming you have a DataTable variable named 'table')
                    table.ajax.reload();
                },
                error: function(xhr, status, error) {

                    $('#qbank_system_error').text(xhr.responseJSON.errors.qbank_system[0]);
                    displayErrorAlert("Error", xhr.responseJSON.errors.qbank_system[0]);
                }
            });
        });





                // Handle Delete button click
                $('#qbank_system_table').on('click', '.delete-btn', function () {
                    var systemId = $(this).data('id');

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
                            axios.delete(`/delete_qbank_system/${systemId}`)
                                .then(response => {
                                    // Successful deletion, refresh the table
                                    displaySuccessAlert('Success', response.data.message);
                                    $('#qbank_system_table').DataTable().ajax.reload();
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
<div class="modal fade" id="qbank_system_edit_model" tabindex="-1" aria-labelledby="topicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="topicModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="edit_qbank_system">

            <input type="hidden" name="system_id" id="system_id">

            <div class="form-floating">
                <input type="text"  class="form-control" id="qbank_system" name="qbank_system">
                <label for="qbank_system">QBank System</label>
                <span class="text-danger" id="qbank_system_error"></span>
            </div>

          </form>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary" id="updateQbankBtn">Update</button>
        </div>
      </div>
    </div>
  </div>



        @endsection

