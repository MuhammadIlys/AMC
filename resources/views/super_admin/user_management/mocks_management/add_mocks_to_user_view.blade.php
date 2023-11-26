
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
                                        <h5 class="mb-0">Add Mocks </h5>
                                    </div>




                                    <div class="table-responsive">
                                        <div id="zero_config_wrapper" class="dataTables_wrapper">

                                            <form  method="post" action="{{ route('save-mocks-to-user') }}">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                                <table id="testsTable" class="table border table-striped table-bordered text-nowrap dataTable no-footer">
                                                    <thead>
                                                        <tr>
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" style="width: 286.016px;" aria-label="Subject ID: activate to sort column descending" aria-sort="ascending">Test ID</th>
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" style="width: 286.016px;" aria-label="Subject ID: activate to sort column descending" aria-sort="ascending">Test Name</th>
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" style="width: 286.016px;" aria-label="Subject ID: activate to sort column descending" aria-sort="ascending">Total Mark</th>
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" style="width: 286.016px;" aria-label="Subject ID: activate to sort column descending" aria-sort="ascending">Passing Score</th>
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" style="width: 286.016px;" aria-label="Subject ID: activate to sort column descending" aria-sort="ascending">Allow Attempt</th>
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" style="width: 286.016px;" aria-label="Subject ID: activate to sort column descending" aria-sort="ascending">Test Status</th>
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" style="width: 286.016px;" aria-label="Subject ID: activate to sort column descending" aria-sort="ascending">Link with User</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($tests as $test)
                                                            <tr>
                                                                <td>{{ $test->test_id }}</td>
                                                                <td>{{ $test->test_name }}</td>
                                                                <td>{{ $test->total_mark }}</td>
                                                                <td>{{ $test->passing_score }}</td>
                                                                <td>{{ $test->allow_attempt }}</td>
                                                                <td>{{ $test->test_status }}</td>
                                                                <td>
                                                                    <input type="checkbox" name="linked_tests[]" value="{{ $test->test_id }}"
                                                                        {{ $test->linked_to_user ? 'checked' : '' }}>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <button type="submit" class="btn btn-info font-medium rounded-pill px-4" >Link/Update</button>
                                            </form>
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


            $(document).ready(function (){

                @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                });
                @endif


                $('#testsTable').DataTable();






            });// ready function end

        </script>




@endsection
