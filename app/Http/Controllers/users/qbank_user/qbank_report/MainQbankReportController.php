<?php

namespace App\Http\Controllers\users\qbank_user\qbank_report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainQbankReportController extends Controller
{
    public function lunchUserQbankTestReports(){

        return view('users.qbank_user.qbank_report.qbank_reports');


       }
}
