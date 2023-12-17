@extends('super_admin.amc_recalls.recalls_preview.templates.main')
@section('main-container')

<style>
    .loader-container {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: rgba(0, 0, 0, 0.7); /* Adjust the alpha value for desired transparency */
      z-index: 9999;
    }
    .loader {
      border: 4px solid rgba(255, 255, 255, 0.1);
      border-top: 4px solid #007bff; /* Change this to your preferred color */
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 2s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }


</style>

<style>
    /* Add custom styles for the draggable and resizable modal */
    .draggable {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .resizable {
        resize: both;
        overflow: hidden;
    }

    .modal-footer {
        background-color: transparent;
        border: none;
    }

    .modal-footer button {
        background-color: transparent;
        border: none;
        margin: 0 10px;
    }

    .modal-footer button:focus {
        outline: none;
    }

    .modal-footer button:hover {
        background-color: rgba(0, 0, 0, 0.2);
    }

    .model-mobile-desktop{

         left: 304px;
         top: -5.5px;
         max-width: 95%;
         width: auto;
         heigh: auto;
    }

    @media (max-width: 768px) {
      /* Your mobile-specific styles go here */
       .model-mobile-desktop{

                 left: 0px;
                 top: -5.5px;
                 max-width: 95%;
                 width: auto;
                 heigh: auto;
            }
    }

    .modal_image{

font-size: 12pt !important;
font-family: Arial, sans-serif !important;


}



</style>

    <!-- Loader Container -->
    <div class="loader-container" id="loaderContainer" style="display:none;">
        <div class="loader">
        </div>
    </div>

    <body>


        <!-- Model for popup image in side question explination or question -->
        <div class="modal">
        <div class="modal-content">
            <img src="" alt="Zoomed In Image" id="zoomed-image">
        </div>
        </div>


        <!-- ============================================================== -->
            <!-- Main Page begin -->
        <!-- ============================================================== -->
        <div id="layout-wrapper">


            <!-- ========== Top Header Start ========== -->
            <header id="page-topbar">
                <div class="layout-width">
                    <div class="navbar-header">
                        <div class="d-flex">
                            <!-- LOGOs -->
                            <div class="navbar-brand-box horizontal-logo">
                                <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="https://aceamcq.com/wp-content/uploads/2023/07/WhatsApp_Image_2023-08-04_at_7.55.46_PM-removebg-preview.png" alt="" height="22">
                                </span>
                                    <span class="logo-lg">
                                    <img src="assets/images/logo-dark.png" alt="" height="17">
                                </span>
                                </a>

                                <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="https://aceamcq.com/wp-content/uploads/2023/07/WhatsApp_Image_2023-08-04_at_7.55.46_PM-removebg-preview.png" alt="" height="22">
                                </span>
                                    <span class="logo-lg">
                                    <img src="https://aceamcq.com/wp-content/uploads/2023/07/WhatsApp_Image_2023-08-04_at_7.55.46_PM-removebg-preview.png" alt="" height="17">
                                </span>
                                </a>
                            </div>

                            <!-- side bar toggle humburger icon-->

                            <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                                <span class="hamburger-icon">
                                    <span class="bg-white"></span>
                                    <span class="bg-white"></span>
                                    <span class="bg-white"></span>
                                </span>
                            </button>

                            <!-- Question ID and numbers div-->
                            <div class="app-search">
                                <div class="position-relative">
                                    <div> Q.<span id="current-question-no">7</span> of <span id="total-question-no">10</span> </div>
                                    <div >Q.ID: <span id="question-id"> 19284</span> </div>
                                </div>
                            </div>





                        </div> <!-- d-flex Div close-->



                        <!-- marked btn start-->
                        <div class="app-search d-none d-md-block" >
                            <div id="mark-tour">
                                <div class="d-flex" style="padding: 1px 12px 5px 12px;">
                                    <input type="checkbox" class="flag_status">
                                    <span class="span_mark" style="margin-top: 3px;"><svg class="mark_svg"><svg id="whiteflag" viewBox="0 0 22 30"><g style="stroke: #FCFCFC; stroke-width: 2.2; fill: #B70808;"><g id="flag"><line x1="10" y1="35" x2="1.5" y2="4" class="icon"></line><path d="M20,8c-2,3-4,7-7,8c-2,1-5,2-7,3C5,14,4,9,1,5C8,1,13,10,20,8z" class="icon"></path></g></g></svg></svg></span>
                                    <!--<i class="bx bx-bookmark fs-22"></i>-->
                                    <span class="mt-2" style="margin-top: 11px !important;">Mark</span>
                                </div>
                            </div>
                        </div>

                        <!-- marked btn end-->






                        <!-- question Next and Previous btn start-->

                        <div class="d-flex align-items-center middle-menu">


                            <div class="ms-1" id="previous-question-btn"  onclick="loadPreviousQuestion()">
                                <a class="step2 medium-screen-icon ">
                                    <i class="previous-icon"></i>
                                    <div class="header-icon-text text-white" style="margin-left: -12px;">Previous</div>
                                </a>
                            </div>
                            <div class="ms-1" id="next-question-btn" onclick="loadNextQuestion()">
                                <a class="step3 medium-screen-icon ">
                                    <i class="next-icon"></i>
                                    <div class="header-icon-text text-white" style="margin-left: 2px;">Next</div>
                                </a>
                            </div>
                        </div>

                        <!-- question Next and Previous btn end-->


                        <div class="ms-4" id="lab-values" style="height: 45px;" data-bs-toggle="modal" data-bs-target="#labModal">
                            <svg xmlns="http://www.w3.org/2000/svg" style="visibility: hidden; width: 0; height: 0;">
                                <style type="text/css">
                                    #labsIcon rect,
                                    #labsIcon path {
                                        stroke: #000;
                                        stroke-width: 10;
                                    }

                                    #noteIcon rect {
                                        stroke: #000;
                                        stroke-width: 2;
                                    }

                                    #calcIcon rect,
                                    #calcIcon path {
                                        fill: #FFF;
                                        stroke: #000;
                                        stroke-width: 0.5;
                                    }

                                    #lockIcon circle,
                                    #lockIcon rect {
                                        fill: none;
                                        stroke: #EE0;
                                    }

                                    #pencil rect,
                                    #pencil polyline {
                                        stroke: #000;
                                        stroke-width: 2;
                                    }

                                    #zoomout circle {
                                        stroke: #000;
                                        stroke-width: 2;
                                        fill: none;
                                    }
                                </style>
                                <defs>
                                    <linearGradient x1="8" y1="19" x2="31" y2="19" id="lg1">
                                        <stop offset="0" style="stop-color: #666;"></stop>
                                        <stop offset="1" style="stop-color: #CCC;"></stop>
                                    </linearGradient>
                                    <linearGradient id="yellowBeaker" x2="0" y2="1">
                                        <stop offset="15%" stop-color="rgba(255,255,255,0.7)"></stop>
                                        <stop offset="17%" stop-color="yellow"></stop>
                                    </linearGradient>
                                    <linearGradient id="pinkBeaker" x2="0" y2="1">
                                        <stop offset="30%" stop-color="rgba(255,255,255,0.7)"></stop>
                                        <stop offset="35%" stop-color="pink"></stop>
                                    </linearGradient>
                                    <linearGradient id="tealBeaker" x2="0" y2="1">
                                        <stop offset="40%" stop-color="rgba(255,255,255,0.85)"></stop>
                                        <stop offset="42%" stop-color="skyblue"></stop>
                                    </linearGradient>
                                    <g id="arrow">
                                        <polygon stroke-linejoin="round" points="6,12 20,12 20,6 35,15 20,26 20,20 6,20"></polygon>
                                    </g>
                                    <g id="flag">
                                        <line x1="10" y1="35" x2="1.5" y2="4" class="icon"></line>
                                        <path d="M20,8c-2,3-4,7-7,8c-2,1-5,2-7,3C5,14,4,9,1,5C8,1,13,10,20,8z" class="icon"></path>
                                    </g>
                                    <g id="pencil">
                                        <rect transform="rotate(-60,90,48)" width="90" height="30" style="fill: #F7971D;"></rect>
                                        <polyline points="3,102 5,127 30,117" style="fill: #FFF;"></polyline>
                                        <polyline points="4.5,117 5,127 14.5,123"></polyline>
                                        <rect transform="rotate(-60,45,-30)" width="25" height="30" style="fill: #F06567;"></rect>
                                    </g>
                                    <g id="Group_4935" data-name="Group 4935" transform="translate(322 -1279)">
                                        <path id="Rectangle_240" data-name="Rectangle 240" d="M30,0H130a0,0,0,0,1,0,0V158a0,0,0,0,1,0,0H30A30,30,0,0,1,0,128V30A30,30,0,0,1,30,0Z" transform="translate(-317 1295)" fill="#d7dced"></path>
                                        <g id="Rectangle_237" data-name="Rectangle 237" transform="translate(-322 1289)" fill="rgba(255,255,255,0)" stroke="#fff" stroke-width="7">
                                            <rect width="396" height="169" rx="35" stroke="none"></rect>
                                            <rect x="3.5" y="3.5" width="389" height="162" rx="31.5" fill="none"></rect>
                                        </g>
                                        <rect id="Rectangle_238" data-name="Rectangle 238" width="6" height="169" transform="translate(-190 1289)" fill="#fff"></rect>
                                        <rect id="Rectangle_239" data-name="Rectangle 239" width="6" height="169" transform="translate(-64 1289)" fill="#fff"></rect>
                                        <g id="Group_4934" data-name="Group 4934" transform="translate(0 -4)">
                                            <text id="A" transform="translate(-253 1400)" font-size="70" font-family="ArialNarrow-Bold, Arial Narrow" font-weight="700" letter-spacing="-0.002em">
                                                <tspan x="-20.713" y="0">A</tspan>
                                            </text>
                                            <text id="A-2" data-name="A" transform="translate(-124 1415)" fill="#fff" font-size="110" font-family="ArialNarrow-Bold, Arial Narrow" font-weight="700" letter-spacing="-0.002em">
                                                <tspan x="-32.549" y="0">A</tspan>
                                            </text>
                                            <text id="A-3" data-name="A" transform="translate(5 1433)" fill="#fff" font-size="160" font-family="ArialNarrow-Bold, Arial Narrow" font-weight="700" letter-spacing="-0.002em">
                                                <tspan x="-47.344" y="0">A</tspan>
                                            </text>
                                        </g>
                                    </g>
                                </defs>
                                <symbol id="invertIcon" viewBox="4 2 28 32">
                                    <path d="m 31,17.5 a 13,13 0 1 1 -26,0 13,13 0 1 1 26,0" style="fill: #F8F8F8; stroke: #333; stroke-width: 1;"></path>
                                    <path d="m 29,11 a 12,12 0 0 1 -22,13 z" style="fill: url(#lg1); stroke: #111; stroke-width: 1;"></path>
                                    <path d="m 28,11 a 11,11 0 0 1 -21.5,12.5 z" style="fill: #111;"></path>
                                </symbol>
                                <symbol id="labsIcon" viewBox="0 0 260 340">
                                    <rect x="59" y="30" width="140" height="200" rx="20" ry="20" fill="url(#yellowBeaker)"></rect>
                                    <rect x="175" y="14" width="55" height="290" rx="10" ry="10" fill="url(#pinkBeaker)"></rect>
                                    <path d="M50,90 l-35,130 t-1,30 0,30 t48,20 130,-20 v-60 l-35-130 z" fill="url(#tealBeaker)"></path>
                                </symbol>
                                <symbol id="refIcon" viewBox="0 0 48 48">
                                    <rect x="58" y="38" width="20" height="29" transform="matrix(1,0,-0.815,0.58,0,0)" style="fill: #333; stroke: #333; stroke-width: 0.5;"></rect>
                                    <rect x="29" y="56" rx="1" ry="1" width="29" height="8.1" transform="matrix(0.81,-0.58,0,1,0,0)" style="fill: #935BBF; stroke: #333; stroke-width: 1;"></rect>
                                    <rect x="2.1" y="40" width="21.3" height="7" style="fill: #C8C8C8;"></rect>
                                    <rect x="1.7" y="39" width="22" height="0.9" style="fill: #333;"></rect>
                                    <rect x="1.6" y="47" width="22" height="0.9" style="fill: #333;"></rect>
                                    <rect x="29" y="47" rx="1" ry="1" width="29" height="8.1" transform="matrix(0.81,-0.58,0,1,0,0)" style="fill: #8D91F0; stroke: #45736F; stroke-width: 1;"></rect>
                                    <rect x="0" y="31" width="22.5" height="7" style="fill: #C8C8C8;"></rect>
                                    <rect x="45" y="23" rx="1" ry="1" width="20" height="29" transform="matrix(1,0,-0.81,0.58,0,0)" style="fill: #8D91F0; stroke: #45736F; stroke-width: 1;"></rect>
                                    <rect x="0" y="30" width="24" height="1" style="fill: #45736F;"></rect>
                                    <rect x="0" y="38" width="24" height="1" style="fill: #45736F;"></rect>
                                    <rect x="26" y="36" rx="1" ry="1" width="29" height="8.1" transform="matrix(0.81,-0.58,0,1,0,0)" style="fill: #A67C52; stroke: #98414E; stroke-width: 1;"></rect>
                                    <rect x="1" y="20.7" width="20" height="8.1" style="fill: #C8C8C8;"></rect>
                                    <rect x="30" y="6.9" width="20" height="29" transform="matrix(1,0,-0.81,0.58,0,0)" style="fill: #A67C52; stroke: #98414E; stroke-width: 1;"></rect>
                                    <rect x="0.7" y="21" width="20.4" height="0.7" style="fill: #98414E;"></rect>
                                    <rect x="0.63" y="28.8" width="20.3" height="1" style="fill: #98414E;"></rect>
                                    <rect x="36" y="17" width="6.5" height="11" transform="matrix(1,0,-0.81,0.59,0,0)" style="fill: #C8C8C8; stroke: #444; stroke-width: 0.7;"></rect>
                                </symbol>
                                <symbol id="noteIcon" viewBox="0 0 160 160">
                                    <rect x="0" y="20" width="130" height="80" fill="#FCFCFC"></rect>
                                    <text x="20" y="70" style="font-family: 'Chalkboard SE', 'Segoe Print', cursive; font-size: 40px;">
                                        ABC
                                    </text>
                                    <use xlink:href="#pencil" transform="rotate(25) translate(100,-20)"></use>
                                </symbol>
                                <symbol id="calcIcon" viewBox="2 2 32 28">
                                    <rect width="28" height="24" x="3.5" y="3.5" rx="3.5" style="fill: #999;"></rect>
                                    <path d="M3.5,22.5 l 0,5 l 28,0 l 0,-5" style="fill: #999;"></path>
                                    <rect width="24" height="10" x="5.5" y="7.5"></rect>
                                    <text style="font-size: 8px; font-family: Tahoma;">
                                        <tspan x="9" y="15">0.25</tspan>
                                    </text>
                                    <rect width="4" height="3" x="5.5" y="21.5"></rect>
                                    <rect width="4" height="3" x="11.5" y="21.5"></rect>
                                    <rect width="4" height="3" x="18.5" y="21.5"></rect>
                                    <rect width="4" height="3" x="24.5" y="21.5"></rect>
                                </symbol>
                                <symbol id="lockIcon" viewBox="0 0 32 30">
                                    <circle cx="16" cy="15" r="12" style="stroke-width: 3;"></circle>
                                    <circle cx="16" cy="12" r="3" style="stroke-width: 2;"></circle>
                                    <rect x="11" y="13" width="10" height="9" rx="1" style="fill: #EE0;"></rect>
                                    <path d="M 15,21 l 0,-2 a 1.75,1.75 0 1 1 2,0 l 0,2 z" style="fill: #457;"></path>
                                </symbol>
                                <symbol id="goIcon" viewBox="0 0 40 30">
                                    <use xlink:href="#arrow" style="fill: green; stroke: green; stroke-width: 6;"></use>
                                    <use xlink:href="#arrow" style="fill: green; stroke: white; stroke-width: 2;"></use>
                                </symbol>
                                <symbol id="stopIcon" viewBox="0 0 32 32">
                                    <path d="M 3,11 3,21 11,29 21,29 29,21 29,11 21,3 11,3 z" style="fill: #A00; stroke: #A00;"></path>
                                    <path d="M 5,12 5,20 12,27 20,27 27,20 27,12 20,5 12,5 z" style="fill: #F00; stroke: #FFF; stroke-width: 2;"></path>
                                </symbol>
                                <symbol id="whiteflag" viewBox="0 0 22 30">
                                    <use xlink:href="#flag" style="stroke: #FCFCFC; stroke-width: 2.2; fill: #B70808;"></use>
                                </symbol>
                                <symbol id="darkflag" viewBox="0 0 22 30">
                                    <use xlink:href="#flag" style="stroke: #555; stroke-width: 2; fill: #D92A2A;"></use>
                                </symbol>
                                <symbol id="pencilIcon" viewBox="0 0 80 160">
                                    <use xlink:href="#pencil"></use>
                                </symbol>
                                <symbol id="warningIcon" viewBox="0 0 10 10">
                                    <polygon points="5,0 10,10 0,10" style="fill: yellow;"></polygon>
                                    <polygon points="5,1 9,9.4 1,9.4" style="stroke: orange; stroke-width: 0.2; fill: yellow;"></polygon>
                                    <text x="5" y="8.7" style="text-anchor: middle; font-size: 8px; font-family: 'Baskerville Old Face', 'Bookman Old Style', Georgia, serif; font-weight: bold;">
                                        !
                                    </text>
                                </symbol>
                                <symbol id="zoomout" viewBox="0 0 50 50">
                                    <circle r="16" cx="32" cy="20"></circle>
                                    <rect x="25" y="18" width="14" height="4" rx="2" ry="2"></rect>
                                    <rect x="10" y="50" width="20" height="8" rx="3" ry="3" transform="rotate(135 20 45)"></rect>
                                </symbol>
                                <symbol id="zoomin" viewBox="0 0 50 50">
                                    <use xlink:href="#zoomout"></use>
                                    <rect x="30" y="12" width="4" height="16" rx="2" ry="2"></rect>
                                </symbol>
                                <symbol id="textZoom" viewBox="0 0 160 160">
                                    <use xlink:href="#Group_4935"></use>
                                </symbol>
                            </svg>

                            <span class="_span">
                                 <svg class="_svg">
                                <svg id="labsIcon" viewBox="0 0 260 340">
                                    <rect x="59" y="30" width="140" height="200" rx="20" ry="20" fill="url(#yellowBeaker)"></rect>
                                    <rect x="175" y="14" width="55" height="290" rx="10" ry="10" fill="url(#pinkBeaker)"></rect>
                                    <path d="M50,90 l-35,130 t-1,30 0,30 t48,20 130,-20 v-60 l-35-130 z" fill="url(#tealBeaker)"></path>
                                </svg>
                            </svg>
                            </span>
                            <p>Lab Values</p>
                        </div>

                        <!-- note start-->
                        <div class="ms-4" id="notes" style="height: 45px;" data-bs-toggle="modal" data-bs-target="#noteModal">
                            <span class="_span">
                                 <svg class="_svgnote">
                                                     <svg id="noteIcon" viewBox="0 0 160 160">
                                                         <rect x="0" y="20" width="130" height="80" fill="#FCFCFC"></rect>
                                                         <text x="20" y="70" style="font-family: 'Chalkboard SE', 'Segoe Print', cursive; font-size: 40px;"> ABC </text>
                                                         <g transform="rotate(25) translate(100,-20)">
                                                             <g id="pencil">
                                                                 <rect transform="rotate(-60,90,48)" width="90" height="30" style="fill: #F7971D;"></rect>
                                                                 <polyline points="3,102 5,127 30,117" style="fill: #FFF;"></polyline>
                                                                 <polyline points="4.5,117 5,127 14.5,123"></polyline>
                                                                 <rect transform="rotate(-60,45,-30)" width="25" height="30" style="fill: #F06567;"></rect>
                                                             </g>
                                                         </g>
                                                     </svg>
                                                 </svg>
                            </span>
                             <p>Notes</p>
                         </div>

                         <!-- note  end-->


                        <div class="d-flex align-items-center rgt-menu">

                            <!-- full scren button-->

                            <div class="ms-4" id="full-screen-tour">
                                <center style="margin-top: 3px">
                                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                            data-toggle="fullscreen">
                                        <i class='ri-fullscreen-fill text-white' style="font-size: 26px"></i>
                                    </button>
                                </center>
                                <span>Full Screen</span>
                            </div>


                        </div>





                    </div>
                </div>
            </header>
            <!-- ========== Top Header End ========== -->

            <!-- ========== Left Sidebar start ========== -->
            <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                            id="vertical-hover">
                        <i class="ri-record-circle-line"></i>
                    </button>
                </div>

                <div id="scrollbar">
                    <div class="container-fluid">

                        <div id="two-column-menu">
                        </div>
                        <ul class="navbar-nav" id="navbar-nav">

                            <li style=" width: 100%;" class="nav-item nav-tab-color"><a href="#" class="nav-link" onclick="loadQuestionByIndex(0)">1</a></li>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>

                <div class="sidebar-background"></div>
            </div>
            <!-- ==========Left Sidebar End ========== -->

            <div class="vertical-overlay"></div>

            <!-- ============================================================== -->
            <!-- Main Dashboard Div and content start -->
            <!-- ============================================================== -->


            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">


                        <!--Tabs to show the content in body-->
                        <div class="row">
                            <div class="col">

                                <div class="h-100">

                                    <div id="tabs-1" class="tabs-1">
                                        <section class="cover">

                                                    <div class="row">
                                                        <div class="col-xl-12 col-md-12">
                                                            <p style ="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;" class="heading-text"  id="question-text">
                                                                {!! $question->question_text !!}
                                                            </p>

                                                            <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div style="margin-bottom: 20px;" class="tablediv">
                                                                        <table class="table qtable">
                                                                            <tbody>

                                                                                @if (!empty($question->option1))

                                                                                <tr>
                                                                                    <td class="tbl_radio">
                                                                                        <input type="radio" id="test1" name="radio-group">
                                                                                        <label for="test1" style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;">A. <span id="option-1">{{ $question->option1 }}</span> </label>
                                                                                    </td>
                                                                                </tr>

                                                                                @endif

                                                                                @if (!empty($question->option2))
                                                                                <tr>
                                                                                    <td class="tbl_radio">
                                                                                        <input type="radio" id="test2" name="radio-group">
                                                                                        <label for="test2" style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;">B. <span id="option-2">{{ $question->option2 }}</span>
                                                                                        </label>
                                                                                    </td>
                                                                                </tr>
                                                                                @endif

                                                                                @if (!empty($question->option3))

                                                                                <tr>
                                                                                    <td class="tbl_radio">
                                                                                        <input type="radio" id="test3" name="radio-group">
                                                                                        <label for="test3" style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;">C. <span id="option-3">{{ $question->option3 }}</span>
                                                                                        </label>
                                                                                    </td>
                                                                                </tr>
                                                                                @endif

                                                                                @if (!empty($question->option4))
                                                                                <tr>
                                                                                    <td class="tbl_radio">
                                                                                        <input type="radio" id="test4" name="radio-group">
                                                                                        <label for="test4" style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;">D. <span id="option-4">{{ $question->option4 }}</span>
                                                                                        </label>
                                                                                    </td>
                                                                                </tr>
                                                                                @endif

                                                                                @if (!empty($question->option5))
                                                                                <tr>
                                                                                    <td class="tbl_radio">
                                                                                        <input type="radio" id="test5" name="radio-group">
                                                                                        <label for="test5" style="font-size: 12pt; font-family: Arial, sans-serif; color:#3A3A3A;">E. <span id="option-5">{{ $question->option5 }}</span>
                                                                                        </label>
                                                                                    </td>
                                                                                </tr>

                                                                                @endif
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <div class="card cd-info mt-3" id="card-border">
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <div class="py-4">
                                                                        <span class="text-red fs-5 correct-option-mb" id ="correction-option-text" style="color: red">correct option</span><br>
                                                                        <span></span>
                                                                            <div class="d-flex align-items-center">

                                                                            <div class="flex-grow-1 ms-3">
                                                                                    <p style="font-size: 12pt; font-family: Arial, sans-serif;" id="correct-option" class="correct-option-mb">
                                                                                        @if ($question->correct_option == '1')
                                                                                            A
                                                                                        @elseif ($question->correct_option == '2')
                                                                                            B
                                                                                        @elseif ($question->correct_option == '3')
                                                                                            C
                                                                                        @elseif ($question->correct_option == '4')
                                                                                            D
                                                                                        @elseif ($question->correct_option == '5')
                                                                                            E
                                                                                        @else
                                                                                            <!-- Handle other cases if needed -->
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->


                                                                    <div class="col-4 margin-correct-option">
                                                                        <div class="py-4 ">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="flex-shrink-0">
                                                                                <i class="bx bx-line-chart display-6 text-muted"></i>
                                                                                </div>
                                                                                <div class="flex-grow-1 ms-3">
                                                                                <span id="correct-ans-per">68%</span>
                                                                                <br>
                                                                                <span class="correct-option-mb" >Answered correctly</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->






                                                                    <div class="col-2">
                                                                        <div class="py-4">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="flex-shrink-0">
                                                                                    <i class="bx bx-calendar display-6 text-muted"></i>
                                                                                </div>
                                                                                <div class="flex-grow-1 ms-3">
                                                                                    <span class="correct-option-mb">2023</span>
                                                                                    <br>
                                                                                    <span class="correct-option-mb">Version</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                </div>
                                                            </div>

                                                        </div><!-- end col -->



                                                        <div style="margin-bottom: 20px;" class="col-xxl-6" id="hide-explanation">
                                                                <!-- Nav tabs -->
                                                            <ul class="nav nav-tabs mb-3" role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <a  style ="color:#fff !important; background-color: #3852A4;" class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true">
                                                                        Explanation
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                                <!-- Tab panes -->
                                                            <div class="tab-content ex-tab-content  text-muted">
                                                                <div style ="background-color: #F3F3F9 !important;" class="tab-pane active show" id="home" role="tabpanel">

                                                                    <p style ="font-size:16px; font-family: Arial, sans-serif; color:#3A3A3A;" class="mb-0" id="question-explanation">

                                                                        {!! $question->question_explanation !!}
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div> <!-- end row-->
                                        </section>
                                    </div><!-- end tab -->
                                </div>
                            </div> <!-- end .h-100-->
                        </div> <!-- end col -->
                    </div>
                </div>
            <!-- container-fluid -->
            </div>

            <!-- ============================================================== -->
            <!-- Main Dashboard Div and content end -->
            <!-- ============================================================== -->


            <!-- ============================================================== -->
            <!-- Footer Start -->
            <!-- ============================================================== -->

            <!---Page Footer   --->
            <footer class="footer" style="position: fixed">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="text-white">
                                Block Time Elapsed 00:16:06
                                <br>
                                Timed
                            </h6>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                <div class="d-flex align-items-center rgt-footer-menu">


                                    <div class="ms-4 footer-mr" id="feedback" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                        <center>
                                            <i class="bx bx-message footer-icon"></i>
                                        </center>
                                        <p style="margin-top: -4px">Feedback</p>
                                    </div>
                                    <div class="ms-4 footer-mr" id="suspend">
                                        <center>
                                            <i class="bx bx-pause-circle footer-icon"></i>
                                        </center>
                                        <p style="margin-top: -4px">Suspend</p>
                                    </div>

                                    <div class="ms-4 footer-mr" id="endblock">
                                        <span class="_span">
                                             <svg class="_svgend" id="stopIcon" viewBox="0 0 32 32">
                                                    <path d="M 3,11 3,21 11,29 21,29 29,21 29,11 21,3 11,3 z" style="fill: #A00; stroke: #A00;"></path>
                                                    <path d="M 5,12 5,20 12,27 20,27 27,20 27,12 20,5 12,5 z" style="fill: #F00; stroke: #FFF; stroke-width: 2;"></path>
                                                </svg>
                                        </span>
                                        <p>End Block
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div> <!-- END layout-wrapper -->

    </body>



