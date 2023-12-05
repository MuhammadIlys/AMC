
@extends('super_admin.templates.main')
@section('main-container')

    <div class="container-fluid">
        <!--  container start -->
        <div class="row">
            <div class="col-12">
                <!-- ---------------------
                 start Zero Configuration
                 ---------------- -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <h5 class="mb-0">Upload Image</h5>
                        </div>
                        <form id="upload_mocks_image" style="margin-top:20px;" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="question_tracking_id" name="question_tracking_id">
                                        <label for="question_tracking_id">Question Tracking ID</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="hyper_link_text" name="hyper_link_text">
                                        <label for="hyper_link_text">Hyper Link Text</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <!-- Added "name" attribute for file input -->
                                        <input class="form-control" type="file" id="formFile" name="image_file">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-md-flex align-items-center mt-3">
                                        <div class="ms-auto mt-3 mt-md-0">
                                            <!-- Changed button type to "submit" to submit the form -->
                                            <button id="upload_image"  class="btn btn-info font-medium rounded-pill px-4">
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-send me-2 fs-4"></i>
                                                    Upload Image
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                        <!-- ---------------------
                            end Zero Configuration
                            ---------------- -->
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="zero_config_wrapper" class="dataTables_wrapper">
                                <table id="mocks_images_table" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th >Question Tracking ID</th>
                                            <th >Image</th>
                                            <th >Image Link</th>
                                            <th >Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        <!-- Table body content here... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  container end -->
    </div>

<style>

.break-word {
    word-wrap: break-word;
}

</style>


        <script>
        $(document).ready(function () {

            function initializeDataTable() {

                const dataTable = $('#mocks_images_table').DataTable({
                    ajax: {
                        url: '/load_mocks_images',
                        dataSrc: 'data', // Adjust this based on your API response structure
                    },
                    columns: [
                        { data: 'question_tracking_id', name: 'question_tracking_id' },

                        {
                            data: 'image_path',
                            name: 'image_path',
                            render: function (data) {
                                const baseUrl = '{{ url('/') }}'+'/';
                                return `<img src="${baseUrl}${data}" width="80" height="80" >`;
                            },
                        },
                        {
                            data: 'image_link',
                            name: 'image_link',
                            render: function (data) {
                                // Escape HTML entities to display as plain text
                                return $('<div/>').text(data).html();
                            }
                        },
                        {
                            data: null,
                            render: function (data) {
                                return `

                                    <button class="delete-btn btn btn-sm mb-1 waves-effect waves-light btn-danger"
                                        data-image_id="${data.image_id}"
                                    ">Delete</button>
                                `;
                            },
                        },
                    ],
                    rowCallback: function (row, data, index) {
                        $(row).removeClass('even odd');
                        $(row).addClass(index % 2 === 0 ? 'even' : 'odd');
                    },
                });

                // Apply custom CSS for the image_link column
                dataTable.on('draw.dt', function () {
                    $('.dataTables_scrollBody .dataTables_scrollBodyInner table tbody tr td:nth-child(4)').css({
                        'max-width': '10px !important',  // Set a max-width for the column
                        'word-wrap': 'break-word',
                        'white-space': 'normal',
                    });
                });

                return dataTable;
            }





            // Call initializeDataTable and store the DataTable instance
            var mocksImageTable = initializeDataTable();


            $('#upload_image').on('click', function (event) {

                // Prevent the default form submission
                event.preventDefault();
                // Create a FormData object to store form data
                var formData = new FormData($('#upload_mocks_image')[0]);

                // Make an Ajax request
                $.ajax({
                    type: 'POST',
                    url: '/upload_mocks_image',
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {

                        mocksImageTable.destroy();
                        mocksImageTable = initializeDataTable();
                        // Reset the form after successful submission
                        $('#upload_mocks_image')[0].reset();

                        // Handle the success response
                        displaySuccessAlert('Success','image upload successfully!');


                    },
                    error: function (error) {
                        // Handle the error response
                        displayErorAlert('Error','image upload failed!');
                    }
                });
            });


            $('#mocks_images_table').on('click', '.delete-btn', function () {
                // Retrieve data attributes from the clicked button
                const data = $(this).data();
                var image_id = data.image_id;

                // Show a confirmation dialog using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to delete this image.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed the deletion, send an AJAX request to delete the record
                        $.ajax({
                            url: '/delete_mocks_image/' + image_id, // Adjust the URL to your delete route
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                // Handle the success response, e.g., remove the row from the DataTable
                                if (response.success) {
                                    // Remove the row from the DataTable
                                    displaySuccessAlert('Success','Image Delete Successfully!');
                                    mocksImageTable.destroy();
                                    mocksImageTable = initializeDataTable();
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







        });// ready function end

        </script>




@endsection
