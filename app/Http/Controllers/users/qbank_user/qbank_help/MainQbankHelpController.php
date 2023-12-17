<?php

namespace App\Http\Controllers\users\qbank_user\qbank_help;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainQbankHelpController extends Controller
{


   public function lunchUserQbankTestHelp(){

    return view('users.qbank_user.qbank_help.qbank_help');


   }
}
