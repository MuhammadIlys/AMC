<?php

namespace App\Http\Controllers\users\qbank_user\qbank_last_used_fetch_question;

use App\Http\Controllers\Controller;
use App\Models\users\qbank_user\qbank_last_used_fetch_question\LastUsedFetchedQuestion;
use App\Models\users\qbank_user\qbank_used\QbankUsed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\users\qbank_user\qbank_user_test_question_history\QbankUserTestQuestionHistory;
use App\Models\users\qbank_user\qbank_user_tests\QbankUserTest;
use App\Models\super_admin\qbank\qbank_question\QbankQuestion;

class QbankLastUsedFetchedQuestionController extends Controller
{
    public function fetchUsedQuestions(Request $request)
    {
         // get selected systems ids
    $systemIds = $request->input('systemIds');

    // get question per block
    $questionsPerBlock = $request->input('questionsPerBlock');

    // Get the Qbank ID
    $qbankId = Session::get('qbank_id');

    // Get the authenticated user's ID
    $user_id = Session::get('user')->id;

    // Initialize an empty collection to store the results
    $result = collect();

    // Fetch correct questions from QbankCorrects model that match qbank_id and user_id
    $correctQuestions = QbankUsed::where('qbank_id', $qbankId)
        ->where('id', $user_id)
        ->get();

    // Get the last fetched question for each system and user
    $lastCorrectFetchedQuestions = LastUsedFetchedQuestion::whereIn('qbank_system_id', $systemIds)
        ->where('qbank_id', $qbankId)
        ->where('user_id', $user_id)
        ->get();

    // Fetch correct questions distributed among systems
    foreach ($systemIds as $systemId) {
        // Get the last fetched question for the current system and user
        $lastCorrectFetchedQuestion = $lastCorrectFetchedQuestions
            ->where('qbank_system_id', $systemId)
            ->first();

        if ($lastCorrectFetchedQuestion === null) {
            $isQuestionAvailable = null;
        } else {
            $isQuestionAvailable = QbankQuestion::where('qbank_question_id', $lastCorrectFetchedQuestion->last_fetched_question_id)
                ->first();
        }

        // Fetch the last ascending question for the current system
        $lastAscendingQuestion = QbankQuestion::where('qbank_system_id', $systemId)
            ->where('qbank_id', $qbankId)
            ->orderBy('qbank_question_id', 'desc')
            ->first();

        // If last fetched question is not found or related question is null, start from the most ascending question
        if (!$isQuestionAvailable || $lastCorrectFetchedQuestion->last_fetched_question_id === $lastAscendingQuestion->qbank_question_id) {
            // Fetch the most ascending question for the current system
            $mostAscendingQuestion = QbankQuestion::where('qbank_system_id', $systemId)
                ->where('qbank_id', $qbankId)
                ->orderBy('qbank_question_id')
                ->first();

            $systemQuestions = $correctQuestions
                ->where('qbankQuestion.qbankSystem.qbank_system_id', $systemId)
                ->when($mostAscendingQuestion, function ($query) use ($mostAscendingQuestion) {
                    return $query->where('qbankQuestion.qbank_system_id', $mostAscendingQuestion->qbank_system_id)
                        ->where('qbankQuestion.qbank_question_id', '>=', $mostAscendingQuestion->last_fetched_question_id);
                });
        } else {
            // Fetch correct questions for the current system starting from the last fetched question
            $systemQuestions = $correctQuestions
                ->where('qbankQuestion.qbankSystem.qbank_system_id', $systemId)
                ->when($lastCorrectFetchedQuestion, function ($query) use ($lastCorrectFetchedQuestion) {
                    return $query->where('qbankQuestion.qbank_system_id', $lastCorrectFetchedQuestion->qbank_system_id)
                        ->where('qbankQuestion.qbank_question_id', '>', $lastCorrectFetchedQuestion->last_fetched_question_id);
                });
        }

        // Take the required number of questions
        $systemQuestions = $systemQuestions->take($questionsPerBlock / count($systemIds));

        // Remove duplicates based on qbank_question_id
        $systemQuestions = $systemQuestions->unique('qbank_question_id');

        // Add the fetched questions to the result collection
        $result = $result->merge($systemQuestions->pluck('qbankQuestion'));

        // Update the last fetched question for each system and user in the database
        if ($systemQuestions->isNotEmpty()) {
            $lastFetchedQuestionId = $systemQuestions->last()->qbank_question_id;

            $lastFetchedQuestion = LastUsedFetchedQuestion::where('qbank_system_id', $systemId)
                ->where('qbank_id', $qbankId)
                ->where('user_id', $user_id)
                ->first();

            if ($lastFetchedQuestion) {
                $lastFetchedQuestion->update(['last_fetched_question_id' => $lastFetchedQuestionId]);
            } else {
                LastUsedFetchedQuestion::create([
                    'qbank_system_id' => $systemId,
                    'qbank_id' => $qbankId,
                    'user_id' => $user_id,
                    'last_fetched_question_id' => $lastFetchedQuestionId,
                ]);
            }
        }
    }

    // Calculate the number of questions needed to reach the target count at the end
    $remainingQuestions = $questionsPerBlock - $result->count();

    // If there are still not enough questions, fetch additional random questions from QbankCorrects
    if ($remainingQuestions > 0) {
        // Get the IDs of questions already in the result
        $existingQuestionIds = $result->pluck('qbank_question_id')->toArray();

        // Fetch additional random questions from QbankCorrects, excluding those already in the result
        $additionalQuestions = QbankUsed::where('qbank_id', $qbankId)
            ->where('id', $user_id)
            ->whereNotIn('qbank_question_id', $existingQuestionIds)
            ->inRandomOrder()
            ->take($remainingQuestions)
            ->get()
            ->pluck('qbankQuestion');

        // Merge additional questions with the main questions
        $result = $result->merge($additionalQuestions);
    }

    // Remove duplicates based on qbank_question_id from the combined result collection
    $result = $result->unique('qbank_question_id')->values();

    $qbankUserTest = QbankUserTest::create([
        'user_id' => $user_id,
        'qbank_id' =>  $qbankId,
    ]);

    foreach ($result as $item) {

        QbankUserTestQuestionHistory::create([

            'user_test_id'=>$qbankUserTest->user_test_id,

            'qbank_question_id' =>  $item['qbank_question_id'],

        ]);

    }

    // Return a JSON response with success message and result
    return response()->json([
        'success' => true,
        'message' => 'Correct questions fetched successfully.',
        'result' => $result,
        'test_id' =>  encrypt($qbankUserTest->user_test_id),
    ]);


    }

}
