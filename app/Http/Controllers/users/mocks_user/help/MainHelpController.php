<?php

namespace App\Http\Controllers\users\mocks_user\help;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainHelpController extends Controller
{
   //lunch help view

    public function helpView(){
        return view("users.mocks_user.help.help");
    }

}
