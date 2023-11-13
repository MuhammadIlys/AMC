@extends('users.mocks_user.templates.main')
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














    <style>
        .table > :not(caption) > * > * {
            background: unset;
            --vz-text-opacity: 1;
            color: #878a99 !important;
        }

        .form-select {
            width: unset;
        }

        /*.accordion-button:not(.collapsed){*/
        /*background-color: unset;*/
        /*}*/
        /*.accordion-item{*/
        /*border: unset;*/
        /*}*/
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
            padding: 0;
            margin: 0;
        }

        .details-container {
            width: 100%;
            height: 100%;
            background-color: #FFF;
            padding-top: 5px;
        }

        .details-table {
            width: 100%;
            background-color: #FFF;
            margin: 5px;
        }

        .title {
            font-weight: bold;
        }

        .iconSettings {
            margin-top: 5px;
            margin-bottom: 10px;
            font-size: 12px;
            position: relative;
            top: 1px;
            display: inline-block;
            font-family: 'Glyphicons Halflings';
            font-style: normal;
            font-weight: 400;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
        }

        td.details-control {
            cursor: pointer;
            text-align: center;
            padding: unset;

        &
        :before {
        @extend  . iconSettings;
            content: '\2b';
            font-size: 29px;
        }

        }

        tr.shown td.details-control {

        &
        :before {
        @extend  . iconSettings;
            content: '\2212';
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
        :root {
            --text: "Select values";
        }

        .multiple_select {
            height: 18px;
            width: 90%;
            overflow: hidden;
            -webkit-appearance: menulist;
            position: relative;
            z-index: 1000;
        }

        .multiple_select::before {
            content: var(--text);
            display: block;
            margin-left: 5px;
            margin-bottom: 2px;
        }

        .multiple_select_active {
            overflow: visible !important;
        }

        .multiple_select option {
            display: none;
            height: 18px;
            background-color: white;
        }

        .multiple_select_active option {
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



    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link href="https://uworld.aceamcq.com/Themes/themeone/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
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
            background-color: #5cb85c;
            border-color: #4cae4c;
        }

        .btn-success:focus {
            color: #fff;
            background-color: #449d44;
            border-color: #255625;
        }

        .btn-success:hover {
            color: #fff;
            background-color: #449d44;
            border-color: #398439;
        }

        .btn-success:active {
            color: #fff;
            background-color: #449d44;
            border-color: #398439;
        }

        .btn-success:active:focus, .btn-success:active:hover {
            color: #fff;
            background-color: #398439;
            border-color: #255625;
        }

        .btn-success:active {
            background-image: none;
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
            font-size: 18px;
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
            background-color: #97d881;
        }

        .btn-success:hover {
            background-color: #7ac063;
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
            background: #F87DA9;
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
            color: #2196f3;
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
            border: 2px solid #0079bf;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
            padding: 10px;
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
            top: 6px;
            left: 9px;
            width: 6px;
            height: 14px;
            border: solid #0079bf;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /*! CSS Used from: Embedded */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>




    <style>
        /*! CSS Used from: https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css */
        *, ::after, ::before {
            box-sizing: border-box;
        }

        table {
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
        }

        label {
            display: inline-block;
            margin-bottom: .5rem;
        }

        @media  print {
            *, ::after, ::before {
                text-shadow: none !important;
                box-shadow: none !important;
            }

            thead {
                display: table-header-group;
            }

            tr {
                page-break-inside: avoid;
            }
        }

        /*! CSS Used from: https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/css/all.min.css ; media=all */
        @media  all {
            .fal, .far, .fas {
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                display: inline-block;
                font-style: normal;
                font-variant: normal;
                text-rendering: auto;
                line-height: 1;
            }

            .fa-lg {
                font-size: 1.33333em;
                line-height: .75em;
                vertical-align: -.0667em;
            }

            .fa-2x {
                font-size: 2em;
            }

            .fa-angle-right:before {
                content: "\f105";
            }

            .fa-bookmark:before {
                content: "\f02e";
            }

            .fa-caret-down:before {
                content: "\f0d7";
            }

            .fa-check:before {
                content: "\f00c";
            }

            .fa-minus-circle:before {
                content: "\f056";
            }

            .fa-times:before {
                content: "\f00d";
            }

            .fal {
                font-weight: 300;
            }

            .fal, .far {
                font-family: "Font Awesome 5 Pro";
            }

            .far {
                font-weight: 400;
            }

            .fas {
                font-family: "Font Awesome 5 Pro";
                font-weight: 900;
            }
        }

        /*! CSS Used from: https://apps.uworld.com/courseapp/usmle/v23/styles.1afb9d511802a139.css ; media=all */
        @media  all {
            .mat-table {
                font-family: Open Sans;
            }

            .mat-header-cell {
                font-size: 12px;
                font-weight: 400;
            }

            .mat-cell {
                font-size: 14px;
            }

            .mat-form-field {
                font-size: inherit;
                font-weight: 400;
                line-height: 1.125;
                font-family: Open Sans;
                letter-spacing: normal;
            }

            .mat-form-field-wrapper {
                padding-bottom: 1.34375em;
            }

            .mat-form-field-infix {
                padding: .5em 0;
                border-top: .84375em solid transparent;
            }

            .mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {
                transform: translateY(-1.34375em) scale(.75);
                width: 133.3333333333%;
            }

            .mat-form-field-label-wrapper {
                top: -.84375em;
                padding-top: .84375em;
            }

            .mat-form-field-label {
                top: 1.34375em;
            }

            .mat-form-field-underline {
                bottom: 1.34375em;
            }

            .mat-form-field-subscript-wrapper {
                font-size: 75%;
                margin-top: .6666666667em;
                top: calc(100% - 1.7916666667em);
            }

            .mat-form-field-appearance-legacy .mat-form-field-wrapper {
                padding-bottom: 1.25em;
            }

            .mat-form-field-appearance-legacy .mat-form-field-infix {
                padding: .4375em 0;
            }

            .mat-form-field-appearance-legacy.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {
                transform: translateY(-1.28125em) scale(.75) perspective(100px) translateZ(.001px);
                width: 133.3333333333%;
            }

            .mat-form-field-appearance-legacy .mat-form-field-label {
                top: 1.28125em;
            }

            .mat-form-field-appearance-legacy .mat-form-field-underline {
                bottom: 1.25em;
            }

            .mat-form-field-appearance-legacy .mat-form-field-subscript-wrapper {
                margin-top: .5416666667em;
                top: calc(100% - 1.6666666667em);
            }

            @media  print {
                .mat-form-field-appearance-legacy.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {
                    transform: translateY(-1.28122em) scale(.75);
                }
            }
            .mat-select {
                font-family: Open Sans;
            }

            .mat-select-trigger {
                height: 1.125em;
            }

            .mat-table {
                font-family: Open Sans;
            }

            .mat-header-cell {
                font-size: 12px;
                font-weight: 400;
            }

            .mat-cell {
                font-size: 14px;
            }

            .mat-form-field {
                font-size: inherit;
                font-weight: 400;
                line-height: 1.125;
                font-family: Open Sans;
                letter-spacing: normal;
            }

            .mat-form-field-wrapper {
                padding-bottom: 1.34375em;
            }

            .mat-form-field-infix {
                padding: .5em 0;
                border-top: .84375em solid transparent;
            }

            .mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {
                transform: translateY(-1.34373em) scale(.75);
                width: 133.3333533333%;
            }

            .mat-form-field-label-wrapper {
                top: -.84375em;
                padding-top: .84375em;
            }

            .mat-form-field-label {
                top: 1.34375em;
            }

            .mat-form-field-underline {
                bottom: 1.34375em;
            }

            .mat-form-field-subscript-wrapper {
                font-size: 75%;
                margin-top: .6666666667em;
                top: calc(100% - 1.7916666667em);
            }

            .mat-form-field-appearance-legacy .mat-form-field-wrapper {
                padding-bottom: 1.25em;
            }

            .mat-form-field-appearance-legacy .mat-form-field-infix {
                padding: .4375em 0;
            }

            .mat-form-field-appearance-legacy.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {
                transform: translateY(-1.28125em) scale(.75) perspective(100px) translateZ(.00106px);
                width: 133.3333933333%;
            }

            .mat-form-field-appearance-legacy .mat-form-field-label {
                top: 1.28125em;
            }

            .mat-form-field-appearance-legacy .mat-form-field-underline {
                bottom: 1.25em;
            }

            .mat-form-field-appearance-legacy .mat-form-field-subscript-wrapper {
                margin-top: .5416666667em;
                top: calc(100% - 1.6666666667em);
            }

            @media  print {
                .mat-form-field-appearance-legacy.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {
                    transform: translateY(-1.28116em) scale(.75);
                }
            }
            .mat-select {
                font-family: Open Sans;
            }

            .mat-select-trigger {
                height: 1.125em;
            }

            .mat-focus-indicator {
                position: relative;
            }

            .mat-focus-indicator:before {
                inset: 0;
                position: absolute;
                box-sizing: border-box;
                pointer-events: none;
                display: none;
                display: var(--mat-focus-indicator-display, none);
                border: 3px solid transparent;
                border: var(--mat-focus-indicator-border-width, 3px) var(--mat-focus-indicator-border-style, solid) var(--mat-focus-indicator-border-color, transparent);
                border-radius: 4px;
                border-radius: var(--mat-focus-indicator-border-radius, 4px);
            }

            .mat-focus-indicator:focus:before {
                content: "";
            }

            .mat-table {
                background: white;
            }

            .mat-table thead, .mat-table tbody, .mat-table tfoot, [mat-header-row], [mat-row], .mat-table-sticky {
                background: inherit;
            }

            th.mat-header-cell, td.mat-cell {
                border-bottom-color: #0000001f;
            }

            .mat-header-cell {
                color: #0000008a;
            }

            .mat-cell {
                color: #000000de;
            }

            .mat-form-field-label {
                color: #0009;
            }

            .mat-form-field-ripple {
                background-color: #000000de;
            }

            .mat-form-field-appearance-legacy .mat-form-field-label {
                color: #0000008a;
            }

            .mat-form-field-appearance-legacy .mat-form-field-underline {
                background-color: #0000006b;
            }

            .mat-select-value {
                color: #000000de;
            }

            .mat-select-arrow {
                color: #0000008a;
            }

            .mat-sort-header-arrow {
                color: #757575;
            }

            .mat-cell {
                color: #4a4a4ae6 !important;
            }

            .mat-header-cell {
                font-size: 14px !important;
            }

            .mat-form-field-underline {
                background-image: none !important;
            }

            .no-focus:not(:focus-within) {
                outline: none;
            }

            .mat-form-field-underline {
                background-color: #e8e8e8 !important;
            }
        }

        /*! CSS Used from: Embedded */
        .test-results .summary-stats {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 65px;
            margin-bottom: 52px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .test-results .summary-stats .score-stats {
            margin-right: 140px;
            width: 350px;
        }

        .test-results .summary-stats .score-stats .stats-area {
            position: relative;
            height: 100px;
            display: flex;
            align-items: center;
        }

        .test-results .summary-stats .score-stats .stats-area .user-score {
            position: absolute;
            top: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 40px;
            margin-left: -20px;
            z-index: 2;
            color: #69c869;
        }

        .test-results .summary-stats .score-stats .stats-area .user-score span {
            font-size: 15px;
            font-weight: 600;
        }

        .test-results .summary-stats .score-stats .stats-area .user-score i {
            margin-top: -3px;
        }

        .test-results .summary-stats .score-stats .stats-area .average-score-line {
            position: absolute;
            top: 33px;
            width: 2px;
            height: 35px;
            background-color: #4aa44a;
            z-index: 2;
        }

        .test-results .summary-stats .score-stats .stats-area .average-score-line.on-right {
            background-color: #e3e3e3;
        }

        .test-results .summary-stats .score-stats .stats-area .average-score-line .average-score {
            width: 75px;
            margin-left: -37.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 42px;
            height: 38px;
            border-radius: 2px;
            background-color: #f4f5f7;
            color: #757575;
            font-size: 13px;
        }

        .test-results .summary-stats .score-stats .stats-area .average-score-line .average-score .arrow-up-div {
            position: absolute;
            bottom: 100%;
            left: 44%;
            width: 0px;
            height: 0px;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid #F4F5F7;
        }

        .test-results .summary-stats .score-stats .stats-area .score-bar {
            position: relative;
            width: 100%;
            height: 35px;
            border-radius: 17.5px;
            background-color: #f4f5f7;
            overflow: hidden;
        }

        .test-results .summary-stats .score-stats .stats-area .score-bar .user-score-bar {
            position: absolute;
            height: 100%;
            top: 0;
            left: 0;
            background-color: #69c869;
        }

        .test-results .summary-stats .test-stats {
            min-width: 350px;
        }

        .test-results .summary-stats .test-stats .stats-area {
            height: 100px;
        }

        .test-results .summary-stats .test-stats .stats-area > div:first-child {
            border-bottom: 1px solid #E7EAEC;
        }

        .test-results .summary-stats .test-stats .stats-area > div {
            height: 50%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #757575;
            font-size: 15px;
        }

        .test-results .summary-stats .test-stats .stats-area .stats-tags {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .test-results .summary-stats .test-stats .stats-area .stats-tags .stats-tag {
            margin-left: 5px;
            height: 26px;
            border-radius: 17.5px;
            background-color: #f4f5f7;
            font-size: 12px;
            color: #757575;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-left: 10px;
            padding-right: 10px;
        }

        .test-results .summary-stats .stats-title {
            margin-bottom: 20px;
            color: #313131;
            font-size: 16px;
        }

        .test-results .questions-filter-div {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .test-results .questions-filter-div span {
            color: #979797;
            font-size: 15px;
        }

        .test-results .questions-filter-div .question-mode-dropdown {
            margin-right: 40px;
            margin-left: 15px;
        }

        .test-results .questions-filter-div .question-mode-dropdown .mat-form-field-underline {
            background-color: #e8e8e8;
        }

        .test-results .questions-info-table-div table {
            width: 100%;
            table-layout: fixed;
        }

        .test-results .questions-info-table-div table th {
            color: #979797;
        }

        .test-results .questions-info-table-div table td {
            padding-right: 10px;
        }

        .test-results .questions-info-table-div table th, .test-results .questions-info-table-div table td {
            width: 10% !important;
        }

        .test-results .questions-info-table-div table th.mid-column, .test-results .questions-info-table-div table td.mid-column {
            width: 15% !important;
        }

        .test-results .questions-info-table-div table th.large-column, .test-results .questions-info-table-div table td.large-column {
            width: 20% !important;
        }

        .test-results .questions-info-table-div table th.mat-header-cell:first-of-type, .test-results .questions-info-table-div table td.mat-cell:first-of-type {
            padding-left: 16px !important;
        }

        .test-results .questions-info-table-div table th.ellipsis-overflow, .test-results .questions-info-table-div table td.ellipsis-overflow {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 20% !important;
        }

        .test-results .questions-info-table-div table tr.mat-row {
            height: 70px;
        }

        .test-results .questions-info-table-div table td.mat-cell {
            color: #313131 !important;
            border-bottom-color: #e8e8e8;
        }

        .test-results .questions-info-table-div table .flag-column {
            text-align: right;
            padding-right: 30px;
            width: 90px !important;
        }

        .test-results .questions-info-table-div table .flag-column > div {
            display: inline-block;
            width: 50%;
            text-align: center;
        }

        .test-results .questions-info-table-div table .flag-column div:first-child {
            padding-right: 5px;
        }

        .test-results .questions-info-table-div table .flag-column .fa-bookmark {
            color: #1e88e5;
        }

        .test-results .questions-info-table-div table .flag-column .fa-check {
            color: #66b847;
        }

        .test-results .questions-info-table-div table .flag-column .fa-times {
            color: #df4545;
        }

        .test-results .questions-info-table-div table .flag-column .fa-minus-circle {
            color: #689bf6;
        }

        .test-results .questions-info-table-div table .flag-column-header {
            width: 90px !important;
        }

        .test-results .questions-info-table-div table .last-column {
            width: 50px !important;
            color: #1e88e5 !important;
            cursor: pointer;
            text-align: center;
            padding-left: 0 !important;
        }

        .test-results .questions-info-table-div table .last-column-header {
            width: 50px !important;
        }

        .launch-question:hover {
            cursor: pointer;
            background-color: #f9f9f9;
        }

        /*! CSS Used from: Embedded */
        .mat-form-field {
            display: inline-block;
            position: relative;
            text-align: left;
        }

        .mat-form-field-wrapper {
            position: relative;
        }

        .mat-form-field-flex {
            display: inline-flex;
            align-items: baseline;
            box-sizing: border-box;
            width: 100%;
        }

        .mat-form-field-infix {
            display: block;
            position: relative;
            flex: auto;
            min-width: 0;
            width: 180px;
        }

        .mat-form-field-label-wrapper {
            position: absolute;
            left: 0;
            box-sizing: content-box;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .mat-form-field-label {
            position: absolute;
            left: 0;
            font: inherit;
            pointer-events: none;
            width: 100%;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            transform-origin: 0 0;
            transition: transform 400ms cubic-bezier(0.25, 0.8, 0.25, 1), color 400ms cubic-bezier(0.25, 0.8, 0.25, 1), width 400ms cubic-bezier(0.25, 0.8, 0.25, 1);
            display: none;
        }

        .mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {
            display: block;
        }

        .mat-form-field-label:not(.mat-form-field-empty) {
            transition: none;
        }

        .mat-form-field-underline {
            position: absolute;
            width: 100%;
            pointer-events: none;
            transform: scale3d(1, 1.0001, 1);
        }

        .mat-form-field-ripple {
            position: absolute;
            left: 0;
            width: 100%;
            transform-origin: 50%;
            transform: scaleX(0.5);
            opacity: 0;
            transition: background-color 300ms cubic-bezier(0.55, 0, 0.55, 0.2);
        }

        .mat-form-field-subscript-wrapper {
            position: absolute;
            box-sizing: border-box;
            width: 100%;
            overflow: hidden;
        }

        .mat-form-field-hint-wrapper {
            display: flex;
        }

        .mat-form-field-hint-spacer {
            flex: 1 0 1em;
        }

        /*! CSS Used from: Embedded */
        .mat-form-field-appearance-legacy .mat-form-field-label {
            transform: perspective(100px);
        }

        .mat-form-field-appearance-legacy .mat-form-field-underline {
            height: 1px;
        }

        .mat-form-field-appearance-legacy .mat-form-field-ripple {
            top: 0;
            height: 2px;
            overflow: hidden;
        }

        /*! CSS Used from: Embedded */
        .mat-select {
            display: inline-block;
            width: 100%;
            outline: none;
        }

        .mat-select-trigger {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            position: relative;
            box-sizing: border-box;
            width: 100%;
        }

        .mat-select-value {
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .mat-select-value-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .mat-select-arrow-wrapper {
            height: 16px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
        }

        .mat-select-arrow {
            width: 0;
            height: 0;
            border-left: 5px solid rgba(0, 0, 0, 0);
            border-right: 5px solid rgba(0, 0, 0, 0);
            border-top: 5px solid;
            margin: 0 4px;
        }

        .mat-form-field-type-mat-select:not(.mat-form-field-disabled) .mat-form-field-flex {
            cursor: pointer;
        }

        .mat-form-field-type-mat-select .mat-form-field-label {
            width: calc(100% - 18px);
        }

        /*! CSS Used from: Embedded */
        table.mat-table {
            border-spacing: 0;
        }

        tr.mat-header-row {
            height: 56px;
        }

        tr.mat-row {
            height: 48px;
        }

        th.mat-header-cell {
            text-align: left;
        }

        th.mat-header-cell, td.mat-cell {
            padding: 0;
            border-bottom-width: 1px;
            border-bottom-style: solid;
        }

        th.mat-header-cell:first-of-type, td.mat-cell:first-of-type {
            padding-left: 24px;
        }

        th.mat-header-cell:last-of-type, td.mat-cell:last-of-type {
            padding-right: 24px;
        }

        .mat-table-sticky {
            position: sticky !important;
        }

        /*! CSS Used from: Embedded */
        .mat-sort-header-container {
            display: flex;
            cursor: pointer;
            align-items: center;
            letter-spacing: normal;
            outline: 0;
        }

        .mat-sort-header-container::before {
            margin: calc(calc(var(--mat-focus-indicator-border-width, 3px) + 2px) * -1);
        }

        .mat-sort-header-content {
            text-align: center;
            display: flex;
            align-items: center;
        }

        .mat-sort-header-arrow {
            height: 12px;
            width: 12px;
            min-width: 12px;
            position: relative;
            display: flex;
            opacity: 0;
        }

        .mat-sort-header-arrow {
            margin: 0 0 0 6px;
        }

        .mat-sort-header-stem {
            background: currentColor;
            height: 10px;
            width: 2px;
            margin: auto;
            display: flex;
            align-items: center;
        }

        .mat-sort-header-indicator {
            width: 100%;
            height: 2px;
            display: flex;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
        }

        .mat-sort-header-pointer-middle {
            margin: auto;
            height: 2px;
            width: 2px;
            background: currentColor;
            transform: rotate(45deg);
        }

        .mat-sort-header-pointer-left, .mat-sort-header-pointer-right {
            background: currentColor;
            width: 6px;
            height: 2px;
            position: absolute;
            top: 0;
        }

        .mat-sort-header-pointer-left {
            transform-origin: right;
            left: 0;
        }

        .mat-sort-header-pointer-right {
            transform-origin: left;
            right: 0;
        }

        /*! CSS Used fontfaces */
        @font-face {
            font-family: "Font Awesome 5 Pro";
            font-style: normal;
            font-weight: 300;
            font-display: auto;
            src: url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-light-300.eot);
            src: url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-light-300.eot?#iefix) format("embedded-opentype"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-light-300.woff2) format("woff2"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-light-300.woff) format("woff"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-light-300.ttf) format("truetype"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-light-300.svg#fontawesome) format("svg");
        }

        @font-face {
            font-family: "Font Awesome 5 Pro";
            font-style: normal;
            font-weight: 400;
            font-display: auto;
            src: url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-regular-400.eot);
            src: url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-regular-400.eot?#iefix) format("embedded-opentype"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-regular-400.woff2) format("woff2"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-regular-400.woff) format("woff"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-regular-400.ttf) format("truetype"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-regular-400.svg#fontawesome) format("svg");
        }

        @font-face {
            font-family: "Font Awesome 5 Pro";
            font-style: normal;
            font-weight: 900;
            font-display: auto;
            src: url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-solid-900.eot);
            src: url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-solid-900.eot?#iefix) format("embedded-opentype"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-solid-900.woff2) format("woff2"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-solid-900.woff) format("woff"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-solid-900.ttf) format("truetype"), url(https://apps.uworld.com/assets/plugins/fontawesome-pro-5.10.1/webfonts/fa-solid-900.svg#fontawesome) format("svg");
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSKmu1aB.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSumu1aB.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSOmu1aB.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSymu1aB.woff2) format('woff2');
            unicode-range: U+0370-03FF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTS2mu1aB.woff2) format('woff2');
            unicode-range: U+0590-05FF, U+200C-2010, U+20AA, U+25CC, U+FB1D-FB4F;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSCmu1aB.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSGmu1aB.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTS-muw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSKmu1aB.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSumu1aB.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSOmu1aB.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSymu1aB.woff2) format('woff2');
            unicode-range: U+0370-03FF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTS2mu1aB.woff2) format('woff2');
            unicode-range: U+0590-05FF, U+200C-2010, U+20AA, U+25CC, U+FB1D-FB4F;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSCmu1aB.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSGmu1aB.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTS-muw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 500;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSKmu1aB.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 500;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSumu1aB.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 500;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSOmu1aB.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 500;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSymu1aB.woff2) format('woff2');
            unicode-range: U+0370-03FF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 500;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTS2mu1aB.woff2) format('woff2');
            unicode-range: U+0590-05FF, U+200C-2010, U+20AA, U+25CC, U+FB1D-FB4F;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 500;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSCmu1aB.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 500;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSGmu1aB.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 500;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTS-muw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 600;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSKmu1aB.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 600;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSumu1aB.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 600;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSOmu1aB.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 600;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSymu1aB.woff2) format('woff2');
            unicode-range: U+0370-03FF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 600;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTS2mu1aB.woff2) format('woff2');
            unicode-range: U+0590-05FF, U+200C-2010, U+20AA, U+25CC, U+FB1D-FB4F;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 600;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSCmu1aB.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 600;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSGmu1aB.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 600;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTS-muw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSKmu1aB.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSumu1aB.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSOmu1aB.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSymu1aB.woff2) format('woff2');
            unicode-range: U+0370-03FF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTS2mu1aB.woff2) format('woff2');
            unicode-range: U+0590-05FF, U+200C-2010, U+20AA, U+25CC, U+FB1D-FB4F;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSCmu1aB.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTSGmu1aB.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/opensans/v35/memvYaGs126MiZpBA-UvWbX2vVnXBbObj2OVTS-muw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
    </style>

    <style>
        .test-nav:hover{
            background: unset;
        }
        .test-nav:active{
            background: gray;
        }
    </style>

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
         @extend    .iconSettings;
             content : '\2b';
             font-size: 29px;
         }
        }

        tr.shown td.details-control {
        &:before {
         @extend    .iconSettings;
             content : '\2212';
             padding: unset;
         }
        }


    </style>

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
                                                <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0 fs-19"
                                                    role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <a id="result1" class="test-nav nav-link text-muted active" data-bs-toggle="tab"
                                                           href="#test_results"
                                                           role="tab" aria-selected="false" tabindex="-1">
                                                            Mocks Results
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a id="analytics1" class="test-nav nav-link text-muted" data-bs-toggle="tab" href="#test_analytics"
                                                           role="tab" aria-selected="false" tabindex="-1">
                                                            Mocks Analytics
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="flex-grow-1 oveflow-hidden">
                                                <p class="text-muted text-truncates mb-0 float-end fs-14">Mocks
                                                    ID: hash-10032023-97989892959595 <i class="la la-info-circle text-blue fs-18 ms-2"></i>
                                                </p>
                                            </div>

                                        </div>


                                        <div class="card-body">


                                             <!--tab start -->
                                            <div class="tab-content text-muted">
                                                <div class="tab-pane active show" id="test_results" role="tabpanel">



                                                    <div class="test-results">
                                                        <div class="summary-stats">
                                                            <div class="score-stats">
                                                                <div class="stats-title">Your Score</div>
                                                                <div class="stats-area ng-star-inserted" style="">
                                                                    <div class="user-score" style="left: 0%;">
                                                                        <span>0%</span><i
                                                                                class="la la-caret-down"></i></div>
                                                                    <div class="average-score-line on-right"
                                                                         style="left: 61%;">
                                                                        <div class="average-score"> Avg:&nbsp;61%
                                                                            <div class="arrow-up-div"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="score-bar">
                                                                        <div class="user-score-bar"
                                                                             style="width: 0%;"></div>
                                                                    </div>
                                                                </div><!----></div>

                                                        </div>
                                                    </div>


                                                <!--<div class="table-responsive table-card mt-3 mb-1">-->

                                                    <div class="row">

                                                        <table id="datatables-example" class="table"></table>

                                                    </div>


                                                </div>
                                                <div class="tab-pane" id="test_analytics" role="tabpanel">
                                                   <!--analytics graph start-->
                                                    <div class="row">


                                                        <div class="col-xxl-3 col-sm-6 col-lg-3">
                                                            <!--//-->
                                                            <div class="card-body">
                                                                <div id="portfolio_donut_charts" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                                            </div><!-- end card body -->
                                                            <!--//-->
                                                        </div>
                                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                                            <table class="table align-middle table-nowrap mb-0">
                                                                <h5 class="ms-2 score-title">Your Score</h5>
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Total Correct</a></th>
                                                                    <td> <div class="score-badge float-end">61</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Total Incorrect</a></th>
                                                                    <td> <div class="score-badge float-end">2</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Total Omitted</a></th>
                                                                    <td> <div class="score-badge float-end">3</div></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                                            <table class="table align-middle table-nowrap mb-0">
                                                                <h5 class="ms-2 score-title">Answer Changes</h5>
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Correct to Incorrect</a></th>
                                                                    <td> <div class="score-badge float-end">61</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Incorrect to Correct</a></th>
                                                                    <td> <div class="score-badge float-end">2</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Incorrect to Incorrect</a></th>
                                                                    <td> <div class="score-badge float-end">3</div></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>



                                                    </div>
                                                        <!--analytics graph end -->


                                                        <!-- table filter start-->
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

                                                    <!-- table filter end-->

                                                        <!--table start-->
                                                        <table id="employees" class="table table-striped" style="width:100%">
                                                            <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>NAME</th>
                                                                <th>USAGE</th>
                                                                <th>CORRECT</th>
                                                                <th>INCORRECT</th>
                                                                <th>OMITTED</th>
                                                                <th>P-RANK</th>
                                                            </tr>
                                                            </thead>
                                                        </table>

                                                        <!--table end-->




                                                </div>
                                                <!--tab end -->
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



