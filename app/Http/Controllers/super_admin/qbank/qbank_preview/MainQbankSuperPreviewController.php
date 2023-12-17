<?php

namespace App\Http\Controllers\super_admin\qbank\qbank_preview;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
use Illuminate\Http\Request;

class MainQbankSuperPreviewController extends Controller
{
    //

    public function qbankQuestionPreviewView($question_id){

            // Fetch the question based on the provided $question_id
        $question = QbankQuestion::find($question_id);
        // Pass the question data to the view
        return view('super_admin.amc_qbank.qbank_preview.qbank_lunch_preview', ['question' => $question]);

    }
}
