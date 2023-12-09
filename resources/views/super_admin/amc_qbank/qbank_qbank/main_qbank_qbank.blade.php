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
                                        <h5 class="mb-0">QBanks</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">

                                        <table id="qbank_table" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                            <thead>
                                                <!-- start row -->
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;">QBank ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">QBank Name</th>
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

                var table = $('#qbank_table').DataTable({
                                ajax: '/get_qbanks_data',
                                columns: [
                                    { data: 'qbank_id', name: 'qbank_id' },
                                    { data: 'qbank_name', name: 'qbank_name' }, // Adjust the column name based on your actual JSON structure
                                    {
                                        data: null,
                                        render: function (data, type, row) {
                                            return `
                                                <button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary" data-id="${data.qbank_id}" >Edit</button>
                                                <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger" data-id="${row.qbank_id}">Delete</button>
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




    function loadDataIntoModel(qbankId) {
        $.ajax({
            url: '/load_qbank_to_edit/' + qbankId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var qbank = response.qbank;

                // Populate data into the modal
                $('#qbank_id').val(qbank.qbank_id);
                $('#qbank_name').val(qbank.qbank_name);

                // Show the modal
                $('#qbank_edit_model').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

        // Handle Edit button click in table
        $('#qbank_table').on('click', '.edit-btn', function () {
            var qbankId = $(this).data('id');
            loadDataIntoModel(qbankId);
        });

        // Handle update button click in modal
        $('#updateQbankBtn').click(function() {
            var qbankId = $('#qbank_id').val();
            var qbank_name = $('#qbank_name').val();

            $.ajax({
                url: '/update_qbank/' + qbankId,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    qbank_name: qbank_name
                },
                success: function(response) {

                    $('#qbank_name_error').text('');

                    displaySuccessAlert("Success", "QBank updated successfully!");

                    // Optionally, you can close the modal or perform additional actions

                    // Hide the modal
                    $('#qbank_edit_model').modal('hide');

                    // Refresh the table data (assuming you have a DataTable variable named 'table')
                    table.ajax.reload();
                },
                error: function(xhr, status, error) {

                    $('#qbank_name_error').text(xhr.responseJSON.errors.qbank_name[0]);
                    displayErrorAlert("Error", xhr.responseJSON.errors.qbank_name[0]);
                }
            });
        });





                // Handle Delete button click
                $('#qbank_table').on('click', '.delete-btn', function () {
                    var qbankId = $(this).data('id');

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
                            axios.delete(`/delete_qbank/${qbankId}`)
                                .then(response => {
                                    // Successful deletion, refresh the table
                                    displaySuccessAlert('Success', response.data.message);
                                    $('#qbank_table').DataTable().ajax.reload();
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
<div class="modal fade" id="qbank_edit_model" tabindex="-1" aria-labelledby="topicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="topicModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="edit_recall_year">

            <input type="hidden" name="qbank_id" id="qbank_id">

            <div class="form-floating">
                <input type="text"  class="form-control" id="qbank_name" name="qbank_name">
                <label for="qbank_name">QBank Name</label>
                <span class="text-danger" id="qbank_name_error"></span>
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

