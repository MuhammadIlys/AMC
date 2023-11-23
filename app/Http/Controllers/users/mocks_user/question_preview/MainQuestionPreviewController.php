<?php

namespace App\Http\Controllers\users\mocks_user\question_preview;

use App\Http\Controllers\Controller;
use App\Models\users\mocks_user\mocks_user_test_history\MocksUserTestHistory;
use Illuminate\Http\Request;

class MainQuestionPreviewController extends Controller
{
    public function showQuestionPreviewView($user_mocks_id, $question_id = null) {
        // Assuming you have an instance of MocksUserTestHistory
        $userTestHistory = MocksUserTestHistory::findOrFail(decrypt(urldecode($user_mocks_id)));

        // Check if the test is older than 24 hours
        $testCreationTime = $userTestHistory->created_at;
        $currentDateTime = now();
        $hoursDifference = $currentDateTime->diffInHours($testCreationTime);

        if ($hoursDifference > 24) {

            return redirect()->back()->with('mocks_older_error', 'Preview not allowed for Mocks older than 24 hours.');
        }

        if ($question_id !== null) {
            $question_id = decrypt(urldecode($question_id));
        }

        // Load questions and related data
        $questions = $userTestHistory->questions;

        if ($question_id !== null && $question_id !== "") {
            // Pass data to the view
            return view('users.mocks_user.question_preview.question_preview', [
                'mocksName' => $userTestHistory->test->test_name,
                'questions' => $questions,
                'question_id' => $question_id
            ]);
        } else {
            // Pass data to the view
            return view('users.mocks_user.question_preview.question_preview', [
                'mocksName' => $userTestHistory->test->test_name,
                'questions' => $questions,
                'question_id' => null,
            ]);
        }
    }

}
