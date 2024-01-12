
@extends('users.qbank_user.templates.main')
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

#datatables-example2_wrapper {
    display: none;
}

.bottom{
    display: none !important;
}


.search-qid {
    border-top: unset;
    border-left: unset;
    border-right: unset;
    border-radius: unset;
    background-color: #ffffff !important;
}

.search-qid:focus{

    border: none;
  border-bottom: 1px solid #013884;
    box-shadow: none;
}

#search-btn {
    background: unset;
    border: unset;
    padding: unset;
    cursor: pointer;
}


.align-items-center {
    -ms-flex-align: center!important;
    align-items: center!important;
}
.flex-grow-1 {
    -ms-flex-positive: 1!important;
    flex-grow: 1!important;
}
.flex-column {
    -ms-flex-direction: column!important;
    flex-direction: column!important;
}
.d-flex {
    display: -ms-flexbox!important;
    display: flex!important;
    margin-bottom: 100px;
}

.default-message-icon {
    margin-top: 100px;
    width: 50px;

}

.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

img {
    vertical-align: middle;
    border-style: none;
}
</style>

<link href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.2/fc-3.3.1/r-2.2.6/rr-1.2.7/sl-1.3.1/datatables.css" rel="stylesheet" crossorigin>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" crossorigin>


<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/staterestore/1.2.2/css/stateRestore.dataTables.min.css">




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
                                        <div class="col-lg-3 col-md-5 col-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control search-qid" placeholder="Enter Question Id " aria-label="Enter Question Id or Keywords" aria-describedby="basic-addon2">
                                                <span class="input-group-text" id="search-btn"><i class="ri-search-line fs-20"></i></span>
                                            </div>
                                        </div>
                                    </div>



                                   <!--Search end-->



                                </div>

                            </div><!-- end card -->

                            <div class="card">

                                <div class="card-body">

                                    <!--<div class="table table-card mt-3 mb-1">-->
                                    <table style="width: 100%;" id="datatables-example2" class="table"></table>

                                    <div id="default-message" class="default-message d-flex flex-column align-items-center flex-grow-1 ng-star-inserted">
                                        <img src="{{ url('/sitelogo/search-default-message-icon.svg') }}" class="default-message-icon mb-4"><span class="default-message-text">Please enter Question Id to find previously tested questions</span>
                                    </div>

                                </div>

                            </div><!-- end card -->


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



        <script>
            $.extend($.fn.dataTable.defaults, {

                dom: '<"top"f><"data-table"rt<"bottom"Blip>>', // https://datatables.net/examples/basic_init/dom.html
                lengthMenu: [ // https://datatables.net/examples/advanced_init/length_menu.html
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"],
                ],
                language: {
                    search: '_INPUT_',
                    searchPlaceholder: 'Search', // https://datatables.net/reference/option/language.searchPlaceholder
                    info: '_START_-_END_ of _TOTAL_', // https://datatables.net/examples/basic_init/language.html
                    lengthMenu: 'Items per page: _MENU_',
                    infoEmpty: '0 of _MAX_',
                    infoFiltered: '',
                    paginate: {
                        first: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M18.41 16.59L13.82 12l4.59-4.59L6l-6 6 6 6zM6 6h2v12H6z"/></svg>',
                        previous: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.4141z"/></svg>',
                        next: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"/></svg>',
                        last: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M5.59 7.41L10.18 12l-4.59 4.59L7 18l6-6-6-6zM6h2v12h-2z"/></svg>'
                    },
                    decimal: ',',
                    thousands: '.',
                    zeroRecords: 'No results found'
                },

                colReorder: true,
                fixedHeader: true,
                ordering: true,
                paging: true,
                pageLength: 10,
                pagingType: 'full', // https://datatables.net/reference/option/pagingType
                responsive: true,
                searching: true,
                select: {
                    style: 'multi+shift', // https://datatables.net/reference/option/select.style
                    className: 'table-active' // https://datatables.net/reference/option/select.className
                },
                stateSave: true,
            })






        $(function() {
            var dataTable = $('#datatables-example2').DataTable({
            columns: [
                { title: '' },
                { title: 'Question ID' },
                { title: 'SYSTEM' },
                { title: 'CHOOSE OPTION' },
                { title: 'STATUS' },
                { title: 'ACTIONS' }
            ],
            columnDefs: [
                { width: '14%', targets: 4 }
            ],
            fnInitComplete: function(oSettings, json) {
                $('.dataTables_filter input').attr('type', 'text');
            },
            paging: false,
            searching: false,
            data: []
        });

    $('#search-btn').on('click', function() {
        var questionId = $('.search-qid').val();

        // Make an AJAX request to your server-side endpoint with the search value
        $.ajax({
            url: '/load_qbank_search_question',
            type: 'POST',
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}',
                questionId: questionId
            },
            success: function(response) {

                if(response.status){

                    $('#default-message').attr('style', 'display: none !important;');
                    $('#datatables-example2_wrapper').show();
                    dataTable.clear().rows.add(response.dataSet).draw();
                    dataTable.paging = false;
                    dataTable.searching = false;
                    $('[data-toggle="tooltip"]').tooltip({ placement: 'bottom' });


                }else{

                    $('#default-message')
                    .addClass('default-message d-flex flex-column align-items-center flex-grow-1 ng-star-inserted')
                    .attr('style', 'display: flex !important;')
                    $('#datatables-example2_wrapper').hide();

                    $('#myToast22 .toast-body h6').text('Question Not Found!');

                    $('#myToast22').toast('show');

                    // Hide the toast after 3 seconds
                    setTimeout(function(){
                        $('#myToast22').toast('hide');
                    }, 5000);


                }

            },
            error: function(error) {
                $('#datatables-example2_wrapper').hide();
                $('#default-message')
                .addClass('default-message d-flex flex-column align-items-center flex-grow-1 ng-star-inserted')
                .attr('style', 'flex !important;')
            }
        });
    });
});


        </script>


<div id="myToast22" class="toast toast-border-danger fade " role="alert" aria-live="assertive" aria-atomic="true" data-bs-toggle="toast" style="position: fixed; bottom: 16px; right: 16px; z-index: 999; height:60px; color: #f06548; border-bottom: 3px solid #f06548;"   data-bs-delay="3000">

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

 @endsection




