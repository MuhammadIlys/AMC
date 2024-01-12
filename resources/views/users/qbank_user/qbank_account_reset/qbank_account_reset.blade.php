
@extends('users.qbank_user.templates.main')
@section('main-container')

<style>
 .swal2-close:focus{

box-shadow: none !important;
}
</style>

  <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100">


                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <div class="flex-shrink-0 ms-2">
                                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#account_reset" role="tab" aria-selected="true" tabindex="-1">
                                                    Test Data Reset
                                                </a>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link " data-bs-toggle="tab" href="#notes_reset" role="tab" aria-selected="true" tabindex="-1">
                                                    Notes Data Reset
                                                </a>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link " data-bs-toggle="tab" href="#highlights_reset" role="tab" aria-selected="true" tabindex="-1">
                                                    Highlights Data Reset
                                                </a>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link " data-bs-toggle="tab" href="#marked_reset" role="tab" aria-selected="true" tabindex="-1">
                                                    Marked Data Reset
                                                </a>
                                            </li>

                                        </ul>
                                    </div>



                                </div>


                                <div class="card-body">


                                    <!-- Tab panes -->
                                    <div class="tab-content text-muted">
                                        <div class="tab-pane active show" id="account_reset" role="tabpanel">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div cdkscrollable="" class="mat-tab-body-content ng-tns-c179-6 ng-trigger ng-trigger-translateTab" style="transform: none;">
                                                        <div class="ng-star-inserted" style="">
                                                            <ul>
                                                                <li>Resetting <strong>Test Data</strong>  will DELETE ALL data
                                                                    related to performance
                                                                    and all previous Tests.
                                                                </li>
                                                                <li> Make sure you save all the important information before initiating the reset.
                                                                </li>
                                                                <li><b>This action is a one-time, irreversible change.</b></li>
                                                            </ul>
                                                        </div>
                                                        @if ($hasTests)
                                                        <button id="tests_reset_btn" class="btn btn-primary btn-text reset-button ng-star-inserted" style="">Reset My Tests
                                                        </button><!---->
                                                        @else
                                                        <div class="alert alert-danger testdatawarning ng-star-inserted" style=""> Your subscription does not qualify for a
                                                            reset or subscription has already been reset.
                                                        </div>
                                                        @endif


                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="tab-pane  show" id="notes_reset" role="tabpanel">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div cdkscrollable="" class="mat-tab-body-content ng-tns-c179-6 ng-trigger ng-trigger-translateTab" style="transform: none;">
                                                        <div class="ng-star-inserted" style="">
                                                            <ul>
                                                                <li>Resetting <strong>Notes</strong>  will DELETE ALL data related to your notes and all previous entries.
                                                                </li>
                                                                <li> Make sure you save all the important information before initiating the reset.
                                                                </li>
                                                                <li><b>This action is a one-time, irreversible change.</b></li>
                                                            </ul>
                                                        </div>
                                                        @if ($hasNotes)
                                                        <button id="notes_reset_btn" class="btn btn-primary btn-text reset-button ng-star-inserted" style="">Reset My Notes
                                                        </button><!---->
                                                        @else
                                                        <div class="alert alert-danger testdatawarning ng-star-inserted" style=""> Your subscription does not qualify for a
                                                            reset or subscription has already been reset.
                                                        </div>
                                                        @endif


                                                    </div>
                                                </div>
                                            </div>


                                        </div>


                                        <div class="tab-pane  show" id="highlights_reset" role="tabpanel">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div cdkscrollable="" class="mat-tab-body-content ng-tns-c179-6 ng-trigger ng-trigger-translateTab" style="transform: none;">
                                                        <div class="ng-star-inserted" style="">
                                                            <ul>
                                                                <li>Resetting <strong>Highlights</strong> will DELETE ALL highlighted data and any previous entries.
                                                                </li>
                                                                <li> Ensure you save all the important information before initiating the reset.
                                                                </li>
                                                                <li><b>This action is a one-time, irreversible change.</b></li>
                                                            </ul>
                                                        </div>
                                                        @if ($hasHighlights)
                                                        <button id="highlights_reset_btn" class="btn btn-primary btn-text reset-button ng-star-inserted" style="">Reset My Highlights
                                                        </button><!---->
                                                        @else
                                                        <div class="alert alert-danger testdatawarning ng-star-inserted" style=""> Your subscription does not qualify for a
                                                            reset or subscription has already been reset.
                                                        </div>
                                                        @endif


                                                    </div>
                                                </div>
                                            </div>


                                        </div>


                                        <div class="tab-pane  show" id="marked_reset" role="tabpanel">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div cdkscrollable="" class="mat-tab-body-content ng-tns-c179-6 ng-trigger ng-trigger-translateTab" style="transform: none;">
                                                        <div class="ng-star-inserted" style="">
                                                            <ul>
                                                                <li>Resetting <strong>Marked</strong> will DELETE ALL marked data and any previous entries.
                                                                </li>
                                                                <li>  Ensure you save all the important information before initiating the reset.
                                                                </li>
                                                                <li><b>This action is a one-time, irreversible change.</b></li>
                                                            </ul>
                                                        </div>
                                                        @if ($hasMarked)
                                                        <button id="marked_reset_btn" class="btn btn-primary btn-text reset-button ng-star-inserted" style="">Reset My Marked
                                                        </button><!---->
                                                        @else
                                                        <div class="alert alert-danger testdatawarning ng-star-inserted" style=""> Your subscription does not qualify for a
                                                            reset or subscription has already been reset.
                                                        </div>
                                                        @endif


                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div><!-- end card-body -->


                            </div>


                            <!--end row-->

                        </div> <!-- end .h-100-->

                    </div> <!-- end col -->

                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

       <!-- SweetAlert2 CSS CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
        <!-- SweetAlert2 JS CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>


        <script>
            $(document).ready(function() {
                function showResetConfirmation(title, content, confirmCallback) {
                    Swal.fire({
                        title: title,
                        text: "This is your final warning!",
                        html: '<p>You are sure to delete.</p> <p>' + content + '</p>',
                        buttonsStyling: false,
                        showCloseButton: true,
                        showConfirmButton: false,
                        footer: '<button type="button" class="swal2-cancel btn btn-default" onclick="swalClose()">No</button><button type="button" class="swal2-cancel btn btn-primary" onclick="' + confirmCallback + '">Yes</button>',
                    });

                    $(".swal2-popup").css({ "width": "32em", "padding-left": "0px", "padding-right": "0px", "padding-top": "0px" });
                    $(".swal2-header").css({ "background": "rgb(221, 51, 51)", "color": "#fff", "display": "block", "margin-bottom": "10px" });
                    $(".swal2-title").css({ "color": "#fff" });
                }

                $("#tests_reset_btn").click(function () {
                    showResetConfirmation("Tests Data Reset!", "Test Data?", "handleAjax('/user_qbank_tests_reset','test')");
                });

                $("#notes_reset_btn").click(function () {
                    showResetConfirmation("Notes Data Reset!", "Notes Data?", "handleAjax('/user_qbank_notes_reset','note')");
                });

                $("#highlights_reset_btn").click(function () {
                    showResetConfirmation("Highlights Data Reset!", "Highlight Data?", "handleAjax('/user_qbank_highlights_reset','highlight')");
                });

                $("#marked_reset_btn").click(function () {
                    showResetConfirmation("Marked Data Reset!", "Marked Data?", "handleAjax('/user_qbank_marked_reset','marked')");
                });



            });// ready function end



            function swalClose() {
                Swal.close();
            }


            function handleAjax(url,resetType){




                $.ajax({
                    url:url ,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        resetType: resetType
                    },
                    success: function(response) {

                        if(response.status){

                            swalClose();

                            $('#myToast33 .toast-body h6').text(response.message);

                            $('#myToast33').toast('show');

                            // Hide the toast after 3 seconds
                            setTimeout(function(){
                                $('#myToast33').toast('hide');
                            }, 5000);


                        }else{

                            swalClose();
                            $('#myToast22 .toast-body h6').text(response.message);

                            $('#myToast22').toast('show');

                            // Hide the toast after 3 seconds
                            setTimeout(function(){
                                $('#myToast22').toast('hide');
                            }, 5000);


                        }

                    },
                    error: function(error) {

                        swalClose();

                        $('#myToast22 .toast-body h6').text('Error Found in Account Reset');

                            $('#myToast22').toast('show');

                            // Hide the toast after 3 seconds
                            setTimeout(function(){
                                $('#myToast22').toast('hide');
                            }, 5000);
                    }
                });
            }


        </script>



        <div id="myToast22" class="toast toast-border-danger fade " role="alert" aria-live="assertive" aria-atomic="true" data-bs-toggle="toast" style="position: fixed; bottom: 16px; right: 16px; z-index: 999; "   data-bs-delay="3000">

            <div class="toast-body">

                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-2">
                        <i class="ri-alert-line align-middle"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0">QBank Activate Successfully!</h6>
                    </div>
                </div>

            </div>
        </div>


        <div id="myToast33" class="toast toast-border-success fade " role="alert" aria-live="assertive" aria-atomic="true" data-bs-toggle="toast" style="position: fixed; bottom: 16px; right: 16px; z-index: 999;" data-bs-delay="3000">

            <div class="toast-body">

                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-2">
                        <i class="ri-checkbox-circle-fill align-middle"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0">QBank Activate Successfully!</h6>
                    </div>
                </div>

            </div>
        </div>





    @endsection
