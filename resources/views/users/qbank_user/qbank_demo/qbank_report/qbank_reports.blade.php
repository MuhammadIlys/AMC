
@extends('users.qbank_user.templates.main')
@section('main-container')



    <style>
        .table > :not(caption) > * > * {
            background: unset;
            --vz-text-opacity: 1;
            color: #878a99 !important;
        }

        .form-select {
            width: unset;
        }
    </style>
    <style>
        td.details-control {
            cursor: pointer;
        }
        tr.shown td.details-control i {
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            -o-transform: rotate(180deg);
            transform: rotate(180deg);
        }
        td {
            padding : 0;
            margin  : 0;
        }

        .details-container {
            width            : 100%;
            height           : 100%;
            background-color : #FFF;
            padding-top      : 5px;
        }

        .details-table {
            width            : 100%;
            background-color : #FFF;
            margin           : 5px;
        }

        .title {
            font-weight : bold;
        }

        .iconSettings {
            margin-top    : 5px;
            margin-bottom : 10px;
            font-size     : 12px;
            position      : relative;
            top           : 1px;
            display       : inline-block;
            font-family   : 'Glyphicons Halflings';
            font-style    : normal;
            font-weight   : 400;
            line-height   : 1;
            -webkit-font-smoothing : antialiased;
        }

        td.details-control {
            cursor     : pointer;
            text-align : center;
            padding: unset;

        &:before {
         @extend .iconSettings;
             content : '\2b';
             font-size: 29px;
         }
        }

        tr.shown td.details-control {
        &:before {
         @extend .iconSettings;
             content : '\2212';
             padding: unset;
         }
        }


    </style>
    <link href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.2/fc-3.3.1/r-2.2.6/rr-1.2.7/sl-1.3.1/datatables.css"
          rel="stylesheet" crossorigin>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet"
          crossorigin>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/staterestore/1.2.2/css/stateRestore.dataTables.min.css">



    <!--///-->
    <style>
        :root
        {
            --text: "Select values";
        }
        .multiple_select
        {
            height: 18px;
            width: 90%;
            overflow: hidden;
            -webkit-appearance: menulist;
            position: relative;
            z-index: 1000;
        }
        .multiple_select::before
        {
            content: var(--text);
            display: block;
            margin-left: 5px;
            margin-bottom: 2px;
        }
        .multiple_select_active
        {
            overflow: visible !important;
        }
        .multiple_select option
        {
            display: none;
            height: 18px;
            background-color: white;
        }
        .multiple_select_active option
        {
            display: block;
        }

        .multiple_select option::before {
            content: "\2610";
        }
        .multiple_select option:checked::before {
            content: "\2611";
        }
        .mselect {
            position: relative;
            display: flex;
            width: 20em;
            height: 1.6em;
            border-radius: unset;
            overflow: hidden;
            /*margin-top: -11px;*/
            margin-left: 10px;
        }
        /* Arrow */
        .mselect::after {
            content: '\25BC';
            position: absolute;
            top: -8px;
            right: -13px;
            padding: 1em;
            transition: .25s all ease;
            pointer-events: none;
            font-size: 13px;
        }
        /* Transition */
        .mselect:hover::after {
            color: #f39c12;
        }
    </style>

    <!--///-->

    <style>
        :root {
            --background-gradient: linear-gradient(30deg, #f39c12 30%, #f1c40f);
            --gray: #34495e;
            --darkgray: #2c3e50;
        }

        select {
            /* Reset Select */
            appearance: none;
            outline: 0;
            border: 0;
            box-shadow: none;
            /* Personalize */
            flex: 1;
            /*padding: 0 1em;*/
            background-image: none;
            cursor: pointer;
            border-bottom: 1px solid;
            border-radius: unset;
            font-size: 16px;
        }
        /* Remove IE arrow */
        select::-ms-expand {
            display: none;
        }
        /* Custom Select wrapper */
        .select {
            position: relative;
            display: flex;
            width: 20em;
            height: 2em;
            border-radius: .25em;
            overflow: hidden;
            /*margin-top: -11px;*/
            margin-left: 10px;
        }
        /* Arrow */
        .select::after {
            content: '\25BC';
            position: absolute;
            top: -8px;
            right: -13px;
            padding: 1em;
            transition: .25s all ease;
            pointer-events: none;
        }
        /* Transition */
        .select:hover::after {
            color: #f39c12;
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
                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <div class="flex-shrink-0 ms-2">
                                                <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                                    role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link active" data-bs-toggle="tab" href="#Subject_tab"
                                                           role="tab" aria-selected="false" tabindex="-1">
                                                            Subjects
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>



                                        </div>


                                        <div class="card-body">


                                            <!-- Tab panes -->
                                            <div class="tab-content text-muted">
                                                <div class="tab-pane active show" id="Subject_tab" role="tabpanel">
                                                    <!--<div class="table-responsive table-card mt-3 mb-1">-->
                                                    <!--<input type="text">-->
                                                    <div style="padding: 0 32px;">
                                                        <div class="row mt-4">
                                                            <div class="col-7">
                                                                <div class="d-flex">



                                                                </div>


                                                            </div>
                                                            <div class="col-5">
                                                                <!--<input type="text" id="myInputTextField" class="form-control form-control-sm" placeholder="Search" aria-controls="employees">-->

                                                                <div class="dataTables_filter" style="margin-right: 24px;"><label><input id="myInputTextField" type="text" class="form-control form-control-sm" placeholder="Search" aria-controls="datatables-example"></label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <table id="employees" class="table table-striped" style="width:100%">
                                                        <thead>
                                                        <tr>

                                                            <th></th>
                                                            <th>subject name</th>

                                                            <th>Correct</th>
                                                            <th>Incorrect</th>
                                                            <th>Omitted</th>

                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>

                                            </div>
                                        </div><!-- end card-body -->
                                    </div>
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
        buttons: [
        ],
        // Display
        dom: '<"top"f><"data-table"rt<"bottom"Blip>>',
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

        // Data display
        colReorder: true,
        fixedHeader: true,
        ordering: true,
        paging: false,
        // pageLength: 10,
        // pagingType: 'full', // https://datatables.net/reference/option/pagingType
        responsive: true,
        searching: true,
        "info":     false,
        select: {
            style: 'multi+shift', // https://datatables.net/reference/option/select.style
            className: 'table-active' // https://datatables.net/reference/option/select.className
        },
        stateSave: true,
    })

    // $(function () {
    //     $('#datatables-example').DataTable({
    //         "columnDefs": [
    //             {"width": "2%", "targets": 0}
    //         ],
    //         "fnInitComplete": function (oSettings, json) {
    //             $('.dataTables_filter input').attr('type', 'text');
    //         },
    //     })
    //         .on('page.dt', function () {
    //             $('[data-toggle="tooltip"]').tooltip({placement: 'bottom'})
    //         })
    // })