</html>


<script>


    // Function to open the modal window
    function openModal(event, url) {

        var baseUrl = '{{ url('/') }}';
        url = baseUrl + '/'+ url;
        event.preventDefault(); // Prevent the default link behavior

        // Set the URL of the image
        $('#iframeContent').attr('src', url);

        // Open the modal
        $('#myModal').modal('show');

        // Make the modal draggable
        $('.modal-dialog').draggable();

        // Make the modal resizable
        $('.modal-dialog').resizable({
        alsoResize: "#iframeContent",
        aspectRatio: true
        });

        // Reset image scale to 1 when modal opens
        $('#iframeContent').css('transform', 'scale(1)');
    }

    // Zoom In function
    function zoomIn() {
        const currentScale = parseFloat($('#iframeContent').css('transform').split(',')[3]);
        const newScale = currentScale + 0.1;
        $('#iframeContent').css('transform', `scale(${newScale})`);
    }

    // Zoom Out function
    function zoomOut() {
        const currentScale = parseFloat($('#iframeContent').css('transform').split(',')[3]);
        const newScale = currentScale - 0.1;
        if (newScale >= 0.1) {
        $('#iframeContent').css('transform', `scale(${newScale})`);
        }
    }


        // Function to close the modal
        function closeModal() {
        $('#myModal').modal('hide');
    }

    // Attach click event to the element with ID "close_model"
    $(document).on('click', '#close_model', function() {
        closeModal();
    });
        // Set up interact.js for touch-based dragging and resizing
    interact('.draggable').draggable({
        listeners: {
            move(event) {
                const target = event.target
                // Keep the dragged position in the data-x/data-y attributes
                const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
                const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy
                // Translate the element
                target.style.transform = `translate(${x}px, ${y}px)`
                // Update the position attributes
                target.setAttribute('data-x', x)
                target.setAttribute('data-y', y)
            }
        }
    }).resizable({
        edges: { top: true, left: true, bottom: true, right: true },
        listeners: {
            move(event) {
                const target = event.target
                const x = (parseFloat(target.getAttribute('data-x')) || 0)
                const y = (parseFloat(target.getAttribute('data-y')) || 0)
                // Update the element's dimensions
                target.style.width = event.rect.width + 'px'
                target.style.height = event.rect.height + 'px'
                // Translate when resizing from top or left edges
                target.style.transform = `translate(${x}px, ${y}px)`
            }
        }
    });








