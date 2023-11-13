@extends('super-admin.templates.main')
@section('main-container')

        <div class="container-fluid"><!--  container start -->

        <div class="card">
                  <div class="card-body">
                    <h5 class="mb-3">Add Subject</h5>
                    <form>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="tb-fname" placeholder="Enter Name here">
                            <label for="tb-fname">Subject ID</label>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="tb-pwd" placeholder="Topic Name ">
                            <label for="tb-pwd">Subject Name</label>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="d-md-flex align-items-center mt-3">

                                <div class="ms-auto mt-3 mt-md-0">
                                <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                                    <div class="d-flex align-items-center">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Add Subject
                                    </div>
                                </button>
                                </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>





        </div><!--  container end -->

@endsection