<script>
    var csrfToken = $('[name="csrf_token"]').attr('content');

    setInterval(refreshToken, 600000); // 1 hour

    function refreshToken(){
        $.get('refresh-csrf').done(function(data){
            csrfToken = data; // the new token
        });
    }

    setInterval(refreshToken, 600000); // 1 hour

</script>



<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<!--datatable js-->
<script src="{{ asset('user/mock_user_assets/assets/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('user/mock_user_assets/assets/datatables/js/dataTables.bootstrap5.min.js') }}"></script>

<script src="https://cdn.datatables.net/staterestore/1.2.2/js/dataTables.stateRestore.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>


<script src="{{ asset('user/mock_user_assets/assets/js/pages/datatables.init.js') }}"></script>

    <script>
        function collapse(cell){
            var row = cell.parentElement;
            var target_row = row.parentElement.children[row.rowIndex + 1];
            if (target_row.style.display == 'table-row') {
                cell.innerHTML = '+';
                target_row.style.display = 'none';
            } else {
                cell.innerHTML = '-';
                target_row.style.display = 'table-row';
            }
        }
    </script>
    <script>
        $.extend($.fn.dataTable.defaults, {
            buttons: [],
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
            "info": false,
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
        $(".multiple_select").mousedown(function (e) {
            if (e.target.tagName == "OPTION") {
                return; //don't close dropdown if i select option
            }
            $(this).toggleClass('multiple_select_active'); //close dropdown if click inside <select> box
        });
        $(".multiple_select").on('blur', function (e) {
            $(this).removeClass('multiple_select_active'); //close dropdown if click outside <select>
        });

        $('.multiple_select option').mousedown(function (e) { //no ctrl to select multiple
            e.preventDefault();
            $(this).prop('selected', $(this).prop('selected') ? false : true); //set selected options on click
            $(this).parent().change(); //trigger change event
        });


        $("#myFilter").on('change', function () {
            var selected = $("#myFilter").val().toString(); //here I get all options and convert to string
            var document_style = document.documentElement.style;
            if (selected !== "")
                document_style.setProperty('--text', "'" + selected + "'");
            else
                document_style.setProperty('--text', "'Select values'");
        });
    </script>




    <script>
        $('.accordion_1').click(function () {
            if ($('.accordion_1_body').hasClass('hide')) {
                $('.accordion_1_body').removeClass('hide');
                $('.accordion_1_icon').removeClass('fa fa-angle-down');
                $('.accordion_1_icon').addClass('fa fa-angle-up');
                $('.panel-custom>.pb_1').css({"padding": ""});

            }
            else {
                $('.accordion_1_body').addClass('hide');
                $('.accordion_1_icon').removeClass('fa fa-angle-up');
                $('.accordion_1_icon').addClass('fa fa-angle-down');
                $('.panel-custom>.pb_1').css({"padding": "unset"});
            }
        });

        $('.accordion_2').click(function () {
            if ($('.accordion_2_body').hasClass('hide')) {
                $('.accordion_2_body').removeClass('hide');
                $('.accordion_2_icon').removeClass('fa fa-angle-down');
                $('.accordion_2_icon').addClass('fa fa-angle-up');
                $('.panel-custom>.pb_2').css({"padding": ""});
            }
            else {
                $('.accordion_2_body').addClass('hide');
                $('.accordion_2_icon').removeClass('fa fa-angle-up');
                $('.accordion_2_icon').addClass('fa fa-angle-down');
                $('.panel-custom>.pb_2').css({"padding": "unset"});
            }
        });
    </script>

    <script>
        $.extend($.fn.dataTable.defaults, {
            buttons: [
                // 'colvis',
                // {
                // extend: 'createState',
                // config: {
                // creationModal: true,
                // toggle: {
                // columns:{
                // search: true,
                // visible: true
                // }
                // }
                // }
                // },
                // 'savedStates'
            ],
            // Display
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
            // buttons: {
            //     buttons: [
            //
            //     ],
            //     dom: {
            //         container: { className: 'dt-buttons d-none d-md-flex flex-wrap' },
            //         buttonContainer: {},
            //         button: { className:'<i class="la la-play-circle la-lg pointer fs-22 cursor-pointer" style="color: blue"></i><i class="la la-tasks la-lg pointer fs-22 cursor-pointer ms-2" style="color: blue"></i><i class="bx bx-bar-chart pointer fs-22 cursor-pointer ms-2" style="color: blue"></i>' }
            //     }
            // },
            // Data display
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

        // <i class='la la-lg la-bookmark ng-star-inserted' style='color: blue;'></i>
        const dataSet = [
                                                    [" <i style='margin-left: 18px;'></i>   <i class='la la-lg la-times' style='color: red;'></i> ", "1652", " Anatomy", " Male Reproductive System", "Edinburgh", "2290", "ab", "02 secs", '<a href="https://uworld.aceamcq.com/user/review/exam/hash-10032023-97989892959595/125"><i class="la la-2x la-angle-right pointer fs-22 cursor-pointer ms-2"></i></a>'],
                                        [" <i style='margin-left: 18px;'></i>   <i class='la la-lg la-minus-circle ng-star-inserted' style='color: blue;'></i> ", "1653", " Anatomy", " Cardiovascular System", "Edinburgh", "2290", "ab", "00 secs", '<a href="https://uworld.aceamcq.com/user/review/exam/hash-10032023-97989892959595/127"><i class="la la-2x la-angle-right pointer fs-22 cursor-pointer ms-2"></i></a>'],
                                        [" <i style='margin-left: 18px;'></i>   <i class='la la-lg la-times' style='color: red;'></i> ", "1654", " Anatomy", " Ear, Nose &amp; Throat (ENT)", "Edinburgh", "2290", "ab", "02 secs", '<a href="https://uworld.aceamcq.com/user/review/exam/hash-10032023-97989892959595/128"><i class="la la-2x la-angle-right pointer fs-22 cursor-pointer ms-2"></i></a>'],
                                        [" <i style='margin-left: 18px;'></i>   <i class='la la-lg la-times' style='color: red;'></i> ", "1655", " Anatomy", " Cardiovascular System", "Edinburgh", "2290", "ab", "01 secs", '<a href="https://uworld.aceamcq.com/user/review/exam/hash-10032023-97989892959595/129"><i class="la la-2x la-angle-right pointer fs-22 cursor-pointer ms-2"></i></a>'],
                                        [" <i style='margin-left: 18px;'></i>   <i class='la la-lg la-minus-circle ng-star-inserted' style='color: blue;'></i> ", "1656", " Anatomy", " Cardiovascular System", "Edinburgh", "2290", "ab", "00 secs", '<a href="https://uworld.aceamcq.com/user/review/exam/hash-10032023-97989892959595/134"><i class="la la-2x la-angle-right pointer fs-22 cursor-pointer ms-2"></i></a>'],
                                ];


        $(function () {
            $('#datatables-example').DataTable({
                // Table data
                data: dataSet, // My JS array
                columns: [ // Define table Headers for each column
                    {},
                    {title: 'ID'},
                    {title: 'SUBJECTS'},
                    {title: 'SYSTEMS'},
                    {title: 'CATEGORIES'},
                    {title: 'TOPICS'},
                    {title: '% CORRECT OTHERS'},
                    {title: 'TIME SPENT'},
                    {}
                ],
                "columnDefs": [
                    {"width": "10%", "targets": [0, 8], 'orderable': false}
                ],
                "fnInitComplete": function (oSettings, json) {
                    $('.dataTables_filter input').attr('type', 'text');
                },
            })
            // .column([2]).visible(false) // Hide Office column for demo suitable width
                .on('page.dt', function () {
                    $('[data-toggle="tooltip"]').tooltip({placement: 'bottom'})
                })
        })
    </script>



    <script>
        function getChartColorsArray(e) {
            if (null !== document.getElementById(e)) {
                var t = document.getElementById(e).getAttribute("data-colors");
                if (t) return (t = JSON.parse(t)).map(function (e) {
                    var t = e.replace(" ", "");
                    return -1 === t.indexOf(",") ? getComputedStyle(document.documentElement).getPropertyValue(t) || t : 2 == (e = e.split(",")).length ? "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(e[0]) + "," + e[1] + ")" : t
                });
                console.warn("data-colors Attribute not found on:", e)
            }
        }

        var options, chart, donutchartportfolioColors = getChartColorsArray("anaylitics_charts"),
            MarketchartColors = (donutchartportfolioColors && (options = {
                series: [0, 60, 40],
                labels: ["Correct", "Incorrect", "Omitted"],
                chart: {type: "donut", height: 224},
                plotOptions: {
                    pie: {
                        size: 100,
                        offsetX: 0,
                        offsetY: 0,
                        donut: {
                            size: "86%",
                            labels: {
                                show: !0,
                                name: {show: !0, fontSize: "18px", offsetY: -5},
                                value: {
                                    show: !0,
                                    fontSize: "20px",
                                    color: "#343a40",
                                    fontWeight: 500,
                                    offsetY: 5,
                                    formatter: function (e) {
                                        return e + '%'
                                    }
                                },
                                total: {
                                    show: !0,
                                    fontSize: "13px",
                                    label: "Correct",
                                    color: "#9599ad",
                                    fontWeight: 500,
                                    formatter: function (e) {
                                        return e.globals.seriesTotals.reduce(function (e, t) {
                                            // return e + t
                                            return 0 + '%';
                                        }, 0)
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {enabled: !1},
                legend: {show: !1},
                yaxis: {
                    labels: {
                        formatter: function (e) {
                            return e + '%'
                        }
                    }
                },
                stroke: {lineCap: "round", width: 2},
                colors: donutchartportfolioColors
            }, (chart = new ApexCharts(document.querySelector("#anaylitics_charts"), options)).render()), getChartColorsArray("Market_chart")),
            areachartbitcoinColors = (MarketchartColors && (options = {
                    series: [{
                        data: []
                    }],
                    chart: {type: "candlestick", height: 294, toolbar: {show: !1}},
                    plotOptions: {candlestick: {colors: {upward: MarketchartColors[0], downward: MarketchartColors[1]}}},
                    xaxis: {type: "datetime"},
                    yaxis: {
                        // tooltip: {enabled: !0}, labels: {
                        //     formatter: function (e) {
                        //         return "$" + e
                        //     }
                        // }
                    },
                    // tooltip: {
                    //     shared: !0, y: [{
                    //         formatter: function (e) {
                    //             return void 0 !== e ? e.toFixed(0) : e
                    //         }
                    //     }, {
                    //         formatter: function (e) {
                    //             return void 0 !== e ? "$" + e.toFixed(2) + "k" : e
                    //         }
                    //     }, {
                    //         formatter: function (e) {
                    //             return void 0 !== e ? e.toFixed(0) + " Sales" : e
                    //         }
                    //     }]
                    // }
                }
            ));
    </script>






    <script>
        // Wait for the page to load
        document.addEventListener("DOMContentLoaded", function () {
            var hash = window.location.hash;
            // If a hash is present and corresponds to a tab, activate that tab
            if (hash) {
                var tabLink = document.querySelector('a[href="' + hash + '"]');
                if (tabLink) {
                    tabLink.click();
                }
            }
        });
    </script>




    <script>
        var subject_data = [


                                {
                id: "1",
                name: "<span> Anatomy</span><div class=\"progress mt-1\">\n" +
                "                                            <div class=\"progress-bar bg-primary\" role=\"progressbar\" style=\"width: 0%\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\n" +
                "                                        </div>",
                total_q: "5",
                correct: "0 (0%)",
                incorrect: "3 (60)%",
                ommitted: "2 (40)%"

            },


                                ];

                function sub_format45(d) {
            return (
                                                                                            '<table class="table mb-0 table-sub-rows">' +
                    '<tr class="table-primary">' +
                    // "<td> </td>" +
                    "<td>  Cardiovascular System </td>" +

                    "<td>3</td>" +
                    "<td>0 (0%) </td>" +
                    "<td>1 (33)% </td>" +
                    "<td>2 (67)% </td>" +
                    "</tr>" +
                    "</table>"+
                                                                '<table class="table mb-0 table-sub-rows">' +
                    '<tr class="table-primary">' +
                    // "<td> </td>" +
                    "<td>  Ear, Nose &amp; Throat (ENT) </td>" +

                    "<td>1</td>" +
                    "<td>0 (0%) </td>" +
                    "<td>1 (100)% </td>" +
                    "<td>0 (0%) </td>" +
                    "</tr>" +
                    "</table>"+
                                                                '<table class="table mb-0 table-sub-rows">' +
                    '<tr class="table-primary">' +
                    // "<td> </td>" +
                    "<td>  Male Reproductive System </td>" +

                    "<td>1</td>" +
                    "<td>0 (0%) </td>" +
                    "<td>1 (100)% </td>" +
                    "<td>0 (0%) </td>" +
                    "</tr>" +
                    "</table>"+
                                                                        ""

            );
        }


        $(document).ready(function () {
            var table = $("#tab_subjects").DataTable({
                paging: false,
                bFilter: false,
                data: subject_data,
                columns: [
                    {
                        className: "details-control",
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {data: "name"},
                    {data: "total_q"},
                    {data: "correct"},
                    {data: "incorrect"},
                    {data: "ommitted"},
                ],
                order: [[1, "asc"]],
                "fnInitComplete": function (oSettings, json) {
                    $('.dataTables_filter input').attr('type', 'text');
                    $('#tab_subjects').DataTable().search('').draw();
                }
            });

            table.rows().every(function(rowIdx) {
                var row = this.node();
                var uniqueId = generateUniqueId(rowIdx);

                $(row).attr('data-unique-id', uniqueId);
                $(row).attr('id', uniqueId);
            });
            function generateUniqueId(rowIdx) {
                var count = 1;
                // return "row_" + new Date().getTime() + "_" + Math.random().toString(36).substr(2, 9);
                return "row_" + "format" + "_" + (rowIdx);
            }

            $('#myInputTextField').keyup(function () {
                table.search($(this).val()).draw();
            });
            // $("#tab_subjects tbody").on("click", "td.details-control", function () {
            //     var tr = $(this).closest("tr");
            //     var row = table.row(tr);
            //
            //     if (row.child.isShown()) {
            //         row.child.hide();
            //         tr.removeClass("shown");
            //     } else {
            //
            //         row.child(format(row.data()), "p-0").show();
            //         tr.addClass("shown");
            //     }
            // });
        });

                                $(document).on('click', "[data-unique-id = 'row_format_0']", function () {
            var table = $('#tab_subjects').DataTable();
            var tr = $(this).closest("tr");
            var row = table.row(tr);


            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass("shown");
            } else {
                row.child(sub_format45(row.data()), "p-0").show();
                tr.addClass("shown");
            }
        });
                    </script>

    <script>
        var system_data = [
                                                            {
                id: "1",
                name: "<span> Cardiovascular System</span><div class=\"progress mt-1\">\n" +
                "                                            <div class=\"progress-bar bg-primary\" role=\"progressbar\" style=\"width: 0%\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\n" +
                "                                        </div>",
                total_q: "3",
                correct: "0 (0%)",
                incorrect: "1 (33)%",
                ommitted: "2 (67)%"

            },

                                        {
                id: "1",
                name: "<span> Ear, Nose &amp; Throat (ENT)</span><div class=\"progress mt-1\">\n" +
                "                                            <div class=\"progress-bar bg-primary\" role=\"progressbar\" style=\"width: 0%\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\n" +
                "                                        </div>",
                total_q: "1",
                correct: "0 (0%)",
                incorrect: "1 (100)%",
                ommitted: "0 (0%)"

            },

                                        {
                id: "1",
                name: "<span> Male Reproductive System</span><div class=\"progress mt-1\">\n" +
                "                                            <div class=\"progress-bar bg-primary\" role=\"progressbar\" style=\"width: 0%\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\n" +
                "                                        </div>",
                total_q: "1",
                correct: "0 (0%)",
                incorrect: "1 (100)%",
                ommitted: "0 (0%)"

            },

                                ];


                                function format56(d) {
            return (
                                                                                            '<table class="table mb-0 table-sub-rows" style="margin-left:unset">' +
                    '<tr class="table-primary">' +
                    "<td style='width: 28px;'> </td>" +
                    "<td style='width: 17%;'>  Anatomy </td>" +
                    "<td style='padding-left: 107px;'>3</td>" +
                    "<td style='padding-left: 61px;'>0 (0%) </td>" +
                    "<td style='padding-left: 66px;'>1 (33)% </td>" +
                    "<td style='width: 134px;padding-left: 106px;'>2 (67)% </td>" +
                    "</tr>" +
                    "</table>"+
                                                                        ""

            );
        }

                        function format57(d) {
            return (
                                                                                            '<table class="table mb-0 table-sub-rows" style="margin-left:unset">' +
                    '<tr class="table-primary">' +
                    "<td style='width: 28px;'> </td>" +
                    "<td style='width: 17%;'>  Anatomy </td>" +
                    "<td style='padding-left: 107px;'>1</td>" +
                    "<td style='padding-left: 61px;'>0 (0%) </td>" +
                    "<td style='padding-left: 66px;'>1 (100)% </td>" +
                    "<td style='width: 134px;padding-left: 106px;'>0 (0%) </td>" +
                    "</tr>" +
                    "</table>"+
                                                                        ""

            );
        }

                        function format63(d) {
            return (
                                                                                            '<table class="table mb-0 table-sub-rows" style="margin-left:unset">' +
                    '<tr class="table-primary">' +
                    "<td style='width: 28px;'> </td>" +
                    "<td style='width: 17%;'>  Anatomy </td>" +
                    "<td style='padding-left: 107px;'>1</td>" +
                    "<td style='padding-left: 61px;'>0 (0%) </td>" +
                    "<td style='padding-left: 66px;'>1 (100)% </td>" +
                    "<td style='width: 134px;padding-left: 106px;'>0 (0%) </td>" +
                    "</tr>" +
                    "</table>"+
                                                                        ""

            );
        }


        $(document).ready(function () {
            var table = $("#tab_systems").DataTable({
                paging: false,
                bFilter: false,
                data: system_data,
                columns: [
                    {
                        className: "details-control",
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {data: "name"},
                    {data: "total_q"},
                    {data: "correct"},
                    {data: "incorrect"},
                    {data: "ommitted"}
                ],
                order: [[1, "asc"]],
                "fnInitComplete": function (oSettings, json) {
                    $('.dataTables_filter input').attr('type', 'text');
                    $('#tab_systems').DataTable().search('').draw();
                }
            });

            table.rows().every(function(rowIdx) {
                var row = this.node();
                var uniqueId = generateUniqueId(rowIdx);

                $(row).attr('data-unique-id', uniqueId);
            });
            function generateUniqueId(rowIdx) {
                var count = 1;
                // return "row_" + new Date().getTime() + "_" + Math.random().toString(36).substr(2, 9);
                return "row_" + "format2" + "_" + (rowIdx);
            }

            $('#myInputTextField').keyup(function () {
                table.search($(this).val()).draw();
            });
        });

                        $(document).on('click', "[data-unique-id = 'row_format2_0']", function () {
            var table = $('#tab_systems').DataTable();
            var tr = $(this).closest("tr");
            var row = table.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass("shown");
            } else {
                row.child(format56(row.data()), "p-0").show();
                tr.addClass("shown");
            }

        });
                $(document).on('click', "[data-unique-id = 'row_format2_1']", function () {
            var table = $('#tab_systems').DataTable();
            var tr = $(this).closest("tr");
            var row = table.row(tr);


            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass("shown");
            } else {
                row.child(format57(row.data()), "p-0").show();
                tr.addClass("shown");
            }

        });
                $(document).on('click', "[data-unique-id = 'row_format2_2']", function () {
            var table = $('#tab_systems').DataTable();
            var tr = $(this).closest("tr");
            var row = table.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass("shown");
            } else {
                row.child(format63(row.data()), "p-0").show();
                tr.addClass("shown");
            }

        });

    </script>


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
    var data = [
        {
            id: "1",
            name: "<span>BioChemistry</span>" +
               "<div class=\"progress mt-1\" style=\"height:5px\">" +
               "<div class=\"progress-bar bg-primary\" role=\"progressbar\" style=\"width: 15%\" aria-valuenow=\"15\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 30%\" aria-valuenow=\"30\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-warning\" role=\"progressbar\" style=\"width: 40%\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-danger\" role=\"progressbar\" style=\"width: 60%\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "</div>",
            usage: "8/33",
            correct: "2(80%)",
            incorrect: "2(81%)",
            ommitted: "0(0%)",
            p_rank: "67th",
            extn: "5421"
        },
        {
            id: "2",
            name: "<span>Anotmy</span>" +
               "<div class=\"progress mt-1\" style=\"height:5px\">" +
               "<div class=\"progress-bar bg-primary\" role=\"progressbar\" style=\"width: 15%\" aria-valuenow=\"15\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 30%\" aria-valuenow=\"30\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-warning\" role=\"progressbar\" style=\"width: 40%\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-danger\" role=\"progressbar\" style=\"width: 60%\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "</div>",
            usage: "1/33",
            correct: "22(45%)",
            incorrect: "12(82%)",
            ommitted: "0(0%)",
            p_rank: "37th",
            extn: "54212"
        }
    ];

    function format(d) {
        return (
            '<table class="table mb-0 table-sub-rows">' +
            '<tr class="table-primary">' +
            "<td>Ear, Nose & Throat (ENT)</td>" +
            "<td>" + d.extn + "</td>" +
            "<td>1/14</td>" +
            "<td>1 (100%)</td>" +
            "<td>0 (0%)</td>" +
            "<td>-</td>" +
            "</tr>" +
            '<tr class="table-primary">' +
            "<td>Ear, Nose & Throat (ENT)</td>" +
            "<td>" + d.extn + "</td>" +
            "<td>1/14</td>" +
            "<td>1 (100%)</td>" +
            "<td>0 (0%)</td>" +
            "<td>-</td>" +
            "</tr>" +
            "</table>"
        );
    }

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
                { data: "usage" },
                { data: "correct" },
                { data: "incorrect" },
                { data: "ommitted" },
                { data: "p_rank" },
                { data: "extn", visible: false }
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
<script>
    $(".multiple_select").mousedown(function(e) {
        if (e.target.tagName == "OPTION")
        {
            return; //don't close dropdown if i select option
        }
        $(this).toggleClass('multiple_select_active'); //close dropdown if click inside <select> box
    });
    $(".multiple_select").on('blur', function(e) {
        $(this).removeClass('multiple_select_active'); //close dropdown if click outside <select>
    });

    $('.multiple_select option').mousedown(function(e) { //no ctrl to select multiple
        e.preventDefault();
        $(this).prop('selected', $(this).prop('selected') ? false : true); //set selected options on click
        $(this).parent().change(); //trigger change event
    });


    $("#myFilter").on('change', function() {
        var selected = $("#myFilter").val().toString(); //here I get all options and convert to string
        var document_style = document.documentElement.style;
        if(selected !== "")
            document_style.setProperty('--text', "'"+selected+"'");
        else
            document_style.setProperty('--text', "'Select values'");
    });
</script>

<script>

$(document).ready(function() {
    var resultValue = '{{$result}}'; // Assuming that $result is already set as a JavaScript variable in your Blade view

    // Get references to the tab elements using jQuery
    var testAnalyticsTab = $('#test_analytics');
    var testResultsTab = $('#test_results');

    if (typeof resultValue === 'string' && resultValue.trim() !== '') {
        if (resultValue === '#test_analytics') {
            // Make the 'test_analytics' tab active and 'test_results' tab inactive
            testAnalyticsTab.addClass('active');
            testResultsTab.removeClass('active');
            $('#result1').removeClass('active');
            $('#analytics1').addClass('active');
        } else {
            // Make the 'test_results' tab active and 'test_analytics' tab inactive
            testResultsTab.addClass('active');
            testAnalyticsTab.removeClass('active');
            $('#result1').addClass('active');
            $('#analytics1').removeClass('active');
        }
    }
});




</script>








@endsection
