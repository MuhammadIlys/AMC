<?php

namespace App\Http\Controllers\users\qbank_user\qbank_exam;

use App\Http\Controllers\Controller;
use App\Models\users\qbank_user\qbank_marked\QbankMarked;
use App\Models\users\qbank_user\qbank_notes\QbankNote;
use App\Models\users\qbank_user\qbank_user_tests\QbankUserTest;
use Illuminate\Http\Request;

class MainQbankExamController extends Controller
{

   public function lunchUserQbankTestExam($test_id,$test_mode,$question_mode){

    $userTest = QbankUserTest::find(decrypt($test_id));

    // Assuming you want to get testQuestions using the testQuestions relationship defined in the model
    $questions = $userTest->testQuestions;

    // Assuming you want to get qbankNoteQuestion and qbankMarkedQuestion only for the specified user_id and qbank_id
    $user_id = $userTest->user_id;
    $qbank_id = $userTest->qbank_id;

    $question_notes = QbankNote::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->whereIn('qbank_question_id', $questions->pluck('qbank_question_id'))
        ->get();

    $question_marked = QbankMarked::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->whereIn('qbank_question_id', $questions->pluck('qbank_question_id'))
        ->get();


    return view('users.qbank_user.qbank_exam.qbank_exam_lunch',[

        'questions' => $questions->values()->toJson(),
        'test_mode'=>$test_mode,
        'question_mode'=>$question_mode,
        'question_notes'=>$question_notes->values()->toJson(),
        'question_marked'=>$question_marked->values()->toJson(),





    ]);


   }
}
