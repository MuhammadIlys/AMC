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
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link href="https://uworld.aceamcq.com/Themes/themeone/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">





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
                                                <p class="text-muted text-truncates mb-0 float-end fs-14">Custom Mocks
                                                    ID: {{ $custom_mocks_id }} <i class="la la-info-circle text-blue fs-18 ms-2"></i>
                                                </p>
                                            </div>

                                        </div>


                                        <div class="card-body">


                                             <!--tab start -->
                                            <div class="tab-content text-muted">
                                                <div class="tab-pane active show" id="test_results" role="tabpanel">


                                                 <!-- result progress bar design start-->

                                                    @if ($userCustomMocks->test_status == 'Pass')

                                                    <div class="row" style="padding-left:80px">

                                                        <div class="col-6">
                                                            <div class="test-results">
                                                                <div class="summary-stats">
                                                                    <div class="score-stats">
                                                                        <div class="stats-title">Your Percentage</div>
                                                                        <div class="stats-area ng-star-inserted" style="">
                                                                            <div class="user-score" style="left: {{ $userCustomMocks->perscent }}%;">
                                                                                <span>{{ $userCustomMocks->perscent}}%</span><i class="la la-caret-down"></i>
                                                                            </div>
                                                                            <div class="average-score-line on-right" style="left: 61%;">
                                                                                <div class="average-score"> Avg:&nbsp;61%
                                                                                    <div class="arrow-up-div"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="score-bar">
                                                                                <div class="user-score-bar" style="width: {{ $userCustomMocks->perscent  }}%;"></div>
                                                                            </div>
                                                                        </div><!---->
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-6">

                                                            <div class="test-results">
                                                                <div class="summary-stats">
                                                                    <div class="score-stats">
                                                                        <div class="stats-title">Your Score</div>
                                                                        <div class="stats-area ng-star-inserted" style="">
                                                                            <div class="user-score" style="left: {{ ($userCustomMocks->score*100)/500 }}%;">
                                                                                <span>{{ $userCustomMocks->score}}</span><i class="la la-caret-down"></i>
                                                                            </div>
                                                                            <div class="average-score-line on-right" style="left: 61%;">
                                                                                <div class="average-score"> Avg:&nbsp;255
                                                                                    <div class="arrow-up-div"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="score-bar">
                                                                                <div class="user-score-bar" style="width: {{ ($userCustomMocks->score*100)/500   }}%;"></div>
                                                                            </div>
                                                                        </div><!---->
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                @else



                                                 <div class="row" style="padding-left:80px">

                                                        <div class="col-6">
                                                            <div class="test-results">
                                                                <div class="summary-stats">
                                                                    <div class="score-stats">
                                                                        <div class="stats-title">Your Percentage</div>
                                                                        <div class="stats-area ng-star-inserted" style="">
                                                                            <div class="user-score" style="left: {{ $userCustomMocks->perscent }}%; color:red;">
                                                                                <span>{{ $userCustomMocks->perscent}}%</span><i class="la la-caret-down"></i>
                                                                            </div>
                                                                            <div class="average-score-line on-right" style="left: 61%; ">
                                                                                <div class="average-score"> Avg:&nbsp;61%
                                                                                    <div class="arrow-up-div"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="score-bar">
                                                                                <div class="user-score-bar" style="width: {{ $userCustomMocks->perscent  }}%; background-color:red;"></div>
                                                                            </div>
                                                                        </div><!---->
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-6">

                                                            <div class="test-results">
                                                                <div class="summary-stats">
                                                                    <div class="score-stats">
                                                                        <div class="stats-title">Your Score</div>
                                                                        <div class="stats-area ng-star-inserted" style="">
                                                                            <div class="user-score" style="left: {{ ($userCustomMocks->score*100)/500 }}%; color:red;">
                                                                                <span>{{ $userCustomMocks->score}}</span><i class="la la-caret-down"></i>
                                                                            </div>
                                                                            <div class="average-score-line on-right" style="left: 61%;">
                                                                                <div class="average-score"> Avg:&nbsp;255
                                                                                    <div class="arrow-up-div"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="score-bar">
                                                                                <div class="user-score-bar" style="width: {{ ($userCustomMocks->score*100)/500   }}%; background-color:red;"></div>
                                                                            </div>
                                                                        </div><!---->
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                @endif

                                            </div>

                                                <!-- result progress bar design end-->






                                                <!--<div class="table-responsive table-card mt-3 mb-1">-->

                                                    <div class="row">

                                                        <table id="datatables-example2" class="table"></table>

                                                    </div>


                                                </div>
                                                <div class="tab-pane" id="test_analytics" role="tabpanel">
                                                   <!--analytics graph start-->
                                                    <div class="row">


                                                        <div class="col-xxl-3 col-sm-6 col-lg-3">
                                                            <!--//-->
                                                            <div class="card-body">
                                                                <div id="qbank_charts22" data-colors='["#4caf50", "#e74c3c", "#3498db", "#f39c12", "#9b59b6", "#34495e"]' class="apex-charts" dir="ltr"></div>
                                                            </div><!-- end card body -->
                                                            <!--//-->
                                                        </div>
                                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                                            <table class="table align-middle table-nowrap mb-0">
                                                                <h5 class="ms-2 score-title">Your Score</h5>
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Total Correct</a></th>
                                                                    <td> <div class="score-badge float-end">{{ $userCustomMocks->correct }}</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Total Incorrect</a></th>
                                                                    <td> <div class="score-badge float-end">{{ $userCustomMocks->incorrect }}</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Total Omitted</a></th>
                                                                    <td> <div class="score-badge float-end">{{ $userCustomMocks->omitted}}</div></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                                            <table class="table align-middle table-nowrap mb-0">
                                                                <h5 class="ms-2 score-title" style="visibility: hidden">Answer Changes</h5>
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Total Hard Correct</a></th>
                                                                    <td> <div class="score-badge float-end">{{ $userCustomMocks->hard_correct}} </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Total Fair Correct</a></th>
                                                                    <td> <div class="score-badge float-end">{{ $userCustomMocks->fair_correct}} </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row"><a href="#" class="fw-medium">Total Easy Correct</a></th>
                                                                    <td> <div class="score-badge float-end">{{ $userCustomMocks->easy_correct}} </div></td>
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
                                                                <th>subject name</th>

                                                                <th>CORRECT</th>
                                                                <th>INCORRECT</th>
                                                                <th>OMITTED</th>

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





