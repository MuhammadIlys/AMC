@extends('super-admin.templates.main')
@section('main-container')

        <div class="container-fluid"><!--  container start -->

        <div class="row">
                        <div class="col-12">
                            <!-- ---------------------
                                    start Zero Configuration
                                ---------------- -->
                            <div class="card">
                                <div class="card-body">
                                 <div style="margin-bottom:10px;" class="row gx-3">
                    <div class="col-6">
                          <div class="d-md-flex align-items-center mt-3">

                            <div class=" mt-3 mt-md-0">
                              <h4>All Subjects</h4>
                            </div>
                          </div>
                    </div>

                    <div class="col-6">
                          <div class="d-md-flex ms-1 mt-3">

                            <div class="ms-auto ms-5  mt-md-0">
                              <button id="addRecallModal" type="button" class="btn btn-info font-medium rounded-pill px-3" style="margin-right:10px" >
                                <div class="d-flex align-items-center">
                                  <i class="ti ti-plus me-3 fs-3"></i>
                                <a class="text-white" href="https://mockuptest.aceamcq.com/amc/amc-qbank/subject/create.php">Add subject</a>
                                </div>
                              </button>
                            </div>
                          </div>
                    </div>
                  </div>

                 <div class="table-responsive">
                        <div id="zero_config_wrapper" class="dataTables_wrapper">
                            <table id="zero_config" class="table border table-striped table-bordered text-nowrap dataTable" aria-describedby="zero_config_info">
                                <thead>
                                                <!-- start row -->
                                     <tr>
                                        <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 141.234px;">Subject ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 236.094px;">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 39.7969px;">Action</th>
                                     </tr>
                                                <!-- end row -->
                                 </thead>
                                <tbody>
                                <tr class="odd">
                                    <td class="">Angelica Ramos</td>
                                        <td>Chief Executive Officer (CEO)</td>
                                                <td>
                                                    <button class=" btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                    <button class="btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                </td>
                                                </tr>
                                                 <tr class="even">
                                                    <td class="">Fiona Green</td>
                                                    <td>Chief Operating Officer (COO)</td>
                                                    <td>
                                                        <button class=" btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                        <button class=" btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                    </td>

                                                </tr>
                                                <tr class="odd">
                                                    <td class="">Paul Byrd</td>
                                                    <td>Chief Financial Officer (CFO)</td>
                                                    <td>
                                                    <button class="btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                        <button class="btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                    </td>

                                                </tr>
                                                <tr class="even">
                                                    <td class="">Yuri Berry</td>
                                                    <td>Chief Marketing Officer (CMO)</td>
                                                    <td>
                                                    <button class="btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                        <button class="btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                    </td>

                                                </tr><tr class="odd">
                                                    <td class="">Jackson Bradshaw</td>
                                                    <td>Director</td>
                                                    <td>
                                                    <button class="btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                        <button class=" btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                    </td>

                                                </tr><tr class="even">
                                                    <td class="">Charde Marshall</td>
                                                    <td>Regional Director</td>
                                                    <td>
                                                    <button class="btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                        <button class="btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                    </td>

                                                </tr><tr class="odd">
                                                    <td class="">Vivian Harrell</td>
                                                    <td>Financial Controller</td>
                                                    <td>
                                                    <button class="btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                        <button class="btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                    </td>

                                                </tr><tr class="even">
                                                    <td class="">Cedric Kelly</td>
                                                    <td>Senior Javascript Developer</td>
                                                    <td>
                                                    <button class="btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                        <button class="btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                    </td>

                                                </tr><tr class="odd">
                                                    <td class="">Tatyana Fitzpatrick</td>
                                                    <td>Regional Director</td>
                                                    <td>
                                                    <button class="btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                        <button class="btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                    </td>

                                                </tr><tr class="even">
                                                    <td class="">Brielle Williamson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>
                                                    <button class="btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                        <button class="btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                    </td>


                                                </tr>
                                                </tr><tr class="odd">
                                                    <td class="">Brielle Williamson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>
                                                    <button class="btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                        <button class="btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                    </td>

                                                </tr>
                                                </tr><tr class="even">
                                                    <td class="">Brielle Williamson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>
                                                        <button class="btn btn-sm mb-1 waves-effect waves-light btn-secondary">Edit</button>
                                                        <button class="btn btn-sm mb-1 waves-effect waves-light btn-danger">Delete</button>
                                                    </td>

                                                </tr>


                                            </tbody>


                                            <tfoot>
                                                <!-- start row -->
                                                <tr>
                                                    <th rowspan="1" colspan="1">Subject ID</th>
                                                    <th rowspan="1" colspan="1">Name</th>
                                                    <th rowspan="1" colspan="1">Action</th>

                                                <!-- end row -->
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- ---------------------
                                    end Zero Configuration
                            ---------------- -->
                        </div>
                    </div>

        </div>
        <!--  container end -->

@endsection
