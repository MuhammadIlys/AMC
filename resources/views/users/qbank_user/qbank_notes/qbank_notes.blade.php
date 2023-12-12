
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
    .dt-buttons {
        top: 0 !important;
        right: 0 !IMPORTANT;
        position: absolute !important;
        margin-top: 22px;
    }
    #datatables-example_filter {
        float: right;
    }
    #datatables-example th{
        display: none;
    }
    tbody, td, tfoot, th, thead, tr{

        border: none;
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
                                        <div class="col-xxl-12">
                                            <div class="welcome-title">
                                                <h5 class="statistics"><span>Notes</span>
                                                <hr style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>

                                   <!--Notes Start-->

                                   <div class="table table-card mt-3 mb-1">
                                    <table id="datatables-example" class="table"></table>
                                   </div>


                                   <!--Notes end-->



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

        dom: '<"top"f><"data-table"rt<"bottom"Blip>>',
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search',
            info: '_START_-_END_ of _TOTAL_',
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
        pagingType: 'full',
        responsive: true,
        searching: true,
        select: {
            style: 'multi+shift',
            className: 'table-active'
        },
        stateSave: true,
    })


    const dataSet = [
    [
        `<div class="card nt-card" id="card1">
            <div class="card-header nc-header">
                <div class='savc d-none'>
                    <span class="float-end text-secondary cursor-pointer" onclick='cancelFunc("card1")'>Cancel</span>
                    <span class="float-end text-secondary cursor-pointer" onclick='saveFunc("card1")'>Save | </span>
                </div>
                <div class='edt'>
                    <span class="float-end text-secondary"><i onclick='deleteFunc("card1")' class="la la-trash fs-22 cursor-pointer"></i></span>
                    <span class="float-end text-secondary"><i onclick='editFunc("card1")' class="la la-edit fs-22 cursor-pointer"></i></span>
                </div>
                <h6 class="card-title" style="margin: unset;">Question ID: 19810 Biostatistics - Biostatistics & Epidemiology</h6>
            </div>
            <div class="card-body" id="editDocument1">
                <p id="content1">You can change the heading, author name, and this content itself. Click on Edit Document to start editing. At this point, you can edit this document and the changes will be saved in localStorage. However, once you reload the page your changes will be gone. To fix it, we will have to retrieve the contents from localStorage when the page reloads.</p>
            </div>
        </div>`
    ],


    [
        `<div class="card nt-card" id="card2">
            <div class="card-header nc-header">
                <div class='savc d-none'>
                    <span class="float-end text-secondary cursor-pointer" onclick='cancelFunc("card2")'>Cancel</span>
                    <span class="float-end text-secondary cursor-pointer" onclick='saveFunc("card2")'>Save | </span>
                </div>
                <div class='edt'>
                    <span class="float-end text-secondary"><i onclick='deleteFunc("card1")' class="la la-trash fs-22 cursor-pointer"></i></span>
                    <span class="float-end text-secondary"><i onclick='editFunc("card2")' class="la la-edit fs-22 cursor-pointer"></i></span>
                </div>
                <h6 class="card-title" style="margin: unset;">Question ID: 19810 Biostatistics - Biostatistics & Epidemiology</h6>
            </div>
            <div class="card-body" id="editDocument1">
                <p id="content1">You can change the heading, author name, and this content itself. Click on Edit Document to start editing. At this point, you can edit this document and the changes will be saved in localStorage. However, once you reload the page your changes will be gone. To fix it, we will have to retrieve the contents from localStorage when the page reloads.</p>
            </div>
        </div>`
    ]
];

function editFunc(cardId) {
    const editable = document.querySelector(`#${cardId} #content1`);
    editable.contentEditable = 'true';
    $(`#${cardId}.nt-card`).css({ "border": "1px solid #013884" });
    $(`#${cardId} .savc`).removeClass('d-none');
    $(`#${cardId} .edt`).addClass('d-none');
}

function saveFunc(cardId) {
    const editable = document.querySelector(`#${cardId} #content1`);
    editable.contentEditable = 'false';
    $(`#${cardId}.nt-card`).css({ "border": "unset" });
    $(`#${cardId} .savc`).addClass('d-none');
    $(`#${cardId} .edt`).removeClass('d-none');

    // Save the data in localStorage
    localStorage.setItem(editable.id, editable.innerHTML);
}

function cancelFunc(cardId) {
    const editable = document.querySelector(`#${cardId} #content1`);
    editable.contentEditable = 'false';
    $(`#${cardId}.nt-card`).css({ "border": "unset" });
    $(`#${cardId} .savc`).addClass('d-none');
    $(`#${cardId} .edt`).removeClass('d-none');
}





    $(function() {

        $('#datatables-example').DataTable({
            // Table data
            data: dataSet, // My JS array
            columns: [ // Define table Headers for each column
                { title: 'SCORE' }
            ],
            "columnDefs": [
                // { "width": "10%", "targets": 8 }
            ],
            "fnInitComplete": function(oSettings, json) {
                // Add a class to the search input for styling
                $('.dataTables_filter input').addClass('custom-search-input');
            },
        })
        // .column([2]).visible(false) // Hide Office column for demo suitable width
        .on('page.dt', function() {
            $('[data-toggle="tooltip"]').tooltip({ placement: 'bottom' })
        });
    });

</script>



 @endsection