<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<!--datatable js-->
<script src="{{ asset('user/mock_user_assets/assets/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('user/mock_user_assets/assets/datatables/js/dataTables.bootstrap5.min.js') }}"></script>

<script src="https://cdn.datatables.net/staterestore/1.2.2/js/dataTables.stateRestore.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

<script src="{{ asset('user/mock_user_assets/assets/js/pages/datatables.init.js') }}"></script>

   <!-- ApexCharts CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.27.1/dist/apexcharts.min.css">

   <!-- ApexCharts JS -->
   <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.27.1/dist/apexcharts.min.js"></script>

   <!-- Optional: To use lodash, required by ApexCharts -->
   <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/dist/lodash.min.js"></script>



   <script>
    var hardCorrect = {{ $userCustomMocks->hard_correct }};
    var fairCorrect = {{ $userCustomMocks->fair_correct }};
    var easyCorrect = {{ $userCustomMocks->easy_correct }};
    var correct = {{ $userCustomMocks->correct }};
    var incorrect = {{ $userCustomMocks->incorrect }};
    var omitted = {{ $userCustomMocks->omitted }};

    function getChartColorsArray(elementId) {
        var element = document.getElementById(elementId);

        if (element !== null) {
            var colorsAttribute = element.getAttribute("data-colors");

            if (colorsAttribute) {
                return JSON.parse(colorsAttribute.replace(/--/g, ""));
            } else {
                console.warn("data-colors Attribute not found on:", elementId);
            }
        }
    }

    var options, chart;

    var donutchartportfolioColors = getChartColorsArray("qbank_charts22");

    var MarketchartColors = (donutchartportfolioColors && (options = {
        series: [hardCorrect, fairCorrect, easyCorrect, correct, incorrect, omitted],
        labels: ["Hard Correct", "Fair Correct", "Easy Correct", "Correct", "Incorrect", "Omitted"],
        chart: {type: "donut", height: 224},
        plotOptions: {
            pie: {
                size: 100,
                offsetX: 0,
                offsetY: 0,
                donut: {
                    size: "86%",
                    labels: {
                        show: true,
                        name: {show: true, fontSize: "18px", offsetY: -5},
                        value: {
                            show: true,
                            fontSize: "20px",
                            color: "#343a40",
                            fontWeight: 500,
                            offsetY: 5,
                            formatter: function (e) {
                                return "" + e;
                            }
                        },
                        total: {
                            show: true,
                            fontSize: "13px",
                            label: "Total Questions",
                            color: "#9599ad",
                            fontWeight: 500,
                            formatter: function (e) {
                                return "" + e.globals.seriesTotals.reduce(function (total, value) {
                                    return total + value;
                                }, 0);
                            }
                        }
                    }
                }
            }
        },
        dataLabels: {enabled: false},
        legend: {show: false},
        yaxis: {
            labels: {
                formatter: function (e) {
                    return "" + e;
                }
            }
        },
        stroke: {lineCap: "round", width: 2},
        colors: donutchartportfolioColors
    }, (chart = new ApexCharts(document.querySelector("#qbank_charts22"), options)).render()));

