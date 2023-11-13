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
                                        <h5 class="mb-0">Test List</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">

                                        <table id="test_list" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                            <thead>
                                                <!-- start row -->
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;">Test ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Test Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 39.7969px;">Total Mark</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 39.7969px;">Passing Score</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 39.7969px;">Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 39.7969px;">Action</th>
                                                </tr>
                                                <!-- end row -->
                                            </thead>
                                            <tbody>



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
$(document).ready(function () {

        function initializeTestTable() {
        return $('#test_list').DataTable({
            ajax: {
                url: '{{ route('get_test_data') }}',
                dataSrc: '', // Required when data is an array, set it to an empty string
                error: function (xhr, error, thrown) {
                    console.log('Error: ' + error);
                }
            },
            columns: [
                { data: 'test_id' },
                { data: 'test_name' },
                { data: 'total_mark' },
                { data: 'passing_score' },
                {
                    data: 'test_status',
                    render: function (data) {
                        if (data === 'active') {
                            return '<span class="mb-1 badge rounded-pill bg-success">Active</span>';
                        } else {
                            return '<span class="mb-1 badge rounded-pill bg-danger">Inactive</span>';
                        }
                    }
                },
                {
                    data: 'test_id',
                    render: function (data) {
                        return `
                            <button class="edit-btn btn btn-sm mb-1 waves-effect waves-light btn-secondary" data-test_id="${data}">Edit</button>
                            <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger" data-test_id="${data}">Delete</button>
                        `;
                    }
                }
            ],
            rowCallback: function (row, data, index) {
                $(row).removeClass('even odd');
                $(row).addClass(index % 2 === 0 ? 'even' : 'odd');
            }
        });
    }

    // Call the initializeTestTable function to set up the DataTable
    var table =initializeTestTable();

     // Edit button click event
     $('#test_list').on('click', '.edit-btn', function () {
        var testId = $(this).data('test_id');
        // Redirect to the edit route with the test_id as a parameter
        window.location.href = "/edit_test/" + testId;

    });

     // Delete button click event
     $('#test_list').on('click', '.delete-btn', function () {
        var testId = $(this).data('test_id');

        // Show a SweetAlert confirmation dialog
        Swal.fire({
            title: 'Delete Test?',
            text: 'Are you sure you want to delete this test?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send an AJAX request to delete the test
                $.ajax({
                    url: '/delete_test/' + testId, // Replace with the actual route for deleting a test
                    type: 'DELETE',
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    success: function (response) {
                        if (response.success) {
                            // Refresh the DataTable to reflect the changes
                            table.ajax.reload();
                        } else {
                            // Handle any errors or display a message
                            alert('Failed to delete the test.');
                        }
                    },
                    error: function () {
                        alert('An error occurred while trying to delete the test.');
                    }
                });
            }
        });
    });









});// end of ready function


        </script>

        @endsection

