<?php

namespace App\Http\Controllers\users\qbank_user\qbank_previous_test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainQbankPreviousTestController extends Controller
{

    public function lunchUserQbankPreviousTests(){

        return view('users.qbank_user.qbank_previous_test.qbank_previous_test');


       }
}
