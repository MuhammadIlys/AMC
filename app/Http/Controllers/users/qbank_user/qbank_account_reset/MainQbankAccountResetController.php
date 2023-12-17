<?php

namespace App\Http\Controllers\users\qbank_user\qbank_account_reset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainQbankAccountResetController extends Controller
{

   public function lunchUserQbankTestResetAccount(){

    return view('users.qbank_user.qbank_account_reset.qbank_account_reset');


   }
}
