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
                              <h4>Add New Image</h4>
                            </div>
                          </div>
                    </div>

                    </div>
                    <form>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="tb-fname" placeholder="Enter Name here">
                            <label for="tb-fname">Question ID</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                         <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="tb-fname" placeholder="Enter Name here">
                            <label for="tb-fname">Put Image Url</label>
                          </div>
                        </div>

                        <div class="col-md-6">
                            <label class="mb-1">Choose Image</label>
                            <div class="mb-3 form-control-file">
                             <input class="form-control" type="file" id="formFile">
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-floating">

                            <textarea class="summernote" name="myTextarea" rows="4" cols="50">
                                Enter Question Expilanation
                            </textarea>

                          </div>
                        </div>


                        <div class="col-12">
                          <div class="d-md-flex align-items-center mt-3">

                                <div class="ms-auto mt-3 mt-md-0">
                                <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                                    <div class="d-flex align-items-center">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Add Image
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
