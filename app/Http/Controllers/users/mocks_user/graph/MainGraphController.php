<?php

namespace App\Http\Controllers\users\mocks_user\graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainGraphController extends Controller
{
    //lunch graph view

    public function graphView(){
        return view("users.mocks_user.graph.graph");
    }
}
