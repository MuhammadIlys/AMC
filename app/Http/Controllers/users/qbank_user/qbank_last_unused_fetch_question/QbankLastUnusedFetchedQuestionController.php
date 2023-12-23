<?php

namespace App\Http\Controllers\users\qbank_user\qbank_last_unused_fetch_question;

use App\Http\Controllers\Controller;
use App\Models\users\qbank_user\qbank_last_unused_fetch_question\LastUnusedFetchedQuestion;
use App\Models\users\qbank_user\qbank_unused\QbankUnused;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QbankLastUnusedFetchedQuestionController extends Controller
{
    public function fetchUnusedQuestions(Request $request)
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
    $correctQuestions = QbankUnused::where('qbank_id', $qbankId)
        ->where('id', $user_id)
        ->get();

    // Get the last fetched question for each system and user
    $lastCorrectFetchedQuestions = LastUnusedFetchedQuestion::whereIn('qbank_system_id', $systemIds)
        ->where('qbank_id', $qbankId)
        ->where('user_id', $user_id)
        ->get();

    // Fetch correct questions distributed among systems
    foreach ($systemIds as $systemId) {
        // Get the last fetched question for the current system and user
        $lastCorrectFetchedQuestion = $lastCorrectFetchedQuestions
            ->where('qbank_system_id', $systemId)
            ->first();

        // Fetch correct questions for the current system starting from the last fetched question
        $systemCorrectQuestions = $correctQuestions
            ->where('qbankQuestion.qbankSystem.qbank_system_id', $systemId)
            ->when($lastCorrectFetchedQuestion, function ($query) use ($lastCorrectFetchedQuestion) {
                return $query->where('qbankQuestion.qbank_system_id', $lastCorrectFetchedQuestion->qbank_system_id)
                             ->where('qbankQuestion.qbank_question_id', '>', $lastCorrectFetchedQuestion->last_fetched_question_id);
            });

        // Calculate the number of questions needed to reach the target count
        $neededQuestions = $questionsPerBlock / count($systemIds) - $systemCorrectQuestions->count();

        // If there are not enough questions, fetch additional random questions for that system
        if ($neededQuestions > 0) {
            $additionalCorrectQuestions = QbankUnused::where('qbank_id', $qbankId)
                ->whereHas('qbankQuestion', function ($query) use ($systemId) {
                    $query->where('qbank_system_id', $systemId);
                })
                ->inRandomOrder() // Order randomly
                ->take($neededQuestions)
                ->get();

            // Merge additional questions with the main questions
            $systemCorrectQuestions = $systemCorrectQuestions->merge($additionalCorrectQuestions);
        }

        // Take the required number of questions
        $systemCorrectQuestions = $systemCorrectQuestions->take($questionsPerBlock / count($systemIds));

        // Remove duplicates based on qbank_question_id
        $systemCorrectQuestions = $systemCorrectQuestions->unique('qbankQuestion.qbank_question_id');

        // Add the fetched correct questions to the result collection without associating with system IDs
        $result = $result->merge($systemCorrectQuestions->pluck('qbankQuestion'));

        // Update the last fetched question for each system and user in the database
        if ($systemCorrectQuestions->isNotEmpty()) {
            $lastFetchedQuestionId = $systemCorrectQuestions->last()->qbankQuestion->qbank_question_id;

            $lastCorrectFetchedQuestion = $lastCorrectFetchedQuestions
                ->where('qbank_system_id', $systemId)
                ->first();

            if ($lastCorrectFetchedQuestion) {
                $lastCorrectFetchedQuestion->update(['last_fetched_question_id' => $lastFetchedQuestionId]);
            } else {
                LastUnusedFetchedQuestion::create([
                    'qbank_system_id' => $systemId,
                    'qbank_id' => $qbankId,
                    'user_id' => $user_id,
                    'last_fetched_question_id' => $lastFetchedQuestionId,
                ]);
            }
        }
    }

    // Remove duplicates based on qbank_question_id from the combined result collection
    $result = $result->unique('qbank_question_id')->values();

    // Convert the result collection to JSON
    $jsonResult = $result->toJson();

    // Return a JSON response with success message and result
    return response()->json([
        'success' => true,
        'message' => 'Correct questions fetched successfully.',
        'result' => json_decode($jsonResult, true),
    ]);
}

}
