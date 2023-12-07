<?php

namespace App\Http\Controllers\super_admin\recalls\recalls_question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainRecallsQuestionController extends Controller
{
    public function recallsQuestionView(){

        return view('super_admin.amc_recalls.recalls_question.main_recalls_question');
    }

    public function recallsQuestionAddView(){

        return view('super_admin.amc_recalls.recalls_question.add_recalls_question');
    }
}
