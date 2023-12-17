<?php

namespace App\Http\Controllers\users\qbank_user\qbank_exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainQbankExamController extends Controller
{

   public function lunchUserQbankTestExam(){

    return view('users.qbank_user.qbank_exam.qbank_exam_lunch');


   }
}
