<?php

namespace App\Http\Controllers\users\qbank_user\qbank_last_fetch_question;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
use App\Models\users\qbank_user\qbank_last_fetch_question\LastFetchedQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QbankLastFetchedQuestionController extends Controller
{

    public function fetchAllQuestions(Request $request)
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

        // Fetch questions from all systems
        $questions = QbankQuestion::whereIn('qbank_system_id', $systemIds)
            ->where('qbank_id', $qbankId)
            ->orderBy('qbank_question_id')
            ->get();

        // Get the last fetched question for each system and user
        $lastFetchedQuestions = LastFetchedQuestion::whereIn('qbank_system_id', $systemIds)
            ->where('qbank_id', $qbankId)
            ->where('user_id', $user_id)
            ->get();

        // Fetch questions distributed among systems
        foreach ($systemIds as $systemId) {
            // Get the last fetched question for the current system and user
            $lastFetchedQuestion = $lastFetchedQuestions
                ->where('qbank_system_id', $systemId)
                ->first();

            // Fetch questions for the current system starting from the last fetched question
            $systemQuestions = $questions
                ->where('qbank_system_id', $systemId)
                ->when($lastFetchedQuestion, function ($query) use ($lastFetchedQuestion) {
                    return $query->where('qbank_question_id', '>', $lastFetchedQuestion->last_fetched_question_id);
                });

            // Calculate the number of questions needed to reach the target count
            $neededQuestions = $questionsPerBlock / count($systemIds) - $systemQuestions->count();

            // If there are not enough questions, fetch additional random questions for that system
            if ($neededQuestions > 0) {
                $additionalQuestions = QbankQuestion::where('qbank_system_id', $systemId)
                    ->where('qbank_id', $qbankId)
                    ->inRandomOrder() // Order randomly
                    ->take($neededQuestions)
                    ->get();

                // Merge additional questions with the main questions
                $systemQuestions = $systemQuestions->merge($additionalQuestions);
            }

            // Take the required number of questions
            $systemQuestions = $systemQuestions->take($questionsPerBlock / count($systemIds));

            // Remove duplicates based on qbank_question_id
            $systemQuestions = $systemQuestions->unique('qbank_question_id');

            // Add the fetched questions to the result collection
            $result = $result->merge($systemQuestions);

            // Update the last fetched question for each system and user in the database
            if ($systemQuestions->isNotEmpty()) {
                $lastFetchedQuestionId = $systemQuestions->last()->qbank_question_id;

                $lastFetchedQuestion = $lastFetchedQuestions
                    ->where('qbank_system_id', $systemId)
                    ->first();

                if ($lastFetchedQuestion) {
                    $lastFetchedQuestion->update(['last_fetched_question_id' => $lastFetchedQuestionId]);
                } else {
                    LastFetchedQuestion::create([
                        'qbank_system_id' => $systemId,
                        'qbank_id' => $qbankId,
                        'user_id' => $user_id,
                        'last_fetched_question_id' => $lastFetchedQuestionId,
                    ]);
                }
            }
        }

        // Convert the result collection to JSON
        $jsonResult = $result->toJson();

        // Return a JSON response with success message and result
        return response()->json([
            'success' => true,
            'message' => 'Questions fetched successfully.',
            'result' => json_decode($jsonResult, true),
        ]);
    }





}
