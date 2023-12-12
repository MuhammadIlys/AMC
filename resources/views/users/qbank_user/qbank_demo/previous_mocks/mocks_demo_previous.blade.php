@extends('users.mocks_user.demo.templates.main')
@section('main-container')

    <style>
        .table>:not(caption)>*>*{
            background: unset;
            --vz-text-opacity: 1;
            color: #878a99!important;
        }
        .form-select{
            width: unset;
        }
    </style>

    <link href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.2/fc-3.3.1/r-2.2.6/rr-1.2.7/sl-1.3.1/datatables.css" rel="stylesheet" crossorigin>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" crossorigin>


    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/staterestore/1.2.2/css/stateRestore.dataTables.min.css">




    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Check for the error in session and show SweetAlert2 -->

    @if(session('mocks_older_error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('mocks_older_error') }}',
        });
    </script>
    @endif


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100">


                            <!--////-->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div id="datatables-example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                <div class="top">
                                                   <div id="datatables-example2_filter" class="dataTables_filter"><label><input type="text" class="form-control form-control-sm" placeholder="Search" aria-controls="datatables-example2"></label></div>
                                                </div>
                                                <div class="data-table">
                                                   <table id="datatables-example2" class="table dataTable no-footer" aria-describedby="datatables-example2_info" style="width: 1107px;">
                                                      <thead>
                                                         <tr>
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="datatables-example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Percentage: activate to sort column descending" style="width: 100.4px;">Percentage</th>
                                                            <th class="sorting" tabindex="0" aria-controls="datatables-example2" rowspan="1" colspan="1" aria-label="NAME: activate to sort column ascending" style="width: 66.8px;">NAME</th>
                                                            <th class="sorting" tabindex="0" aria-controls="datatables-example2" rowspan="1" colspan="1" aria-label="DATE: activate to sort column ascending" style="width: 90.8px;">DATE</th>
                                                            <th class="sorting" tabindex="0" aria-controls="datatables-example2" rowspan="1" colspan="1" aria-label="Obtain Marks: activate to sort column ascending" style="width: 115.8px;">Obtain Marks</th>
                                                            <th class="sorting" tabindex="0" aria-controls="datatables-example2" rowspan="1" colspan="1" aria-label="Correct Qs: activate to sort column ascending" style="width: 91.8px;">Correct Qs</th>
                                                            <th class="sorting" tabindex="0" aria-controls="datatables-example2" rowspan="1" colspan="1" aria-label="Incorrect Qs: activate to sort column ascending" style="width: 104.8px;">Incorrect Qs</th>
                                                            <th class="sorting" tabindex="0" aria-controls="datatables-example2" rowspan="1" colspan="1" aria-label="Omitted Qs: activate to sort column ascending" style="width: 135.8px;">Omitted Qs</th>
                                                            <th class="sorting" tabindex="0" aria-controls="datatables-example2" rowspan="1" colspan="1" aria-label="Test Status: activate to sort column ascending" style="width: 95.8px;">Test Status</th>
                                                            <th class="sorting" tabindex="0" aria-controls="datatables-example2" rowspan="1" colspan="1" aria-label="ACTIONS: activate to sort column ascending" style="width: 119.4px;">ACTIONS</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>
                                                         <tr class="odd">
                                                            <td class="sorting_1"><span class="badge rounded-pill bg-danger">40%</span></td>
                                                            <td>Mocks Demo1</td>
                                                            <td>2023/11/30</td>
                                                            <td>150</td>
                                                            <td>40</td>
                                                            <td>60</td>
                                                            <td>50</td>
                                                            <td><span class="badge badge-label bg-danger">Fail</span></td>
                                                            <td><a title="Show Test Preview" href="/mocks_preview_demo"><i class="la la-play-circle la-lg pointer fs-22 cursor-pointer" style="color: #2196F3"></i></a> <a title="Show Test Result" href="/mocks_result_demo"><i class="la la-tasks la-lg pointer fs-22 cursor-pointer ms-2" style="color: #2196F3"></i></a> <a title="Show Test Analytics" href="/mocks_analytics_demo"><i class="bx bx-bar-chart pointer fs-22 cursor-pointer ms-2" style="color: #2196F3"></i></a></td>
                                                        </tr>
                                                         <tr class="even">
                                                            <td class="sorting_1"><span class="badge rounded-pill bg-success">70%</span></td>
                                                            <td>Mocks Demo2</td>
                                                            <td>2023/11/30</td>
                                                            <td>270</td>
                                                            <td>90</td>
                                                            <td>40</td>
                                                            <td>10</td>
                                                            <td><span class="badge badge-label bg-success">Pass</span></td>
                                                            <td><a title="Show Test Preview" href="/mocks_preview_demo"><i class="la la-play-circle la-lg pointer fs-22 cursor-pointer" style="color: #2196F3"></i></a> <a title="Show Test Result" href="/mocks_result_demo"><i class="la la-tasks la-lg pointer fs-22 cursor-pointer ms-2" style="color: #2196F3"></i></a> <a title="Show Test Analytics" href="/mocks_analytics_demo"><i class="bx bx-bar-chart pointer fs-22 cursor-pointer ms-2" style="color: #2196F3"></i></a></td>
                                                        </tr>
                                                         <tr class="odd">
                                                            <td class="sorting_1"><span class="badge rounded-pill bg-danger">31%</span></td>
                                                            <td>Mocks Demo3</td>
                                                            <td>2023/11/30</td>
                                                            <td>50</td>
                                                            <td>30</td>
                                                            <td>70</td>
                                                            <td>50</td>
                                                            <td><span class="badge badge-label bg-danger">Fail</span></td>
                                                            <td><a title="Show Test Preview" href="/mocks_preview_demo"><i class="la la-play-circle la-lg pointer fs-22 cursor-pointer" style="color: #2196F3"></i></a> <a title="Show Test Result" href="/mocks_result_demo"><i class="la la-tasks la-lg pointer fs-22 cursor-pointer ms-2" style="color: #2196F3"></i></a> <a title="Show Test Analytics" href="/mocks_analytics_demo"><i class="bx bx-bar-chart pointer fs-22 cursor-pointer ms-2" style="color: #2196F3"></i></a></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                   <div class="bottom">
                                                      <div class="dt-buttons"><button class="dt-button buttons-collection buttons-colvis" tabindex="0" aria-controls="datatables-example2" type="button" aria-haspopup="dialog"><span>Column visibility</span><span class="dt-down-arrow">▼</span></button> </div>
                                                      <div class="dataTables_length" id="datatables-example2_length">
                                                         <label>
                                                            Items per page:
                                                            <select name="datatables-example2_length" aria-controls="datatables-example2" class="form-select form-select-sm">
                                                               <option value="10">10</option>
                                                               <option value="25">25</option>
                                                               <option value="50">50</option>
                                                               <option value="-1">All</option>
                                                            </select>
                                                         </label>
                                                      </div>
                                                      <div class="dataTables_info" id="datatables-example2_info" role="status" aria-live="polite">1-3 of 3</div>
                                                      <div class="dataTables_paginate paging_full" id="datatables-example2_paginate">
                                                         <ul class="pagination">
                                                            <li class="paginate_button page-item first disabled" id="datatables-example2_first">
                                                               <a aria-controls="datatables-example2" aria-disabled="true" aria-role="link" data-dt-idx="first" tabindex="0" class="page-link">
                                                                  <svg class="dataTables-svg" viewBox="0 0 24 24">
                                                                     <path d="M18.41 16.59L13.82 12l4.59-4.59L6l-6 6 6 6zM6 6h2v12H6z"></path>
                                                                  </svg>
                                                               </a>
                                                            </li>
                                                            <li class="paginate_button page-item previous disabled" id="datatables-example2_previous">
                                                               <a aria-controls="datatables-example2" aria-disabled="true" aria-role="link" data-dt-idx="previous" tabindex="0" class="page-link">
                                                                  <svg class="dataTables-svg" viewBox="0 0 24 24">
                                                                     <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.4141z"></path>
                                                                  </svg>
                                                               </a>
                                                            </li>
                                                            <li class="paginate_button page-item next disabled" id="datatables-example2_next">
                                                               <a aria-controls="datatables-example2" aria-disabled="true" aria-role="link" data-dt-idx="next" tabindex="0" class="page-link">
                                                                  <svg class="dataTables-svg" viewBox="0 0 24 24">
                                                                     <path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
                                                                  </svg>
                                                               </a>
                                                            </li>
                                                            <li class="paginate_button page-item last disabled" id="datatables-example2_last">
                                                               <a aria-controls="datatables-example2" aria-disabled="true" aria-role="link" data-dt-idx="last" tabindex="0" class="page-link">
                                                                  <svg class="dataTables-svg" viewBox="0 0 24 24">
                                                                     <path d="M5.59 7.41L10.18 12l-4.59 4.59L7 18l6-6-6-6zM6h2v12h-2z"></path>
                                                                  </svg>
                                                               </a>
                                                            </li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div> <!-- end .h-100-->

                    </div> <!-- end col -->

                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->




        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

        <!--datatable js-->
        <script src="{{ asset('user/mock_user_assets/assets/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('user/mock_user_assets/assets/datatables/js/dataTables.bootstrap5.min.js') }}"></script>

        <script src="https://cdn.datatables.net/staterestore/1.2.2/js/dataTables.stateRestore.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>



        <script src="{{ asset('user/mock_user_assets/assets/js/pages/datatables.init.js') }}"></script>



@endsection
