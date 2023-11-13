@extends('super-admin.templates.main')
@section('main-container')

<style>

    .summernotemargin{
        margin-bottom:10px !important;
    }
</style>


        <div class="container-fluid"><!--  container start -->

        <div class="card">
                  <div class="card-body">
<div style="margin-bottom:10px;" class="row gx-3">
                    <div class="col-6">
                          <div class="d-md-flex align-items-center mt-3">

                            <div class=" mt-3 mt-md-0">
                              <h4>Add Recall Year</h4>
                            </div>
                          </div>
                    </div>

                    <div class="col-6">
                          <div class="d-md-flex  mt-3">

                            <div class="ms-auto mt-3 mt-md-0">
                              <button type="button" class="btn btn-info font-medium rounded-pill px-3">
                                <div class="d-flex align-items-center">
                                  <i class="ti ti-eye me-2 fs-3"></i>
                                <a style="color:white !important;" href="https://mockuptest.aceamcq.com/amc/amc-recall/recall-timeFrame/index.php">View TimeFrame</a>
                                </div>
                              </button>
                            </div>
                          </div>
                    </div>

                    </div>
                    <form>
                      <form>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="tb-fname" placeholder="Enter Name here">
                            <label for="tb-fname">Recall Year</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                         <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="tb-fname" placeholder="Enter Name here">
                            <label for="tb-fname">Recall Month</label>
                          </div>
                        </div>

                        <div class="col-md-6">
                            <label class="mb-1">Recall Image</label>
                            <div class="mb-3 form-control-file">
                             <input class="form-control" type="file" id="formFile">
                            </div>
                        </div>



                        <div class="col-12">
                          <div class="d-md-flex align-items-left mt-3">
                            <div class="text-start">
                                <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                                    <div class="d-flex align-items-left">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Add Recall Year
                                    </div>
                                </button>
                                </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    </form>
                  </div>
                </div>

        </div><!--  container end -->

@endsection
