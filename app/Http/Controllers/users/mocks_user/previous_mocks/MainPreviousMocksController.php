<?php

namespace App\Http\Controllers\users\mocks_user\previous_mocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainPreviousMocksController extends Controller
{
    // lunch the previous mocks view
    public function previousMocksView(){
        return view("users.mocks_user.previous_mocks.previousMocks");
    }
}
