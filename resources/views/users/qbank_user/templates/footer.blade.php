
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script>
                © Alright Reserved.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    AceAmcQ
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
<i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
<div id="status">
<div class="spinner-border text-primary avatar-sm" role="status">
    <span class="visually-hidden">Loading...</span>
</div>
</div>
</div>



<!-- JAVASCRIPT -->
<script src="{{ asset('user/mock_user_assets/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('user/mock_user_assets/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('user/mock_user_assets/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('user/mock_user_assets/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('user/mock_user_assets/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('user/mock_user_assets/assets/js/plugins.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('user/mock_user_assets/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('user/mock_user_assets/assets/js/pages/apexcharts-scatter.init.js') }}"></script>
<!-- Vector map-->
<script src="{{ asset('user/mock_user_assets/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('user/mock_user_assets/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

<!--Swiper slider js-->
<script src="{{ asset('user/mock_user_assets/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

<!-- Dashboard init -->
<script src="{{ asset('user/mock_user_assets/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('user/mock_user_assets/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- CRM js -->
<script src="{{ asset('user/mock_user_assets/assets/js/pages/dashboard-crypto.init.js') }}"></script>
<!-- CRM js -->
<script src="{{ asset('user/mock_user_assets/assets/js/pages/qbank-crypto.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('user/mock_user_assets/assets/js/app.js') }}"></script>





<div id="qbank_setup_model" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="row">
                    <h6><strong>Activate QBank</strong></h6> <br>

                    <div class="col-md-6">
                        <label class="checkbox-inline">
                            <input id="qbank1" type="checkbox" data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="default" {{ session('qbank_id') == 1 ? 'checked' : '' }}>
                            Qbank 1
                        </label>
                    </div>

                    <div class="col-md-6">
                        <label class="checkbox-inline">
                            <input id="qbank2" type="checkbox" data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="default" {{ session('qbank_id') == 3 ? 'checked' : '' }}>
                            Qbank 2
                        </label>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="myToast" class="toast toast-border-success fade " role="alert" aria-live="assertive" aria-atomic="true" data-bs-toggle="toast" style="position: fixed; bottom: 16px; right: 16px; z-index: 999;" data-bs-delay="3000">

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



<script>


$(document).ready(function(){



    $('#show_qbank_model_btn').click(function(){


        $('#qbank_setup_model').modal('show');
    });





     // Toggle for Tutor button
  $('#qbank1').change(function() {
    if ($(this).prop('checked')) {
      // Turn off the Timed button
      $('#qbank2').bootstrapToggle('off');

      qbanksession(1);

    }



  });

  // Toggle for Timed button
  $('#qbank2').change(function() {
    if ($(this).prop('checked')) {
      // Turn off the Tutor button
      $('#qbank1').bootstrapToggle('off');

       qbanksession(3);
    }

});


function qbanksession(id){

    $.ajax({

        url: '/qbank_setup',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            qbank_id:id,

        },
        success: function(response) {


            $('#qbank_setup_model').modal('hide');
            // Ensure modal backdrop is removed
            $('.modal-backdrop').remove();

            if(id===1){

                $('#myToast .toast-body h6').text('QBank 1 is Active!');

            }else{
                $('#myToast .toast-body h6').text('QBank 2 is Active!');

            }


            $('#myToast').toast('show');

            // Hide the toast after 3 seconds
            setTimeout(function(){
                $('#myToast').toast('hide');
            }, 5000);

            window.location.reload();

        },
        error: function(jqXHR, textStatus, errorThrown) {
        // Callback function for errors
        console.error('Request failed: ' + textStatus, errorThrown);
        }
    });


}

});


</script>






</body>

</html>
