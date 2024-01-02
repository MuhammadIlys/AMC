<?php

namespace App\Http\Controllers\users\qbank_user\qbank_last_fetch_question;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
use App\Models\users\qbank_user\qbank_last_fetch_question\LastFetchedQuestion;
use App\Models\users\qbank_user\qbank_user_test_question_history\QbankUserTestQuestionHistory;
use App\Models\users\qbank_user\qbank_user_tests\QbankUserTest;
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



               if($lastFetchedQuestion=== null){

                $isQuestionAvailable = null;
               }else{

                $isQuestionAvailable = QbankQuestion::where('qbank_question_id', $lastFetchedQuestion->last_fetched_question_id)
                ->first();
               }

                 // Fetch the last ascending question for the current system
                $lastAscendingQuestion = QbankQuestion::where('qbank_system_id', $systemId)
                ->where('qbank_id', $qbankId)
                ->orderBy('qbank_question_id', 'desc')
                ->first();


                // If last fetched question is not found or related question is null, start from the most ascending question
                if (!$isQuestionAvailable || $lastFetchedQuestion->last_fetched_question_id === $lastAscendingQuestion->qbank_question_id) {
                    // Fetch the most ascending question for the current system

                    $mostAscendingQuestion = QbankQuestion::where('qbank_system_id', $systemId)
                    ->where('qbank_id', $qbankId)
                    ->orderBy('qbank_question_id')
                    ->first();

                    // Fetch questions for the current system starting from the most ascending question
                    $systemQuestions = $questions
                    ->where('qbank_system_id', $systemId)
                    ->where('qbank_question_id', '>=', $mostAscendingQuestion->qbank_question_id)
                    ->take($questionsPerBlock / count($systemIds));
                } else {


                    // Fetch questions for the current system starting from the last fetched question
                    $systemQuestions = $questions
                        ->where('qbank_system_id', $systemId)
                        ->where('qbank_question_id', '>', $lastFetchedQuestion->last_fetched_question_id)
                        ->take($questionsPerBlock / count($systemIds));
                }


            // Remove duplicates based on qbank_question_id
            $systemQuestions = $systemQuestions->unique('qbank_question_id');

            // Add the fetched questions to the result collection
            $result = $result->merge($systemQuestions);




            // Update the last fetched question for each system and user in the database
            if ($systemQuestions->isNotEmpty()) {

                $lastFetchedQuestionId = $systemQuestions->last()->qbank_question_id;

                $lastFetchedQuestion = LastFetchedQuestion::where('qbank_system_id', $systemId)
                ->where('qbank_id', $qbankId)
                ->where('user_id', $user_id)
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

        // Calculate the number of questions needed to reach the target count at the end
        $remainingQuestions = $questionsPerBlock - $result->count();

        // If there are still not enough questions, fetch additional random questions
        if ($remainingQuestions > 0) {
            // Get the IDs of questions already in the result
            $existingQuestionIds = $result->pluck('qbank_question_id')->toArray();
            $additionalQuestions = QbankQuestion::where('qbank_id', $qbankId)
                ->whereNotIn('qbank_question_id', $existingQuestionIds)
                ->inRandomOrder()
                ->take($remainingQuestions)
                ->get();

            // Merge additional questions with the main questions
            $result = $result->merge($additionalQuestions);
        }

        $result = $result->unique('qbank_question_id');


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
            'message' => 'Questions fetched successfully.',
            'test_id' =>  encrypt($qbankUserTest->user_test_id),
        ]);


    }





}
