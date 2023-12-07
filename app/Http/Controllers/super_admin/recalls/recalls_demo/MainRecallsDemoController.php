<?php

namespace App\Http\Controllers\super_admin\recalls\recalls_demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainRecallsDemoController extends Controller
{
    public function recallsDemoQuestionView(){

        return view('super_admin.amc_recalls.recalls_demo.main_recalls_demo_question');
    }

    public function recallsDemoQuestionAddView(){

        return view('super_admin.amc_recalls.recalls_demo.add_recalls_demo_question');
    }
}
