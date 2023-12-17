<?php

namespace App\Http\Controllers\users\qbank_user\qbank_search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainQbankSearchController extends Controller
{
    public function lunchUserQbankSearch(){

        return view('users.qbank_user.qbank_search.qbank_search');


      }
}
