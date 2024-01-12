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
        .editable{

            border: none;
        }

        .editable:active{
            border: none;
        }

        .editable:focus{
            border: none;
        }

        .editable[readonly]:focus-visible {
            border: none !important; /* Remove border when input is readonly */
            outline: none !important; /* Remove the default outline as well */

        }


    </style>

    <link href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.2/fc-3.3.1/r-2.2.6/rr-1.2.7/sl-1.3.1/datatables.css" rel="stylesheet" crossorigin>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" crossorigin>


    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/staterestore/1.2.2/css/stateRestore.dataTables.min.css">




    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100">


                            <!--////-->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                                <div class="table-responsive table-card mt-3 mb-1">
                                                    <!--<div class="table table-card mt-3 mb-1">-->
                                                    <table id="datatables-example2" class="table"></table>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


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



    var dataSet = @json($dataSet);


   $(function() {
        $('#datatables-example2').DataTable({
            data: dataSet,
            columns: [
                { title: 'Block ID' },
                { title: 'NAME' },
                { title: 'Per.%' },
                { title: 'DATE' },
                { title: 'Marked' },
                { title: 'Corrects' },
                { title: 'Incorrects' },
                { title: 'Omitted' },
                { title: 'Status' },
                { title: 'Mode' },
                { title: 'ACTIONS' }
            ],
            "columnDefs": [
                { "width": "14%", "targets": 6 }
            ],
            "fnInitComplete": function (oSettings, json) {
                $('.dataTables_filter input').attr('type', 'text');
            }
        }).on('page.dt', function () {
            $('[data-toggle="tooltip"]').tooltip({ placement: 'bottom' });
        });
    });
</script>






<script>
    $(document).ready(function() {
        $('.edit-icon').on('click', function() {
            var container = $(this).parent('.editable-container');
            var input = container.find('.editable');

            // Hide the edit icon
            $(this).hide();

            // Disable input
            input.prop('readonly', true);

            // Enable editing and focus on the input after a short delay
            setTimeout(function() {
                input.prop('readonly', false).focus();
            }, 100);
        });

        $('.editable').on('blur', function() {
            var container = $(this).closest('.editable-container');

            // Show the edit icon after saving
            container.find('.edit-icon').show();

            var testId = $(this).data('test-id');
            var value = $(this).val();

            $.ajax({
                url: '/update_qbank_user_test_name',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    test_id: testId,
                    value: value
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            // Make the input readonly again after saving
            $(this).prop('readonly', true);
        });
    });
</script>


<script>

    function deleteLocalStorage(){



        // Get all keys from local storage
         var keys = Object.keys(localStorage);

        // Iterate through the keys and remove each item
        for (var i = 0; i < keys.length; i++) {
            var key = keys[i];

            // Remove the item
            localStorage.removeItem(key);

            console.log("Removed: " + key);
        }
    }
</script>






@endsection