</script>
<!--##################################### Custom Code End for image popup in question ###################################################-->




<!--##################################### designing the font for question and explination start ###################################################-->


<script>



// Function to apply CSS styles to all elements within the specified elements
function applyFontStylesToElements(selector) {
  const elements = document.querySelectorAll(selector);

  if (elements) {
    const fontSize = '12pt'; // Change to your desired font size
    const fontFamily = 'Arial, sans-serif'; // Change to your desired font family

    elements.forEach(element => {
      // Select all elements within the specified element
      const childElements = Array.from(element.querySelectorAll('*'));

      childElements.forEach(childElement => {
        childElement.style.fontSize = fontSize;
        childElement.style.fontFamily = fontFamily;
      });
    });
  }
}

// Function to observe changes in the specified elements' content
function observeElementChanges(selector) {
  const elements = document.querySelectorAll(selector);

  if (elements) {
    elements.forEach(element => {
      const observer = new MutationObserver(function (mutationsList) {
        for (const mutation of mutationsList) {
          if (mutation.type === 'childList') {
            applyFontStylesToElements(selector);
          }
        }
      });

      observer.observe(element, { childList: true, subtree: true });
    });
  }
}

// Call the functions when the page loads
$(document).ready(function () {
  applyFontStylesToElements('#question-text');
  applyFontStylesToElements('#question-explanation');

  observeElementChanges('#question-text');
  observeElementChanges('#question-explanation');
});





