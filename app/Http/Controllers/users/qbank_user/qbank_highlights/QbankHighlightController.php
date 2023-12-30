<?php

namespace App\Http\Controllers\users\qbank_user\qbank_highlights;

use App\Http\Controllers\Controller;
use App\Models\users\qbank_user\qbank_highlights\QbankHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QbankHighlightController extends Controller
{
    public function createQuestionHighlights(Request $request)
    {

         // Get the user ID from the session
       $userId = Session::get('user')->id;

       // Replace with the desired qbank_id or use a default value
       $qbankId =  Session::get('qbank_id');

        $request->validate([
            'questionId' => 'required',
            'selectedText' => 'required',
            'highlightId' => 'required',
        ]);

        // Create a new highlight
        $highlight = QbankHighlight::create([
            'qbank_question_id' => $request->input('questionId'),
            'highlight_text' => $request->input('selectedText'),
            'id' => $userId,
            'question_highlight_id' => $request->input('highlightId'),
            'qbank_id'=>$qbankId

        ]);

        return response()->json(['highlight_id' => $highlight->question_highlight_id], 201);
    }

    public function deleteQuestionHighlights($highlightId)
    {

        QbankHighlight::where('question_highlight_id', $highlightId)->delete();

        return response()->json(['message' => 'Highlight deleted successfully']);
    }

    public function getQuestionHighlights(Request $request)
    {
        $questionId=$request->input('questionId');
         // Get the user ID from the session
        $userId = Session::get('user')->id;

       // Replace with the desired qbank_id or use a default value
       $qbankId =  Session::get('qbank_id');

        // Retrieve all highlights for the specified question ID
        $highlights = QbankHighlight::where('qbank_question_id', $questionId)
        ->where('id', $userId)
        ->where('qbank_id', $qbankId)
        ->get();

        return response()->json(['highlights' => $highlights]);
    }
}
