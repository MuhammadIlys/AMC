<?php

namespace App\Http\Controllers\users\mocks_user\mocks_user_test_history;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\question\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainMocksUserTestHistoryController extends Controller
{
    //

    public function generateMocksHistory(Request $request)
    {
        $test_id = Session::get('user_mocks_id');
        $user_id = Session::get('user')->id;

        // Fetch all questions related to the specified test ID
        $questions = Question::where('test_id', $test_id)->get();

        // Get the data sent from the frontend (questions that the user attempted)
        $attemptedQuestions = collect($request->json())->map(function ($item) {
            return $item['question_id'];
        })->toArray();

        // Initialize counters
        $correctCount = 0;
        $incorrectCount = 0;
        $easyCount = 0;
        $fairCount = 0;
        $hardCount = 0;
        $easyOmittedCount = 0;
        $fairOmittedCount = 0;
        $hardOmittedCount = 0;
        $totalOmittedCount = 0;
        $userAttemptHardCount = 0;
        $userAttemptFairCount = 0;
        $userAttemptEasyCount = 0;
        $correctHardCount = 0;
        $correctFairCount = 0;
        $correctEasyCount = 0;

        foreach ($questions as $question) {
            $questionId = $question->question_id;

            // Check if the question was attempted by the user
            if (in_array($questionId, $attemptedQuestions, true)) {
                // Find the attempt data for the current question
                $attemptData = collect($request->json())->firstWhere('question_id', $questionId);



                // Check if the chosen option is correct or if it's null/empty (considered as omitted)
                if ($attemptData['is_correct'] || !empty($attemptData['is_correct'])) {
                    $correctCount++;

                    // Count correct answers based on question type
                    switch ($question->question_type) {
                        case 1:
                            $correctEasyCount++;
                            break;
                        case 2:
                            $correctFairCount++;
                            break;
                        case 3:
                            $correctHardCount++;
                            break;
                        // Add more cases if you have additional question types
                    }
                } else {


                        if(empty($attemptData['selected_option']) || $attemptData['selected_option'] === null){

                            $totalOmittedCount++;

                            switch ($question->question_type) {
                                case 1:
                                    $easyOmittedCount++;
                                    break;
                                case 2:
                                    $fairOmittedCount++;
                                    break;
                                case 3:
                                    $hardOmittedCount++;
                                    break;
                                // Add more cases if you have additional question types
                            }


                        }else{

                            $incorrectCount++;

                        }


                }

                // Count based on question type
                switch ($question->question_type) {
                    case 1:
                        $easyCount++;
                        $userAttemptEasyCount++;
                        break;
                    case 2:
                        $fairCount++;
                        $userAttemptFairCount++;
                        break;
                    case 3:
                        $hardCount++;
                        $userAttemptHardCount++;
                        break;
                    // Add more cases if you have additional question types
                }
            } else {
                // The question was omitted
                $totalOmittedCount++;

                switch ($question->question_type) {
                    case 1:
                        $easyOmittedCount++;
                        break;
                    case 2:
                        $fairOmittedCount++;
                        break;
                    case 3:
                        $hardOmittedCount++;
                        break;
                    // Add more cases if you have additional question types
                }
            }
        }

        // Output the results
        dump("Correct Questions: $correctCount");
        dump("Incorrect Questions: $incorrectCount");
        dump("Easy Questions: $easyCount (User Attempted: $userAttemptEasyCount, Correct: $correctEasyCount)");
        dump("Fair Questions: $fairCount (User Attempted: $userAttemptFairCount, Correct: $correctFairCount)");
        dump("Hard Questions: $hardCount (User Attempted: $userAttemptHardCount, Correct: $correctHardCount)");
        dump("Total Omitted Questions: $totalOmittedCount");
        dump("Easy Omitted Questions: $easyOmittedCount");
        dump("Fair Omitted Questions: $fairOmittedCount");
        dump("Hard Omitted Questions: $hardOmittedCount");
    }






}
