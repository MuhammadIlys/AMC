<footer>


    <!-- Import Js Files -->
    <script src="{{ asset('super_admin_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core files -->
    <script src="{{ asset('super_admin_assets/js/app.min.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/app.init.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/custom.js') }}"></script>

    <!-- Current page js files -->
    <script src="{{ asset('super_admin_assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/apex.pie.init.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/datatable-basic.init.js') }}"></script>
    <script src="{{ asset('super_admin_assets/js/summernote-lite.min.js') }}"></script>

    <!-- Summernote initialization script -->
    <script>
        /************************************/
        //default editor
        /************************************/
        $(".summernote").summernote({
            height: 200, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false, // set focus to editable area after initializing summernote
        });

        $(".summernote2").summernote({
            height: 60, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false, // set focus to editable area after initializing summernote
        });

        /************************************/
        //inline-editor
        /************************************/
        $(".inline-editor").summernote({
            airMode: true,
        });

        /************************************/
        //edit and save mode
        /************************************/
        (window.edit = function () {
            $(".click2edit").summernote();
        }),
            (window.save = function () {
                $(".click2edit").summernote("destroy");
            });

        var edit = function () {
            $(".click2edit").summernote({ focus: true });
        };

        var save = function () {
            var markup = $(".click2edit").summernote("code");
            $(".click2edit").summernote("destroy");
        };

        /************************************/
        //airmode editor
        /************************************/
        $(".airmode-summer").summernote({
            airMode: true,
        });
    </script>
</footer>
