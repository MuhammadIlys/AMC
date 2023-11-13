<?php

namespace App\Http\Controllers\users\mocks_user\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainReportController extends Controller
{
     // lunch report view
     public function reportView(){
        return view("users.mocks_user.report.reports");
    }
}
