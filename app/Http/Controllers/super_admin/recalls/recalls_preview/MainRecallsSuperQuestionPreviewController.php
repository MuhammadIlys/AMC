<?php

namespace App\Http\Controllers\super_admin\recalls\recalls_preview;

use App\Http\Controllers\Controller;
use App\Models\super_admin\recalls\recalls_demo\RecallsDemoQuestion;
use App\Models\super_admin\recalls\recalls_question\RecallsQuestion;
use Illuminate\Http\Request;

class MainRecallsSuperQuestionPreviewController extends Controller
{
    public function recallsQuestionPreview($question_id){

        // Fetch the question based on the provided $question_id
        $question = RecallsQuestion::find($question_id);
        // Pass the question data to the view
        return view('super_admin.amc_recalls.recalls_preview.qbank_lunch_preview', ['question' => $question]);

    }
}