</script>

<!--##################################### designing the font for question and explination start ###################################################-->














<!-- popup image Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-xl modal-dialog-centered draggable resizable  model-mobile-desktop" >
        <div class="modal-content">
        <div class="modal-header" style="background-color: #3852A4; color: #fff;">
            <p style="color:white;" class="modal-title"> Exhibit Display </p>
            <button type="button" id="close_model" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <img id="iframeContent" style="border: none; width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="zoomIn()"><i style ="color:#3852A4; font-size:20px;" class="fas fa-search-plus"></i></button>
            <button class="btn btn-secondary" onclick="zoomOut()"><i style ="color:#3852A4; font-size:20px;" class="fas fa-search-minus"></i></button>
        </div>
        </div>
    </div>
</div>




 <!--Modal Lab values-->

<div id="labModal" class="modal right fade" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;margin-top: 52px;">
    <div class="modal-dialog modal-dialog-scrollable" style="height: 84%;">
        <div class="modal-content">
            <div class="modal-header modal-header-lab-values-title" style="background: #D9D9D9">
                <h5 class="modal-title" id="myModalLabel">Lab Values</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                <i data-bs-dismiss="modal" title="Undock Lab Values" class="las la-external-link-square-alt fs-21"></i>
            </div>
            <div class="modal-header modal-header-lab-values bg-white">
                <input type="text" class="lab-search" id="lab-search" name="search">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="formCheck1">
                    <label class="form-check-label text-muted text-dark fw-bold" for="formCheck1">
                        SI Reference Intervals
                    </label>
                </div>
            </div>
            <div class="modal-header modal-header-lab-values bg-white">

                <ul class="nav nav-tabs lab-nav-tab" role="tablist">
                    <li class="nav-item lab-nav-item">
                        <a class="nav-link lab-nav-link active" data-bs-toggle="tab" href="#serum" role="tab" aria-selected="false">
                            Serum
                        </a>
                    </li>
                    <li class="nav-item lab-nav-item">
                        <a class="nav-link lab-nav-link" data-bs-toggle="tab" href="#cerebrospinal" role="tab" aria-selected="false">
                            Cerebrospinal
                        </a>
                    </li>
                    <li class="nav-item lab-nav-item">
                        <a class="nav-link lab-nav-link" data-bs-toggle="tab" href="#blood" role="tab" aria-selected="false">
                            Blood
                        </a>
                    </li>
                    <li class="nav-item lab-nav-item">
                        <a class="nav-link lab-nav-link" data-bs-toggle="tab" href="#bmi" role="tab" aria-selected="true">
                            Urine and BMI
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body lab-modal-body">

                <!-- Tab panes -->
                <div class="tab-content  text-muted">
                    <div class="tab-pane active" id="serum" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table label-table align-middle table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Serum</th>
                                    <th scope="col">Reference Range</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Aspartate aminotransferase (AST)</td>
                                    <td>12-38 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alkaline phosphatase</td>
                                    <td>25-100 U/L</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="cerebrospinal" role="tabpanel">

                        <div class="table-responsive">
                            <table class="table label-table align-middle table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Serum</th>
                                    <th scope="col">Reference Range</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Aspartate aminotransferase (AST)</td>
                                    <td>12-38 U/L</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="blood" role="tabpanel">

                        <div class="table-responsive">
                            <table class="table label-table align-middle table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Serum</th>
                                    <th scope="col">Reference Range</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Aspartate aminotransferase (AST)</td>
                                    <td>12-38 U/L</td>
                                </tr>
                                <tr>
                                    <td>Aspartate aminotransferase (AST)</td>
                                    <td>12-38 U/L</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="bmi" role="tabpanel">

                        <div class="table-responsive">
                            <table class="table label-table align-middle table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Serum</th>
                                    <th scope="col">Reference Range</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Alanine aminotransferase (ALT)</td>
                                    <td>10-40 U/L</td>
                                </tr>
                                <tr>
                                    <td>Aspartate aminotransferase (AST)</td>
                                    <td>12-38 U/L</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>




