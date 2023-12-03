<?php

namespace App\Http\Controllers\super_admin\mocks\question_preview;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\question\Question;
use Illuminate\Http\Request;

class MainQuestionPreview2Controller extends Controller
{
   public function showQuestionPreview($question_id){

    $question = Question::find($question_id);

    return view('super_admin.mocks_test.question_preview.question_preview', ['question' => $question]);
   }
}
