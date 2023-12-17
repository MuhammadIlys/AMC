<?php

namespace App\Http\Controllers\users\qbank_user\qbank_test_result;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainQbankTestResultController extends Controller
{

    public function lunchUserQbankTestResults(){

        return view('users.qbank_user.qbank_test_result.qbank_result');


       }


       public function lunchUserQbankTestAnalytics(){

        return view('users.qbank_user.qbank_test_result.qbank_result');


       }
}