<!-- Modal Note -->
<div id="noteModal" class="modal modal-tutorial fade zoomIn" data-bs-backdrop="static" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true" style="display: none; left: 1100px; top: 85px; width: 420px; padding-left: 0px;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #EEEEEE;padding: 3px;">
            <div class="modal-header modal-header-tutorial" style="background: #3852A4;padding: 0 13px;">
               <h5 class="modal-title text-white" id="noteModalLabel" style="margin: auto;">Edit Item Notes</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close" style="margin: unset !important;"></button>
            </div>
            <div class="modal-body" style="padding: 10px 10px 0 10px;">
                <div class="card">
                    <div class="card-body" style="padding: unset;border: 2px solid black;">
                        <textarea name="" id="" cols="30" rows="14" class="form-control">

                        </textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-bottom: 4px;justify-content: space-between;">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border: 1px solid blue;">Save and Close</button>
                <button type="button" class="btn btn-light" style="border: 1px solid blue;">Delete Notes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Feedback -->
<div id="feedbackModal" class="modal modal-feedback fade zoomIn" data-bs-backdrop="static" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true" style="display: none; left: 1018px; top: 70px; width: 500px; padding-left: 0px;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #EEEEEE;padding: 3px;">

            <div class="modal-header modal-header-tutorial ui-draggable-handle" style="background: #3852A4;padding: 7px 13px;">
                <i class="bx bx-message footer-icon text-white" style="margin-right: 6px;"></i> <h5 class="modal-title text-white" id="feedbackModalLabel">Feedback</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 10px 10px 0 10px;">
                <div class="card">
                    <div class="card-body" style="padding: unset;border: 2px solid black;">
                        <textarea name="" id="" cols="30" rows="14" class="form-control">

                        </textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-bottom: 4px;justify-content: space-between;">
                <div class="d-flex"><input type="checkbox" name="ch1" id="ch1"><p style="margin-top: 16px;margin-left: 4px;">Check here if your concern is for a software/technical issue.</p></div>
                <button type="button" class="btn btn-light" style="border: 1px solid blue;">Submit</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




@endsection

