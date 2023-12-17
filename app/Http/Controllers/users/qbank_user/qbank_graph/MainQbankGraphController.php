<?php

namespace App\Http\Controllers\users\qbank_user\qbank_graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainQbankGraphController extends Controller
{

   public function lunchUserQbankTestGraphs(){

    return view('users.qbank_user.qbank_graph.qbank_graph');


   }
}
