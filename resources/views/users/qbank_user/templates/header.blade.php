<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8">
    <title>AceamcQ QBank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description">
    <meta content="" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('user/mock_user_assets/assets/images/favicon.ico') }}">

    <!-- jsvectormap css -->
    <link href="{{ asset('user/mock_user_assets/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">

    <!--Swiper slider css-->
    <link href="{{ asset('user/mock_user_assets/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Layout config Js -->
    <script src="{{ asset('user/mock_user_assets/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('user/mock_user_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('user/mock_user_assets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('user/mock_user_assets/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <!-- custom Css-->
    <link href="{{ asset('user/mock_user_assets/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('user/mock_user_assets/assets/css/style.css') }}" rel="stylesheet" type="text/css">


    <style>
        /*! CSS Used from: https://uworld.coworkcodesign.com/Themes/themeone/assets/css/bootstrap.min.css */
        input{margin:0;font:inherit;color:inherit;}
        input{line-height:normal;}
        input[type=checkbox],input[type=radio]{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:0;}
        @media print{
            *,:after,:before{color:#000!important;text-shadow:none!important;background:0 0!important;-webkit-box-shadow:none!important;box-shadow:none!important;}
        }
        *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
        :after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
        input{font-family:inherit;font-size:inherit;line-height:inherit;}
        ul{margin-top:0;margin-bottom:10px;}
        .row{margin-right:-15px;margin-left:-15px;}
        .col-lg-12,.col-md-2,.col-md-5,.col-md-6,.col-sm-12{position:relative;min-height:1px;padding-right:15px;padding-left:15px;}
        @media (min-width:768px){
            .col-sm-12{float:left;}
            .col-sm-12{width:100%;}
        }
        @media (min-width:992px){
            .col-md-2,.col-md-5,.col-md-6{float:left;}
            .col-md-6{width:50%;}
            .col-md-5{width:41.66666667%;}
            .col-md-2{width:16.66666667%;}
            .col-md-offset-1{margin-left:8.33333333%;}
        }
        @media (min-width:1200px){
            .col-lg-12{float:left;}
            .col-lg-12{width:100%;}
        }
        label{display:inline-block;max-width:100%;margin-bottom:5px;font-weight:700;}
        input[type=checkbox],input[type=radio]{margin:4px 0 0;margin-top:1px\9;line-height:normal;}
        input[type=checkbox]:focus,input[type=radio]:focus{outline:5px auto -webkit-focus-ring-color;outline-offset:-2px;}
        .form-control{display:block;width:100%;height:34px;padding:6px 12px;font-size:14px;line-height:1.42857143;color:#555;background-color:#fff;background-image:none;border:1px solid #ccc;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;}
        .form-control:focus{border-color:#66afe9;outline:0;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);}
        .form-group{margin-bottom:15px;}
        .checkbox-inline input[type=checkbox]{position:absolute;margin-top:4px\9;margin-left:-20px;}
        .checkbox-inline{position:relative;display:inline-block;padding-left:20px;margin-bottom:0;font-weight:400;vertical-align:middle;cursor:pointer;}
        .btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent;border-radius:4px;}
        .btn.active:focus,.btn:active:focus,.btn:focus{outline:5px auto -webkit-focus-ring-color;outline-offset:-2px;}
        .btn:focus,.btn:hover{color:#333;text-decoration:none;}
        .btn.active,.btn:active{background-image:none;outline:0;-webkit-box-shadow:inset 0 3px 5px rgba(0,0,0,.125);box-shadow:inset 0 3px 5px rgba(0,0,0,.125);}
        .btn-default{color:#333;background-color:#fff;border-color:#ccc;}
        .btn-default:focus{color:#333;background-color:#e6e6e6;border-color:#8c8c8c;}
        .btn-default:hover{color:#333;background-color:#e6e6e6;border-color:#adadad;}
        .btn-default.active,.btn-default:active{color:#333;background-color:#e6e6e6;border-color:#adadad;}
        .btn-default.active:focus,.btn-default.active:hover,.btn-default:active:focus,.btn-default:active:hover{color:#333;background-color:#d4d4d4;border-color:#8c8c8c;}
        .btn-default.active,.btn-default:active{background-image:none;}
        .btn-success{color:#fff;background-color:#5cb85c;border-color:#4cae4c;}
        .btn-success:focus{color:#fff;background-color:#449d44;border-color:#255625;}
        .btn-success:hover{color:#fff;background-color:#449d44;border-color:#398439;}
        .btn-success:active{color:#fff;background-color:#449d44;border-color:#398439;}
        .btn-success:active:focus,.btn-success:active:hover{color:#fff;background-color:#398439;border-color:#255625;}
        .btn-success:active{background-image:none;}
        .panel{margin-bottom:20px;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05);}
        .panel-body{padding:15px;}
        .panel-heading{padding:10px 15px;border-bottom:1px solid transparent;border-top-left-radius:3px;border-top-right-radius:3px;}
        .panel-body:after,.panel-body:before,.row:after,.row:before{display:table;content:" ";}
        .panel-body:after,.row:after{clear:both;}
        .hide{display:none!important;}
        /*! CSS Used from: https://uworld.coworkcodesign.com/Themes/themeone/assets/css/sb-admin.css */
        /*! @import https://uworld.coworkcodesign.com/Themes/themeone/assets/css/checkbox.css */
        .checkbox-inline .toggle{margin-left:-20px;margin-right:5px;}
        .toggle{position:relative;overflow:hidden;}
        .toggle input[type=checkbox]{display:none;}
        .toggle-group{position:absolute;width:200%;top:0;bottom:0;left:0;transition:left .35s;-webkit-transition:left .35s;-moz-user-select:none;-webkit-user-select:none;}
        .toggle.off .toggle-group{left:-100%;}
        .toggle-on{position:absolute;top:0;bottom:0;left:0;right:50%;margin:0;border:0;border-radius:0;}
        .toggle-off{position:absolute;top:0;bottom:0;left:50%;right:0;margin:0;border:0;border-radius:0;}
        .toggle-handle{position:relative;margin:0 auto;padding-top:0;padding-bottom:0;height:100%;width:0;border-width:0 1px;}
        .toggle.btn{min-width:59px;min-height:34px;}
        .toggle-on.btn{padding-right:24px;}
        .toggle-off.btn{padding-left:24px;}
        .toggle.btn{height:26px!important;min-width:54px;border-radius:50px;min-height:30px;border:2px solid #f6f7fa;}
        .toggle-group .btn,.toggle-group .btn:hover{color:transparent;}
        .btn .toggle-handle{border-radius:100%;border-width:0px;height:22px;left:26px;margin:0 auto;padding:0;position:absolute;top:2px;width:22px;}
        .btn.off .toggle-handle{border-radius:100%;border-width:0px;height:22px;left:52px;margin:0 auto;padding:0;position:absolute;top:2px;width:22px;}
        input[type="radio"],input[type="checkbox"]{display:none;}
        input[type="radio"] + label,input[type="checkbox"] + label{line-height:28px;cursor:pointer;position:relative;}
        /*! end @import */
        .btn{border-radius:2px;border:none;}
        .btn-success{background-color:#97d881;}
        .btn-success:hover{background-color:#7ac063;}
        .btn-default{color:#515b6a;}
        .checkbox-inline{margin:0 0 20px;}
        label{color:#353f4d;font-weight:normal;margin-bottom:8px;}
        .form-group{margin-bottom:30px;}
        .form-control{border-color:#e1e8f8;border-radius:0;box-shadow:none;font-size:13px;min-height:44px;padding-left:12px;color:#353f4d;}
        .panel-custom{box-shadow:none;border:none;border-radius:5px;box-shadow:0 0 15px #e5e5e5;padding:0;border-radius:5px!important;background-color:#ffffff;box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.05);border:0;}
        .panel-custom .panel-heading{color:#666666;line-height:40px;text-transform:uppercase;font-weight:bold;color:#333333;font-size:1.125rem;font-weight:400;background:inherit;border:0;color:#333333;font-size:16px;font-weight:700;text-transform:uppercase;padding:1rem 2.5rem;margin-bottom:0;border-bottom:1px solid #f2f2f2;}
        .form-control:focus{border-color:#438afe;box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(68, 161, 239, 0.6);outline:0 none;}
        .panel-custom .panel-body{padding:2.5rem;}
        .form-control{background:rgba(232, 228, 228, 0.10196078431372549)!important;border-radius:3px;}
        @media (max-width:1200px){
            .panel-custom .panel-body{padding:30px;}
        }
        @media (max-width:768px){
            .panel-custom .panel-body{padding:10px;}
        }
        /*! CSS Used from: https://uworld.coworkcodesign.com/Themes/themeone/assets/font-awesome/css/font-awesome.min.css */
        .fa{display:inline-block;font:normal normal normal 14px/1 FontAwesome;font-size:inherit;text-rendering:auto;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;}
        .fa-plus:before{content:"\f067";}
        .fa-angle-up:before{content:"\f106";}
        /*! CSS Used from: Embedded */
        [type="radio"]:checked,[type="radio"]:not(:checked){position:absolute;left:-9999px;}
        [type="radio"]:checked + label,[type="radio"]:not(:checked) + label{margin-right:20px;position:relative;padding-left:28px;cursor:pointer;line-height:20px;display:inline-block;color:#666;}
        [type="radio"]:checked + label:before,[type="radio"]:not(:checked) + label:before{content:'';position:absolute;left:0;top:0;width:20px;height:20px;border:1px solid #ddd;border-radius:100%;background:#fff;}
        [type="radio"]:checked + label:after,[type="radio"]:not(:checked) + label:after{content:'';width:12px;height:12px;background:#F87DA9;position:absolute;top:4px;left:4px;border-radius:100%;-webkit-transition:all 0.2s ease;transition:all 0.2s ease;}
        [type="radio"]:not(:checked) + label:after{opacity:0;-webkit-transform:scale(0);transform:scale(0);}
        [type="radio"]:checked + label:after{opacity:1;-webkit-transform:scale(1);transform:scale(1);}
        .span_coutner{display:inline-block;margin-left:auto;height:22px;line-height:21px;padding:0 7px;border-radius:11px;text-align:center;font-size:12px;font-weight:600;border:1px solid #b2b2b2;color:#2196f3;}
        /*! CSS Used from: Embedded */
        .subject_area{padding:0px 30px 0px 30px;}
        .form-group{display:block;margin-bottom:15px;}
        .form-group input{padding:0;height:initial;width:initial;margin-bottom:0;display:none;cursor:pointer;}
        .form-group label{position:relative;cursor:pointer;}
        .form-group label:before{content:'';-webkit-appearance:none;background-color:transparent;border:2px solid #0079bf;box-shadow:0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);padding:10px;display:inline-block;position:relative;vertical-align:middle;cursor:pointer;margin-right:5px;}
        .form-group input:checked + label:after{content:'';display:block;position:absolute;top:6px;left:9px;width:6px;height:14px;border:solid #0079bf;border-width:0 2px 2px 0;transform:rotate(45deg);}
        /*! CSS Used from: Embedded */
        input[type=number]{-moz-appearance:textfield;}
    </style>

<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding-top: 50px;
    }

    .test-card {
      border: 1px solid #ccc;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    .test-card h3 {
      margin-bottom: 10px;
      color: #333;
    }

    .test-card p {
      color: #555;
      margin-bottom: 15px;
    }

    .test-card .info {
      font-size: 14px;
      color: #888;
      margin-bottom: 15px;
    }

    .launch-button {
      width: 100%;
      background-color: #007BFF;
      color: #fff;
      border: none;
    }

    .launch-button:hover {
      background-color: #0056b3;
    }

    .test-card:hover {
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .btn-success {

    background-color: #013884;

    }

    .btn-success:hover {

background-color: #013884;

}
  </style>


<!-- Bootstrap JS (Popper.js and Bootstrap JS) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<!-- Choose one version of jQuery and include it -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap Toggle JS - Include it after jQuery -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</head>

<body>

<!-- Begin page -->
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">

                        <a href="{{ url('/user_dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="https://aceamcq.com/wp-content/uploads/2023/08/image-1.png" alt="" height="22">
                        </span>
                            <span class="logo-lg">
                            <img src="https://aceamcq.com/wp-content/uploads/2023/08/image-1.png" alt="" height="17">
                        </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm fs-16 header-item-icon vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                          <!--<i class="la la-bars text-white"></i>-->
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>

                    </button>
                    &nbsp;&nbsp;&nbsp;
                    <!-- App Search-->
                    <div class="app-search">
                        <div class="position-relative">

                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center">

                    <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ asset('user/mock_user_assets/assets/images/users/avatar-1.jpg') }}" alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{Session::get('user')->first_name }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ url('/user_dashboard') }}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Main Profile</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ url('/') }}/user_logout"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>



                </div>


            </div>
        </div>
    </header>

    <!-- ========== App Menu ========== -->
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">

            <!-- Light Logo-->
            <a href="{{ url('/user_dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="https://aceamcq.com/wp-content/uploads/2023/08/image-1.png" alt="" height="22">
                    </span>
                <span class="logo-lg">
                        <img src="https://aceamcq.com/wp-content/uploads/2023/08/image-1.png" alt="" class="sidebar-logo mb-3">
                    </span>
            </a>

            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div id="scrollbar" class="side-scrollbar" style="background-color: #09408b">
            <div class="container-fluid">

                <div id="two-column-menu">
                </div>
                <ul class="navbar-nav" id="navbar-nav">


                    <!--<li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Components</span></li>-->


                    <li class="nav-item mt-3">
                        <a class="nav-link menu-link" href="{{ url('/lunch_user_qbank_dashboard') }}">
                            <i class='la la-md la-home icon-margin fs-18'></i> <span data-key="t-widgets">Welcome</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a  class="nav-link menu-link" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" href="#">
                            <i class='la la-book fs-18  '></i> <span data-key="t-widgets">Choose Qbank</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('/lunch_user_qbank_create_test') }}">
                            <i class='la la-edit fs-18'></i> <span data-key="t-widgets">Create Test</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('/lunch_user_qbank_previous_test') }}">
                            <i class='la la-list-alt fs-18'></i> <span data-key="t-widgets">Previous Tests</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                            <i class="la la-chart-bar fs-18"></i> <span data-key="t-landing">Performance</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarLanding">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ url('/lunch_user_qbank_dashboard') }}" class="nav-link" data-key="t-one-page"> <i class="la la-clipboard-check fs-18"></i> Overall </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/lunch_user_qbank_test_reports') }}" class="nav-link" data-key="t-one-page"> <i class="la la-chart-pie fs-18"></i> Reports </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/lunch_user_qbank_test_graphs') }}" class="nav-link" data-key="t-one-page"> <i class="la la-chart-line fs-18"></i> Graphs </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('/lunch_user_qbank_search') }}">
                            <i class="ri-search-line fs-18"></i> <span data-key="t-widgets">Search</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link active" href="{{ url('/lunch_user_qbank_notes') }}">
                            <i class="la la-file-alt fs-18"></i> <span data-key="t-widgets">Notes</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('/lunch_user_qbank_test_account_reset') }}">
                            <i class="la la-undo fs-18"></i> <span data-key="t-widgets">Reset Options</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('/lunch_user_qbank_test_help') }}">
                            <i class='la la-question-circle fs-18'></i> <span data-key="t-widgets">Help</span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- Sidebar -->
        </div>

        <div class="offcanvas-footer p-3 text-center">
            <div class="row">
                <div class="col-12">
                    <h5 class="text-white" style="margin: unset; color:#fff !important">Expiration Date </h5>
                    <p class="text-muted" style="color: #fff !important">@if(session()->has('mocks_expiry_timestamp'))
                        {{ session('mocks_expiry_timestamp') }}
                    @else

                    @endif EDT</p>
                </div>
            </div>
        </div>

        <div class="sidebar-background"></div>
    </div>
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>




    <div class="modal fade bs-example-modal-center" aria-labelledby="mySmallModalLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center ">

                    <div class="row" style=" ">

                        <h6>  <strong> Activate QBank</strong></h6> <br>


                        <div class="col-md-6">
                            <label class="checkbox-inline">
                              <input id="qbank1" type="checkbox" data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="default"   checked>
                               Qbank 1
                            </label>
                          </div>

                          <div class="col-md-6">
                            <label class="checkbox-inline">
                              <input id="qbank2" type="checkbox" data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="default" >
                              Qbank 2
                            </label>
                          </div>

                    </div>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


<script>
    $(document).ready(function(){

         // Toggle for Tutor button
      $('#qbank1').change(function() {
        if ($(this).prop('checked')) {
          // Turn off the Timed button
          $('#qbank2').bootstrapToggle('off');

          alert('qbank2 off');


        }



      });

      // Toggle for Timed button
      $('#qbank2').change(function() {
        if ($(this).prop('checked')) {
          // Turn off the Tutor button
          $('#qbank1').bootstrapToggle('off');

          alert('qbank1 off');
        }




    });

});


</script>

