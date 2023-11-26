
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
                                        <h5 class="mb-0">Edit Test</h5>
                                    </div>

                                    <form id="create_test" style="margin-top:20px;">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="test_name" name="test_name" placeholder="Enter Test Name">
                                              <label for="tb-fname">Test Name</label>
                                            </div>
                                          </div>

                                          <div class="col-md-6">
                                            <div class="form-floating">
                                              <input type="text" class="form-control" id="total_mark" name="total_mark" placeholder=" Enter Total Number ">
                                              <label for="tb-pwd">Total Marks</label>
                                            </div>
                                          </div>

                                          <div class="col-md-6">
                                            <div class="form-floating">
                                              <input type="text" class="form-control" id="passing_score" name="passing_score" placeholder=" Enter Passing Score ">
                                              <label for="tb-pwd">Passing Score</label>
                                            </div>
                                          </div>

                                          <div class="col-md-6">
                                            <div class="form-floating">
                                              <input type="text" class="form-control" id="allow_attempt" name="allow_attempt" placeholder=" Enter Allow Attempts ">
                                              <label for="tb-pwd">Allow Attempts</label>
                                            </div>
                                          </div>

                                          <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select mr-sm-2" name="test_status" id="test_status">
                                                    <option value="">Choose Test Status</option>
                                                    <option value="active">active</option>
                                                    <option value="inactive">inactive</option>

                                                </select>
                                                <label for="test_status">Test Status</label>

                                            </div>

                                        </div>


                                        </div>
                                      </form>



                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">
                                        <div class="counter">
                                        <span ><strong id="checkbox-counter">0</strong></span> Total Selected Questions
                                        </div>
                                        <table id="question_list" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                            <thead>
                                                <!-- start row -->
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;">Select Question</th>

                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Question</th>

                                                </tr>
                                                <!-- end row -->
                                            </thead>
                                            <tbody>

                                            </tbody>



                                        </table>
                                    </div>


                                    <div class="col-12">
                                        <div class="d-md-flex align-items-center mt-3">

                                              <div class="ms-auto mt-3 mt-md-0">
                                              <button id="creat_test" type="button" class="btn btn-info font-medium rounded-pill px-4">
                                                  <div class="d-flex align-items-center">
                                                  <i class="ti ti-send me-2 fs-4"></i>
                                                  Update Test
                                                  </div>
                                              </button>
                                              </div>
                                        </div>
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




            function loadTestData(testId) {
                $.ajax({
                    type: 'GET', // Change the request type to GET
                    url: '/load_test_data/' + testId, // Include the test_id in the URL

                    success: function (data) {
                        if (data.success) {

                            $('#test_name').val(data.data.test_name);
                            $('#total_mark').val(data.data.total_mark);
                            $('#passing_score').val(data.data.passing_score);
                            $('#allow_attempt').val(data.data.allow_attempt);
                            $('#test_status').val(data.data.test_status);

                        } else {
                            console.error(data.message); // Log any error message
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors, e.g., display an error message.
                        console.error(error);
                    }
                });
            }


            // Call the function with your test_id
            loadTestData({{ $test_id }});

            function initializeDataTable(testId) {

            const dataTable = $('#question_list').DataTable({
                ajax: {
                    url: '{{ route('test.edit_test_data') }}',
                    method: 'POST',
                    dataSrc: 'data',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        test_id: testId,
                    },


                },
                columns: [
                    {
                        data: null,
                        render: function (data) {


                            // Check the checkbox if test_id matches
                            const isChecked = data.test_id == {{$test_id}} ? 'checked' : '';
                            return '<input type="checkbox" class="question-checkbox" value="' + data.question_id + '" ' + isChecked + '>';
                        },
                    },
                    { data: 'question_text' },


                ],
                rowCallback: function (row, data, index) {
                    $(row).removeClass('even odd');
                    $(row).addClass(index % 2 === 0 ? 'even' : 'odd');
                },
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                },
            });

            return dataTable;
            }


             // Call initializeDataTable and store the DataTable instance
             const questionDataTable = initializeDataTable({{ $test_id }});





            // Function to get the selected question IDs
            function getSelectedQuestionIds(dataTable) {
                const selectedIds = [];
                const rows = dataTable.rows().nodes();

                for (let i = 0; i < rows.length; i++) {
                    const checkbox = $(rows[i]).find('input.question-checkbox');

                    if (checkbox.prop('checked')) {

                        selectedIds.push(checkbox.val());
                    }
                }

                return selectedIds;
            }



            // Example of how to get selected question IDs
            $('#creat_test').click(function () {

                const questionIds = getSelectedQuestionIds(questionDataTable);
                var test_name = $('#test_name').val();
                var total_mark = $('#total_mark').val();
                var passing_score = $('#passing_score').val();
                var allow_attempt = $('#allow_attempt').val();
                var test_status = $('#test_status').val();


                // Create an object to store the data you want to send to the Laravel function
                var testData = {
                    questionIds: questionIds,
                    test_name: test_name,
                    total_mark: total_mark,
                    passing_score: passing_score,
                    allow_attempt: allow_attempt,
                    test_status:test_status,
                    test_id:{{ $test_id }},
                };

                // Use AJAX to send the data to a Laravel route
                $.ajax({
                    type: 'POST', // or 'GET' depending on your route definition
                    url: '/test/update_test', // Replace with your Laravel route URL
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    data: testData,
                    success: function (response) {

                        $('#create_test')[0].reset();
                        // Handle the response from the Laravel function here
                        displaySuccessAlert('Success','Test update Successfully!');
                        questionDataTable.destroy();
                        questionDataTable = initializeDataTable({{ $test_id }});
                    },
                    error: function (xhr, status, error) {
                        // Handle any errors here
                        displayErrorAlert('Error',error);
                    }
                });
            });


















            // Function to update the checkbox counter
            function updateCheckboxCounter() {
                const selectedCheckboxes = $('#question_list input.question-checkbox:checked');
                const counter = $('#checkbox-counter');
                counter.text(selectedCheckboxes.length);
            }

            // Event listener for checkboxes in the DataTable
            $(document).on('change', '#question_list input.question-checkbox', updateCheckboxCounter);



            // Initial call to set the counter value
            updateCheckboxCounter();








        });// ready function end

        </script>




@endsection
