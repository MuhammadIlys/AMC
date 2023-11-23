
@extends('users.mocks_user.templates.main')
@section('main-container')

<style>


    #chart {
      width: 500px;
      height: 360px;
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
                                                    Mocks Data Reset
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
                                                                <li>Resetting Test Data will DELETE ALL data
                                                                    related to performance
                                                                    and all previous Mocks
                                                                </li>
                                                                <li> Make sure you save all the related info before reset.
                                                                </li>
                                                                <li><b>1 time, irreversible change.</b></li>
                                                            </ul>
                                                        </div>
                                                        @if ($hasTest)
                                                        <button id="account_reset" class="btn btn-primary btn-text reset-button ng-star-inserted" style="">Reset My Account
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


        <script>
            $(document).ready(function() {
                // Attach a click event handler to the button with ID "account_reset"
                $("#account_reset").click(function() {
                    // Display a custom SweetAlert2 confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, reset it!'
                    }).then((result) => {
                        // If the user clicks "Yes," proceed with the Ajax request
                        if (result.isConfirmed) {
                            // Send an Ajax request to the Laravel server
                            $.ajax({
                                url: '/mocks_user_account_reset',
                                type: 'get',

                                success: function(response) {
                                         // Handle the success response from the server
                                    if (response.status === 'success') {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: response.message,
                                            icon: 'success',
                                            timer: 2000, // Close after 2 seconds
                                            timerProgressBar: true,
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: response.message,
                                            icon: 'error',
                                            timer: 2000, // Close after 2 seconds
                                            timerProgressBar: true,
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                     // Handle errors
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'An error occurred while resetting the account.',
                                        icon: 'error',
                                        timer: 2000, // Close after 2 seconds
                                        timerProgressBar: true,
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>








    @endsection
