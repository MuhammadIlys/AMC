
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8">
    <title>AceAmcQ Qbank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="AceAmcQ" name="description">

    <!--- heading custom css --->
    <link rel="stylesheet" href="{{ url('/user/qbank_exam_assets/custom-assets/custom.css') }}">
    <!-- App favicon -->
    <link rel="icon" type="image/png" href="https://aceamcq.com/wp-content/uploads/2023/07/WhatsApp_Image_2023-08-04_at_7.55.46_PM-removebg-preview.png">

    <!-- Add SweetAlert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

     <!-- Font Awesome icons -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- shepherd.js css -->
    <link rel="stylesheet" href="{{ url('/user/qbank_exam_assets/assets/libs/shepherd.js/css/shepherd.css') }}">

    <!-- jsvectormap css -->
    <link href="{{ url('/user/qbank_exam_assets/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">

    <!--Swiper slider css-->
    <link href="{{ url('/user/qbank_exam_assets/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Layout config Js -->
    <script src="{{ url('/user/qbank_exam_assets/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ url('/user/qbank_exam_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ url('/user/qbank_exam_assets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ url('/user/qbank_exam_assets/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <!-- custom Css-->
    <link href="{{ url('/user/qbank_exam_assets/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#draggable").draggable({containment: 'window'});
        });
    </script>



    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Default Stylesheet -->
    <link rel="stylesheet" href="{{ url('/user/qbank_exam_assets/css/style.css') }}">


    <link rel="stylesheet" href="{{ url('/user/qbank_exam_assets/assets/window.css') }}"/>
    <script src="{{ url('/user/qbank_exam_assets/assets/window.js') }}"></script>

    <!-- My Css-->
    <link href="{{ url('/user/qbank_exam_assets/assets/css/style.css') }}" rel="stylesheet" type="text/css">




    <style>




#previous-question-btn, #next-question-btn {
  cursor: pointer;
}

.loader {
    border: 4px solid rgba(0, 0, 0, 0.3);
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.blurred-content {
    filter: blur(5px);
}

        .span_mark {
            /*margin-top: -2px;*/
        }

        .mark_svg {
            width: 32px;
            height: 28px;
            /*margin: auto;*/
            margin-top: 3px;
        }

        ._span {

        }

        ._svg {
            /*display: block;*/
            width: 32px;
            height: 27px;
            margin-left: 10px;
        }

        ._svgnote {
            width: 32px;
            height: 27px;
        }

        ._svgcal {
            width: 32px;
            height: 27px;
            margin-left: 14px;
        }
        ._svgres {
            width: 32px;
            height: 28px;
            margin-left: 22px;
        }
        ._svgend {
            width: 32px;
            height: 28px;
            margin-right: 14px;
        }
    </style>
    <style>
        #month-links-container {
    display: flex;
}

.nav-link {
    margin-right: 10px; /* Add some space between the links */
    text-decoration: none;
    color: #fff;
    cursor: pointer;
}
        {
            height: 52px;
            padding: 0 5px
        }

