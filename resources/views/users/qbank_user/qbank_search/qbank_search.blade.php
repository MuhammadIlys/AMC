
@extends('users.qbank_user.templates.main')
@section('main-container')

<style>


.search-qid {
    border-top: unset;
    border-left: unset;
    border-right: unset;
    border-radius: unset;
}

#search-btn {
    background: unset;
    border: unset;
    padding: unset;
    cursor: pointer;
}
</style>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100">
                            <div class="card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-12">
                                            <div class="welcome-title">
                                                <h5 class="statistics"><span>Search</span>
                                                <hr style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>

                                   <!--Search Start-->


                                   <div class="row">
                                        <div class="col-xxl-5">
                                            <div class="input-group">
                                                <input type="text" class="form-control search-qid" placeholder="Enter Question Id or Keywords" aria-label="Enter Question Id or Keywords" aria-describedby="basic-addon2">
                                                <span class="input-group-text" id="search-btn"><i class="ri-search-line fs-20"></i></span>
                                            </div>
                                        </div>
                                    </div>



                                   <!--Search end-->



                                </div>

                            </div>
                            <!--end row-->

                        </div> <!-- end .h-100-->

                    </div> <!-- end col -->

                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
 @endsection




