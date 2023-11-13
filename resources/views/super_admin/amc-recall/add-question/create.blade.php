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
                              <h4>Add Question</h4>
                            </div>
                          </div>
                    </div>

                    <div class="col-6">
                          <div class="d-md-flex  mt-3">

                            <div class="ms-auto mt-3 mt-md-0">
                              <button type="button" class="btn btn-info font-medium rounded-pill px-3">
                                <div class="d-flex align-items-center">
                                  <i class="ti ti-eye me-2 fs-3"></i>
                                <a style="color:white !important;" href="view_question_list.php">View Question</a>
                                </div>
                              </button>
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

                                <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option >Choose Subject</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">

                                <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option >Choose  Speciality</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">

                                <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option >Choose  Topic</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote" name="myTextarea" rows="4" cols="50">
                                Enter Question
                            </textarea>

                          </div>
                        </div>

                        <div class="col-md-6 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote2" name="myTextarea" rows="4" cols="50">
                                Option 1
                            </textarea>

                          </div>
                        </div>

                        <div class="col-md-6 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote2" name="myTextarea" rows="4" cols="50">
                                Option 2
                            </textarea>

                          </div>
                        </div>

                        <div class="col-md-6 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote2" name="myTextarea" rows="4" cols="50">
                                Option 3
                            </textarea>

                          </div>
                        </div>

                        <div class="col-md-6 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote2" name="myTextarea" rows="4" cols="50">
                                Option 4
                            </textarea>

                          </div>
                        </div>

                        <div class="col-md-12 summernotemargin">
                          <div class="form-floating">

                            <textarea class="summernote2" name="myTextarea" rows="4" cols="50">
                                Option 5
                            </textarea>

                          </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">

                                <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option >Choose  correct Option</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">

                                <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option >Choose  Question Type</option>
                                    <option value="1">Hard</option>
                                    <option value="2">Pair</option>
                                    <option value="3">Easy</option>
                                </select>
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
                                    Add Question
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