{
            padding-left: 0;
            padding-right: 0
        }

        .header-icon-text {
            font-size: .9em !important;
            font-weight: 400;
            line-height: 1.1em
        }

        -right-side .header-icon-text {
            margin-top: 3px;
            white-space: nowrap
        }

        -right-side .lab-values-header-icon-text,
        -right-side .notes-header-icon-text,
        -right-side .text-zoom-header-icon-text {
            margin-top: 2px
        }

        -right-side .settings-header-icon-text {
            margin-top: 6px
        }

        a svg {
            display: block;
            width: 32px;
            height: 28px;
            margin: auto
        }

        .bookmark-question {
            padding: 9px 6px !important
        }

        .bookmark-question:hover {
            background-color: var(--icon-hover);
            cursor: pointer
        }

        .question-details {
            text-align: left;
            padding: 4px;
            font-weight: 700;
            font-size: 15px;
            width: 135px
        }

        .question-details .question-id {
            line-height: 15px;
            font-size: 12px;
            display: inline-block;
            margin-top: 5px
        }

        .header-icon {
            height: 24px;
            width: 24px;
            display: inline-block;
            background-size: contain;
            background-repeat: no-repeat;
            background-color: white;
            -webkit-mask-size: 24px 24px;
            mask-size: 24px 24px
        }

        .header-fa-icon {
            font-size: 2em !important
        }

        .next-icon,
        .previous-icon {
            position: relative;
            padding: 24px 14px 0;
            background-image: none;
            display: inline-block
        }

        .next-icon:before,
        .previous-icon:before {
            content: "";
            display: block;
            position: absolute;
            top: 5px;
            left: calc(50% - 12px);
            width: 0;
            height: 0;
            margin: auto;
            border-color: white;
            border-width: 1px;
            border-left: 0 solid white;
            border-bottom: 9px solid transparent;
            border-right: 26px solid white;
            border-top: 9px solid transparent
        }

        .next-icon:after,
        .previous-icon:after {
            content: "";
            display: block;
            position: absolute;
            top: 8px;
            left: calc(50% - 7px);
            width: 0;
            height: 0;
            margin: auto;
            border-color: transparent #5490cc;
            border-style: solid;
            border-width: 6px 20px 6px 0
        }

        .next-icon:before {
            border-width: 9px 0 9px 26px !important
        }

        .next-icon:after {
            left: calc(50% - 11px) !important;
            border-width: 6px 0 6px 20px !important
        }

        .tutorial-icon {
            -webkit-mask-image: url(assets/images/testinterface/Tutorial.svg);
            mask-image: url(assets/images/testinterface/Tutorial.svg)
        }

        .labvalues-icon {
            -webkit-mask-image: url(assets/images/testinterface/labs.png);
            mask-image: url(assets/images/testinterface/labs.png)
        }

        .notes-icon {
            -webkit-mask-image: url(assets/images/testinterface/notes.png);
            mask-image: url(assets/images/testinterface/notes.png)
        }

        .calculator-icon {
            -webkit-mask-image: url(assets/images/testinterface/calculator.png);
            mask-image: url(assets/images/testinterface/calculator.png)
        }

        .reversecolor-icon {
            -webkit-mask-image: url(assets/images/testinterface/Tutorial.svg);
            mask-image: url(assets/images/testinterface/Tutorial.svg)
        }

        .textzoom-icon {
            -webkit-mask-image: url(assets/images/testinterface/TextZoom.svg);
            mask-image: url(assets/images/testinterface/TextZoom.svg);
            -webkit-mask-size: 55px 25px;
            mask-size: 55px 25px;
            height: 25px;
            width: 55px
        }

        .nbme-tutorial-panel-class {
            width: 200px;
            position: relative;
            top: 20px;
            left: -63px;
            box-shadow: 0 0 12px 0 rgba(0, 0, 0, .22);
            padding: 8px 0
        }

        .nbme-tutorial-panel-class p {
            margin: 0
        }

        .nbme-tutorial-panel-class .help-option {
            padding-left: 15px
        }

        .nbme-tutorial-panel-class .help-option p {
            cursor: pointer
        }

        .nbme-tutorial-panel-class .help-option p:hover {
            text-decoration: underline;
            color: grey
        }

        .nbme-tutorial-panel-class .help-option:not(:last-child) {
            margin-bottom: 10px
        }

        .simplebar-offset{
            right: 0px !important;
            bottom: -8px !important;
        }
    </style>




    <style>
        .btn-position{
            top:50%;
            left:50%;
            transform:translate(-50%, -50%);
            position:absolute;
        }

        .modal.right.fade.in .modal-dialog {
            right:0 !important;
            transform: translateX(-50%);
        }
        .modal.right .modal-content {
            height:100%;
            overflow:auto;
            border-radius:0;
        }
        .modal.right .modal-dialog {
            position: fixed;
            margin: auto;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }
        .modal.right.fade.in .modal-dialog {
            transform: translateX(0%);
        }
        .modal.right.fade .modal-dialog {
            right: 0;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }


        .modal.right .modal-header {background-color:#50caff; color:#fff}
        .modal.right .modal-header::after {content:""; display:inline-block;}
        .modal.right .close {text-shadow:none; opacity:1; color:#ff4d4d; font-size:26px}
        /*  form-control  */

        .form-control {border-radius:0; box-shadow:none}
        .form-control:focus {box-shadow:none}

        .modal-backdrop {
            display:none;
        }
    </style>


</head>