</script>

<script>

    var data={!! $jsonData  !!}

    function format(d) {
    var specialitiesTable = '<table class="table mb-0 table-sub-rows">';

    d.specialities.forEach(function (speciality) {
        specialitiesTable += '<tr class="table-primary">' +
            '<td>' + speciality.name + '</td>' +
            '<td>' + speciality.correct + '</td>' +
            '<td>' + speciality.incorrect + '</td>' +
            '<td>' + speciality.omitted + '</td>' +
            '</tr>';
    });

    specialitiesTable += '</table>';

    return specialitiesTable;
    }


    //table for mocks analytics

    $(document).ready(function() {
        var table = $("#employees").DataTable({
            data: data,
            columns: [
                {
                    className: "details-control",
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                { data: "name" },
                { data: "correct" },
                { data: "incorrect" },
                { data: "omitted" },
                { data: "specialities", visible: false }
            ],
            order: [[1, "asc"]],
            "fnInitComplete": function (oSettings, json) {
                $('.dataTables_filter input').attr('type', 'text');
                $('#employees').DataTable().search( '' ).draw();
            }
        });

        $('#myInputTextField').keyup(function(){
            table.search($(this).val()).draw() ;
        });
        $("#employees tbody").on("click", "td.details-control", function() {
            var tr = $(this).closest("tr");
            var row = table.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass("shown");
            } else {
                row.child(format(row.data()), "p-0").show();
                tr.addClass("shown");
            }
        });
    });


</script>



@endsection
