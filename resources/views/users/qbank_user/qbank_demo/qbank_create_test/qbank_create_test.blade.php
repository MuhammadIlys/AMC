@extends('users.qbank_user.templates.main')
@section('main-container')


 <!-- Bootstrap Toggle CSS -->
 <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"  />




<link href="{{ url('/user/mock_user_assets/assets/css/font-awesome.min.css') }}" rel="stylesheet">



<style>
    input[type="checkbox"]:disabled + label::before {
        color: gray !important;
        border: 1px solid #d4d4d5 !important;
    }

    input[type="checkbox"]:disabled + label:hover::before {
        color: gray !important;
        border: 1px solid #d4d4d5 !important;
    }

</style>
<style>
    /*! CSS Used from: https://uworld.coworkcodesign.com/Themes/themeone/assets/css/bootstrap.min.css */
    input {
        margin: 0;
        font: inherit;
        color: inherit;
    }

    input {
        line-height: normal;
    }

    input[type=checkbox], input[type=radio] {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 0;
    }

    @media  print {
        *, :after, :before {
            color: #000 !important;
            text-shadow: none !important;
            background: 0 0 !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
        }
    }

    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    :after, :before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    input {
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
    }

    ul {
        margin-top: 0;
        margin-bottom: 10px;
    }

    .row {
        margin-right: -15px;
        margin-left: -15px;
    }

    .col-lg-12, .col-md-2, .col-md-5, .col-md-6, .col-sm-12 {
        position: relative;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }

    @media (min-width: 768px) {
        .col-sm-12 {
            float: left;
        }

        .col-sm-12 {
            width: 100%;
        }
    }

    @media (min-width: 992px) {
        .col-md-2, .col-md-5, .col-md-6 {
            float: left;
        }

        .col-md-6 {
            width: 50%;
        }

        .col-md-5 {
            width: 41.66666667%;
        }

        .col-md-2 {
            width: 16.66666667%;
        }

        .col-md-offset-1 {
            margin-left: 8.33333333%;
        }
    }

    @media (min-width: 1200px) {
        .col-lg-12 {
            float: left;
        }

        .col-lg-12 {
            width: 100%;
        }
    }

    label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 700;
    }

    input[type=checkbox], input[type=radio] {
        margin: 4px 0 0;
        margin-top: 1px \9;
        line-height: normal;
    }

    input[type=checkbox]:focus, input[type=radio]:focus {
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    }

    .form-control:focus {
        border-color: #66afe9;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .checkbox-inline input[type=checkbox] {
        position: absolute;
        margin-top: 4px \9;
        margin-left: -20px;
    }

    .checkbox-inline {
        position: relative;
        display: inline-block;
        padding-left: 20px;
        margin-bottom: 0;
        font-weight: 400;
        vertical-align: middle;
        cursor: pointer;
    }

    .btn {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .btn.active:focus, .btn:active:focus, .btn:focus {
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .btn:focus, .btn:hover {
        color: #333;
        text-decoration: none;
    }

    .btn.active, .btn:active {
        background-image: none;
        outline: 0;
        -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
        box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
    }

    .btn-default {
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }

    .btn-default:focus {
        color: #333;
        background-color: #e6e6e6;
        border-color: #8c8c8c;
    }

    .btn-default:hover {
        color: #333;
        background-color: #e6e6e6;
        border-color: #adadad;
    }

    .btn-default.active, .btn-default:active {
        color: #333;
        background-color: #e6e6e6;
        border-color: #adadad;
    }

    .btn-default.active:focus, .btn-default.active:hover, .btn-default:active:focus, .btn-default:active:hover {
        color: #333;
        background-color: #d4d4d4;
        border-color: #8c8c8c;
    }

    .btn-default.active, .btn-default:active {
        background-image: none;
    }

    .btn-success {
        color: #fff;
        background-color: #013884;
        border-color: #013884;
    }







    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .panel-body {
        padding: 15px;
    }

    .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    .panel-body:after, .panel-body:before, .row:after, .row:before {
        display: table;
        content: " ";
    }

    .panel-body:after, .row:after {
        clear: both;
    }

    .hide {
        display: none !important;
    }

    /*! CSS Used from: https://uworld.coworkcodesign.com/Themes/themeone/assets/css/sb-admin.css */
    /*! @import  https://uworld.coworkcodesign.com/Themes/themeone/assets/css/checkbox.css */
    .checkbox-inline .toggle {
        margin-left: -20px;
        margin-right: 5px;
    }

    .toggle {
        position: relative;
        overflow: hidden;
    }

    .toggle input[type=checkbox] {
        display: none;
    }

    .toggle-group {
        position: absolute;
        width: 200%;
        top: 0;
        bottom: 0;
        left: 0;
        transition: left .35s;
        -webkit-transition: left .35s;
        -moz-user-select: none;
        -webkit-user-select: none;
    }

    .toggle.off .toggle-group {
        left: -100%;
    }

    .toggle-on {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 50%;
        margin: 0;
        border: 0;
        border-radius: 0;
    }

    .toggle-off {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        right: 0;
        margin: 0;
        border: 0;
        border-radius: 0;
    }

    .toggle-handle {
        position: relative;
        margin: 0 auto;
        padding-top: 0;
        padding-bottom: 0;
        height: 100%;
        width: 0;
        border-width: 0 1px;
    }

    .toggle.btn {
        min-width: 59px;
        min-height: 34px;
    }

    .toggle-on.btn {
        padding-right: 24px;
    }

    .toggle-off.btn {
        padding-left: 24px;
    }

    .toggle.btn {
        height: 26px !important;
        min-width: 54px;
        border-radius: 50px;
        min-height: 30px;
        border: 2px solid #f6f7fa;
    }

    .toggle-group .btn, .toggle-group .btn:hover {
        color: transparent;
    }

    .btn .toggle-handle {
        border-radius: 100%;
        border-width: 0px;
        height: 22px;
        left: 26px;
        margin: 0 auto;
        padding: 0;
        position: absolute;
        top: 2px;
        width: 22px;
    }

    .btn.off .toggle-handle {
        border-radius: 100%;
        border-width: 0px;
        height: 22px;
        left: 52px;
        margin: 0 auto;
        padding: 0;
        position: absolute;
        top: 2px;
        width: 22px;
    }

    input[type="radio"], input[type="checkbox"] {
        display: none;
    }

    input[type="radio"] + label, input[type="checkbox"] + label {
        line-height: 28px;
        cursor: pointer;
        position: relative;
    }

    /*! end @import  */
    .btn {
        border-radius: 2px;
        border: none;
    }

    .btn-success {
        background-color: #013884;
    }

    .btn-success:hover {
        background-color: #013884;
    }

    .btn-success:focus{
        background-color: #013884;
    }

    .btn-success:active:focus{
        background-color: #013884;
    }

    .btn-default {
        color: #515b6a;
    }

    .checkbox-inline {
        margin: 0 0 20px;
    }

    label {
        color: #353f4d;
        font-weight: normal;
        margin-bottom: 8px;
    }

    .form-group {
        margin-bottom: 30px;
    }

    .form-control {
        border-color: #e1e8f8;
        border-radius: 0;
        box-shadow: none;
        font-size: 13px;
        min-height: 44px;
        padding-left: 12px;
        color: #353f4d;
    }

    .panel-custom {
        box-shadow: none;
        border: none;
        border-radius: 5px;
        box-shadow: 0 0 15px #e5e5e5;
        padding: 0;
        border-radius: 5px !important;
        background-color: #ffffff;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.05);
        border: 0;
    }

    .panel-custom .panel-heading {
        color: #666666;
        line-height: 40px;
        text-transform: uppercase;
        font-weight: bold;
        color: #333333;
        font-size: 1.125rem;
        font-weight: 400;
        background: inherit;
        border: 0;
        color: #333333;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 1rem 2.5rem;
        margin-bottom: 0;
        border-bottom: 1px solid #f2f2f2;
    }

    .form-control:focus {
        border-color: #438afe;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(68, 161, 239, 0.6);
        outline: 0 none;
    }

    .panel-custom .panel-body {
        padding: 2.5rem;
    }

    .form-control {
        background: rgba(232, 228, 228, 0.10196078431372549) !important;
        border-radius: 3px;
    }

    @media (max-width: 1200px) {
        .panel-custom .panel-body {
            padding: 30px;
        }
    }

    @media (max-width: 768px) {
        .panel-custom .panel-body {
            padding: 10px;
        }
    }

    /*! CSS Used from: https://uworld.coworkcodesign.com/Themes/themeone/assets/font-awesome/css/font-awesome.min.css */
    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .fa-plus:before {
        content: "\f067";
    }

    .fa-angle-up:before {
        content: "\f106";
    }

    /*! CSS Used from: Embedded */
    [type="radio"]:checked, [type="radio"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }

    [type="radio"]:checked + label, [type="radio"]:not(:checked) + label {
        margin-right: 20px;
        position: relative;
        padding-left: 28px;
        cursor: pointer;
        line-height: 20px;
        display: inline-block;
        color: #666;
    }

    [type="radio"]:checked + label:before, [type="radio"]:not(:checked) + label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 20px;
        height: 20px;
        border: 1px solid #ddd;
        border-radius: 100%;
        background: #fff;
    }

    [type="radio"]:checked + label:after, [type="radio"]:not(:checked) + label:after {
        content: '';
        width: 12px;
        height: 12px;
        background: #013884;
        position: absolute;
        top: 4px;
        left: 4px;
        border-radius: 100%;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }

    [type="radio"]:not(:checked) + label:after {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }

    [type="radio"]:checked + label:after {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1);
    }

    .span_coutner {
        display: inline-block;
        margin-left: auto;
        height: 22px;
        line-height: 21px;
        padding: 0 7px;
        border-radius: 11px;
        text-align: center;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid #b2b2b2;
        color: #013884;
    }

    /*! CSS Used from: Embedded */
    .subject_area {
        padding: 0px 30px 0px 30px;
    }

    .form-group {
        display: block;
        margin-bottom: 15px;
    }

    .form-group input {
        padding: 0;
        height: initial;
        width: initial;
        margin-bottom: 0;
        display: none;
        cursor: pointer;
    }

    .form-group label {
        position: relative;
        cursor: pointer;
    }

    .form-group label:before {
        content: '';
        -webkit-appearance: none;
        background-color: transparent;
        border: 2px solid #013884;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
        padding: 7px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        margin-right: 5px;
    }

    .form-group input:checked + label:after {
        content: '';
        display: block;
        position: absolute;
        top: 7px;
        left: 7px;
        width: 6px;
        height: 12px;
        border: solid #013884;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    /*! CSS Used from: Embedded */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<style>
    /* Your existing styles */

    .center-on-mobile {
        display: flex;
        float: right;
      }

    @media (max-width: 767px) {
      /* Styles for screens smaller than 768px (mobile) */

      .center-on-mobile {

        margin-top: 30px;
        margin-left: 50px;
        float: unset;
      }

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



                                    <div class="panel-heading">
                                       <div class="form-group" style="margin-bottom: 6px;">
                                        <strong>Test Mode</strong>
                                          <span style="float: right; cursor: pointer" class="accordion_1"><i class="accordion_1_icon fa fa-angle-up" style="font-size: 20px;"></i></span>
                                       </div>
                                       <hr>
                                    </div>
                                    <div class="panel-body pb_1" style="">
                                        <div class="accordion_1_body">
                                            <div class="row">


                                                <div class="col-md-3">
                                                    <label class="checkbox-inline">
                                                      <input id="toggleTutor" type="checkbox" data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="default" checked>
                                                       Tutor
                                                    </label>
                                                  </div>

                                                  <div class="col-md-3">
                                                    <label class="checkbox-inline">
                                                      <input id="toggleTimed" type="checkbox" data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="default" >
                                                      Timed
                                                    </label>
                                                  </div>

                                            </div>
                                        </div>
                                    </div>





                                    <div class="panel-heading">
                                        <div class="form-group" style="margin-bottom: 6px;">
                                           <strong>Question Mode</strong>
                                           <span style="float: right; cursor: pointer" class="accordion_2"><i class="accordion_2_icon fa fa-angle-up" style="font-size: 20px;"></i></span>
                                        </div>
                                        <hr>
                                     </div>
                                     <div class="panel-body pb_2">
                                        <div class="accordion_2_body">
                                           <div class="">

                                              <input type="radio" id="test1" name="radio-group" checked>
                                              <label for="test1">All <span class="span_coutner">122</span></label>
                                              <input type="radio" id="test2" name="radio-group" >
                                              <label for="test2">Correct <span class="span_coutner">0</span></label>
                                              <input type="radio" id="test3" name="radio-group">
                                              <label for="test3">Incorrect <span class="span_coutner">0</span></label>
                                              <input type="radio" id="test4" name="radio-group">
                                              <label for="test4">Omitted <span class="span_coutner">0</span></label>
                                              <input type="radio" id="test5" name="radio-group">
                                              <label for="test5">Marked <span class="span_coutner">0</span></label>
                                              <input type="radio" id="test6" name="radio-group">
                                              <label for="test6">Used <span class="span_coutner">0</span></label>
                                              <input type="radio" id="test7" name="radio-group">
                                              <label for="test7">Unused <span class="span_coutner">0</span></label>


                                            </div>
                                        </div>
                                     </div>



                                     <div class="panel-heading">
                                        <div class="form-group" style="margin-bottom: 6px;">
                                           <input type="checkbox" id="subjects">
                                           <label for="subjects"> <strong>Subjects</strong></label>
                                           <span style="float: right; cursor: pointer" class="accordion_3"><i class="accordion_3_icon fa fa-angle-up" style="font-size: 20px;"></i></span>
                                        </div>
                                        <hr>
                                     </div>


                                    <div class="panel-body pb_3">
                                            <div class="accordion_3_body">
                                                <div class="subject_area">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-lg-4 col-12">
                                                            <div class="form-group">
                                                                <input type="checkbox" id="html" checked="">
                                                                <label for="html">HTML <span class="span_coutner">12</span></label>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="checkbox" id="css">
                                                                <label for="css">CSS <span class="span_coutner">0</span></label>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="checkbox" id="javascript">
                                                                <label for="javascript">Javascript <span class="span_coutner">0</span></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 col-sm-4 col-lg-4 col-12">
                                                            <div class="form-group">
                                                                <input type="checkbox" id="html1">
                                                                <label for="html1">HTML1 <span class="span_coutner">0</span></label>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="checkbox" id="css1" checked="">
                                                                <label for="css1">CSS1 <span class="span_coutner">0</span></label>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="checkbox" id="javascript1">
                                                                <label for="javascript1">Javascript1 <span class="span_coutner">0</span></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 col-sm-4 col-lg-4 col-12">
                                                            <div class="form-group">
                                                                <input type="checkbox" id="html2">
                                                                <label for="html2">HTML2 <span class="span_coutner">0</span></label>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="checkbox" id="css2" checked="">
                                                                <label for="css2">CSS2 <span class="span_coutner">0</span></label>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="checkbox" id="javascript2">
                                                                <label for="javascript2">Javascript2 <span class="span_coutner">0</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="panel-heading">
                                        <div class="form-group" style="margin-bottom: 6px;">
                                            <strong>No. of Questions</strong>
                                            <span style="float: right; cursor: pointer" class="accordion_4"><i class="accordion_4_icon fa fa-angle-up" style="font-size: 20px;"></i></span>
                                            <hr>
                                        </div>
                                        </div>
                                        <div class="panel-body pb_4">
                                        <div class="accordion_4_body">
                                            <div class="subject_area">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-lg-6 col-12">
                                                        <div style="display: flex;">
                                                            <input type="number" class="form-control" name="name" value="0" id="name" style="width: 50px; text-align: center; min-height: 35px;" min="0" max="15" onkeyup="enforceMinMax(this)">
                                                            <span style="margin: 7px 10px;"> Max allowed per block 50
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-lg-6 col-12 ">
                                                        <div class="center-on-mobile">
                                                            <button id=""   class="btn btn-lg btn-success button" style="margin: unset;">Generate Test</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        </div>















                            </div>


                        </div>
                        <!-- end card-->
                    </div>
                        <!-- end .h-100-->

                </div> <!--end col-->

            </div> <!--end row-->

        </div>

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->



<!-- Bootstrap JS (Popper.js and Bootstrap JS) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap Toggle JS -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>



<script>
    $(document).ready(function(){
      // Toggle for Tutor button
      $('#toggleTutor').change(function() {
        if ($(this).prop('checked')) {
          // Turn off the Timed button
          $('#toggleTimed').bootstrapToggle('off');
        }else{

            $('#toggleTutor').bootstrapToggle('off');
            $('#toggleTimed').bootstrapToggle('on');
        }
        toggleWithSlide(this);
      });

      // Toggle for Timed button
      $('#toggleTimed').change(function() {
        if ($(this).prop('checked')) {
          // Turn off the Tutor button
          $('#toggleTutor').bootstrapToggle('off');
        }else{

            $('#toggleTutor').bootstrapToggle('on');
            $('#toggleTimed').bootstrapToggle('off');

        }
        toggleWithSlide(this);
      });

      function toggleWithSlide(checkbox) {
        var newState = $(checkbox).prop('checked') ? 'On' : 'Off';
        var toggleHandleWidth = 25;

        // Slide effect
        var toggleGroup = $(checkbox).parent().find('.toggle-group');
        toggleGroup.animate({
          marginLeft: $(checkbox).prop('checked') ? 0 : toggleHandleWidth
        }, 300);

        // Update the button label
        toggleGroup.find('.toggle-on, .toggle-off').toggleClass('active');
        toggleGroup.find('.toggle-' + newState.toLowerCase()).toggleClass('active');
      }
    });
  </script>



<script>

    $('.accordion_1').click(function () {

        if ($('.accordion_1_body').hasClass('hide')) {
            $('.accordion_1_body').removeClass('hide');
            $('.accordion_1_icon').removeClass('fa fa-angle-down');
            $('.accordion_1_icon').addClass('fa fa-angle-up');


        }
        else {
            $('.accordion_1_body').addClass('hide');
            $('.accordion_1_icon').removeClass('fa fa-angle-up');
            $('.accordion_1_icon').addClass('fa fa-angle-down');

        }
    });

    $('.accordion_2').click(function () {

        if ($('.accordion_2_body').hasClass('hide')) {
            $('.accordion_2_body').removeClass('hide');
            $('.accordion_2_icon').removeClass('fa fa-angle-down');
            $('.accordion_2_icon').addClass('fa fa-angle-up');


        }
        else {
            $('.accordion_2_body').addClass('hide');
            $('.accordion_2_icon').removeClass('fa fa-angle-up');
            $('.accordion_2_icon').addClass('fa fa-angle-down');

        }
    });


    $('.accordion_3').click(function () {

        if ($('.accordion_3_body').hasClass('hide')) {
            $('.accordion_3_body').removeClass('hide');
            $('.accordion_3_icon').removeClass('fa fa-angle-down');
            $('.accordion_3_icon').addClass('fa fa-angle-up');


        }
        else {
            $('.accordion_3_body').addClass('hide');
            $('.accordion_3_icon').removeClass('fa fa-angle-up');
            $('.accordion_3_icon').addClass('fa fa-angle-down');

        }
    });


    $('.accordion_4').click(function () {

        if ($('.accordion_4_body').hasClass('hide')) {
            $('.accordion_4_body').removeClass('hide');
            $('.accordion_4_icon').removeClass('fa fa-angle-down');
            $('.accordion_4_icon').addClass('fa fa-angle-up');


        }
        else {
            $('.accordion_4_body').addClass('hide');
            $('.accordion_4_icon').removeClass('fa fa-angle-up');
            $('.accordion_4_icon').addClass('fa fa-angle-down');

        }
    });



</script>


<script>
    $(document).ready(function() {
      // When the "Subjects" checkbox is clicked
      $("#subjects").click(function() {
        // Get the checked status of the "Subjects" checkbox
        var isChecked = $(this).prop("checked");

        // Set the same checked status for all subject checkboxes
        $("[id^='html'], [id^='css'], [id^='javascript']").prop("checked", isChecked);
      });

      // When an individual subject checkbox is clicked
      $("[id^='html'], [id^='css'], [id^='javascript']").click(function() {
        // Check if all subject checkboxes are checked
        var allChecked = $("[id^='html'], [id^='css'], [id^='javascript']").length === $("[id^='html']:checked, [id^='css']:checked, [id^='javascript']:checked").length;

        // Set the checked status for the "Subjects" checkbox
        $("#subjects").prop("checked", allChecked);
      });
    });
  </script>




@endsection