</script>















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




    </script>


    <script>


        const dataSet = @json($dataTable);

        $(function () {
            $('#datatables-example2').DataTable({
                // Table data
                data: dataSet, // My JS array
                columns: [ // Define table Headers for each column
                    {title: ''},
                    { title: 'ID' },
                    { title: 'Subject' },
                    { title: 'Speciality' },
                    { title: 'Topic' },
                    { title: 'choose Option' },
                    { title: 'Tim Spent (mm:ss)' },
                    { title: '' }, // Add an empty title for the 8th column

                ],

                "fnInitComplete": function (oSettings, json) {
                    $('.dataTables_filter input').attr('type', 'text');
                },
            })
            .on('page.dt', function () {
                $('[data-toggle="tooltip"]').tooltip({ placement: 'bottom' })
            });
        });


    </script>



<script>
    var data2 = [
        {
            id: "6",
            name: "<span>Subject Name</span>" +
               "<div class=\"progress mt-1\" style=\"height:5px\">" +
               "<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 30%\" aria-valuenow=\"30\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-warning\" role=\"progressbar\" style=\"width: 40%\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-danger\" role=\"progressbar\" style=\"width: 60%\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "</div>",

            correct: "2(subject total correct)",
            incorrect: "2(subject total incorrect)",
            ommitted: "0(subject total omitted)",
            extn: "5421",
        },
        {
            id: "5",
            name: "<span>Subject Name</span>" +
               "<div class=\"progress mt-1\" style=\"height:5px\">" +
               "<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 30%\" aria-valuenow=\"30\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-warning\" role=\"progressbar\" style=\"width: 40%\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-danger\" role=\"progressbar\" style=\"width: 60%\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "</div>",

            correct: "2(subject total correct)",
            incorrect: "2(subject total incorrect)",
            ommitted: "0(subject total omitted)",
            extn: "5421",
        },
        {
            id: "3",
            name: "<span>Subject Name</span>" +
               "<div class=\"progress mt-1\" style=\"height:5px\">" +
               "<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 30%\" aria-valuenow=\"30\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-warning\" role=\"progressbar\" style=\"width: 40%\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "<div class=\"progress-bar bg-danger\" role=\"progressbar\" style=\"width: 60%\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>" +
               "</div>",

            correct: "2(subject total correct)",
            incorrect: "2(subject total incorrect)",
            ommitted: "0(subject total omitted)",
            extn: "5421",
        },

    ];

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



<script>
    $(document).ready(function() {
        $('#data-table').DataTable();
    });
</script>






@endsection
