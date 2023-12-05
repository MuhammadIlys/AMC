<?php

namespace App\Http\Controllers\users\mocks_user\mocks_user_test_history;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\question\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\users\mocks_user\mocks_user_test_history\MocksUserTestHistory;
use App\Models\users\mocks_user\mocks_user_question_history\MocksUserQuestionHistory;
use App\Models\users\mocks_user\mocks_user_attempt\MocksUserAttempt;


class MainMocksUserTestHistoryController extends Controller
{
    //

    public function generateMocksHistory(Request $request)
    {

             // Initialize counters
        $totalQuestions=0;
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

        // Initialize variables
        $totalMarks = 500;
        $passingMarks = 250;
        $marks = 0;

        // Scoring ranges
        $easyRange = [2.8, 3.0];
        $fairRange = [3.0, 3.2];
        $hardRange = [3.2, 3.5];



        $test_id = Session::get('user_mocks_id');
        $user_id = Session::get('user')->id;

        if (empty($test_id) || empty($user_id)) {
            return response()->json(['error' => 'Invalid session or request parameters'], 400);
        }

        try {

        $mocksUserTestHistory = new MocksUserTestHistory([
            'user_id' => $user_id ,
            'test_id' => $test_id,
            'score' => null,
            'correct' => null,
            'incorrect' => null,
            'omitted' => null,
            'percent' => null,
            'test_status'=>null,
            'hard_correct'=>null,
            'fair_correct'=>null,
            'easy_status'=>null,
        ]);

        $mocksUserTestHistory->save();


        // Fetch all questions related to the specified test ID
        $questions = Question::where('test_id', $test_id)->get();

        // Get the data sent from the frontend (questions that the user attempted)
        $attemptedQuestions = collect($request->json())->map(function ($item) {
            return $item['question_id'];
        })->toArray();



        // total incorrect  fair and hard question
        $incorrectHardCount= $hardCount - $correctHardCount;
        $incorrectFairCount = $fairCount-$correctFairCount;

        foreach ($questions as $question) {
            $questionId = $question->question_id;

            // Check if the question was attempted by the user
            if (in_array($questionId, $attemptedQuestions, true)) {

                 $totalQuestions++;
                // Find the attempt data for the current question
                $attemptData = collect($request->json())->firstWhere('question_id', $questionId);



                $questionHistoryMocksRelated = new MocksUserQuestionHistory([
                    'user_mocks_id' => $mocksUserTestHistory->user_mocks_id,
                    'question_id' => $attemptData['question_id'],
                    'choose_option' => !empty($attemptData['selected_option']) ? $attemptData['selected_option'] : 6,
                    'question_status' => (empty($attemptData['selected_option']) || is_null($attemptData['selected_option'])) ? 'omitted' : ($attemptData['is_correct'] ? 'correct' : 'incorrect'),
                    'question_type' => $attemptData['question_type'],
                    'time_spent' => (isset($attemptData['selected_option']) && $attemptData['selected_option'] !== null) ? $attemptData['time_spent'] : '00:00',

                ]);

                $questionHistoryMocksRelated->save();


                // Check if the chosen option is correct or if it's null/empty (considered as omitted)
                if ($attemptData['is_correct'] || !empty($attemptData['is_correct'])) {

                    $correctCount++;

                    // Count correct answers based on question type
                    switch ($question->question_type) {
                        case 1:
                            $userAttemptEasyCount++;
                            $correctEasyCount++;
                            break;
                        case 2:
                            $userAttemptFairCount++;
                            $correctFairCount++;
                            break;
                        case 3:
                            $userAttemptHardCount++;
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

                            // Count correct answers based on question type
                            switch ($question->question_type) {
                                case 1:
                                    $userAttemptEasyCount++;

                                    break;
                                case 2:
                                    $userAttemptFairCount++;

                                    break;
                                case 3:
                                    $userAttemptHardCount++;

                                    break;
                                // Add more cases if you have additional question types
                            }

                        }


                }

                // Count based on question type
                switch ($question->question_type) {
                    case 1:
                        $easyCount++;

                        break;
                    case 2:
                        $fairCount++;

                        break;
                    case 3:
                        $hardCount++;

                        break;
                    // Add more cases if you have additional question types
                }



            } else {


                $questionHistoryMocksRelated = new MocksUserQuestionHistory([
                    'user_mocks_id' => $mocksUserTestHistory->user_mocks_id,
                    'question_id' => $questionId,
                    'choose_option' => 6,
                    'question_status' => 'omitted',
                    'question_type' => $question->question_type,
                    'time_spent' => '00:00',
                ]);

                $questionHistoryMocksRelated->save();

                $totalQuestions++;
                // The question was omitted
                $totalOmittedCount++;

                switch ($question->question_type) {
                    case 1:
                        $easyCount++;
                        $easyOmittedCount++;
                        break;
                    case 2:
                        $fairCount++;
                        $fairOmittedCount++;
                        break;
                    case 3:
                        $hardCount++;
                        $hardOmittedCount++;
                        break;
                    // Add more cases if you have additional question types
                }
            }
        }





        // Calculate marks for easy questions
        $marks += $correctEasyCount * mt_rand($easyRange[0] * 100, $easyRange[1] * 100) / 100;

        // Calculate marks for fair questions
        $marks += $correctFairCount * mt_rand($fairRange[0] * 100, $fairRange[1] * 100) / 100;

        // Calculate marks for hard questions
        $marks += $correctHardCount * mt_rand($hardRange[0] * 100, $hardRange[1] * 100) / 100;

        // Ensure that the total marks do not exceed the total available marks
        $marks = round(min($marks, $totalMarks),2);



         // Deduct 10% from obtained marks if the number of omitted  questions is equal to or greater than 10
         if ($totalOmittedCount >= 10) {
            $deduction = $marks * 0.10; // 10% deduction
            $marks -= min($deduction, $marks); // Ensure deduction doesn't go below zero
        }






        // Deduct 10% from obtained marks if the number of hard wrong questions is equal to or greater than 8
        if ($incorrectHardCount >= 5) {
            $deduction = $marks * 0.10; // 10% deduction
            $marks -= min($deduction, $marks); // Ensure deduction doesn't go below zero
        }




        // Deduct 8% from obtained marks if the number of fair wrong questions is equal to or greater than 6
        if ($incorrectFairCount >= 8) {
            $deduction = $marks * 0.08; // 8% deduction
            $marks -= min($deduction, $marks); // Ensure deduction doesn't go below zero
        }



          // Deduct 5% from obtained marks if the number of easy wrong questions is equal to or greater than 6
          if ($incorrectFairCount >= 15) {
            $deduction = $marks * 0.05; // 7% deduction
            $marks -= min($deduction, $marks); // Ensure deduction doesn't go below zero
        }




        // Ensure that the total marks do not go below zero
        $marks = max($marks, 0);

        // Calculate percentage
        $percentage =  ($correctCount / $totalQuestions) * 100;

        $percentage =round($percentage,2);

        // Determine pass or fail
        $passOrFail = ($marks >= $passingMarks) ? 'Pass' : 'Fail';





        $updateResult = $mocksUserTestHistory->update([

            'score' => round($marks,2),
            'correct' => $correctCount,
            'incorrect' => $incorrectCount,
            'omitted' => $totalOmittedCount,
            'perscent' =>$percentage,
            'test_status'=>$passOrFail,
            'hard_correct'=>$correctHardCount,
            'fair_correct'=>$correctFairCount,
            'easy_correct'=>$correctEasyCount,

        ]);


        if (!$updateResult) {
            // Update failed, perform cascade delete
            $mocksUserTestHistory->delete();

            // Delete related question history
            MocksUserQuestionHistory::where('user_mocks_id', $mocksUserTestHistory->user_mocks_id)->delete();

            return response()->json(['error' => 'Update failed. Data deleted.'], 500);
        }


      // update the user attempts accordingly;

        $this->updateRemainingAttempts($user_id, $test_id);



        return response()->json([
            'user_mocks_id' => $mocksUserTestHistory->user_mocks_id,
            'message' => 'Data sent successfully',
        ]);


    } catch (\Exception $e) {
        // Handle database-related errors
        return response()->json(['error' => 'Database error'], 500);
    }




}



function updateRemainingAttempts($user_id, $test_id)
{
    // Find the MocksUserAttempt record for the given test_id and user_id
    $mocksUserAttempt = MocksUserAttempt::where('test_id', $test_id)
        ->where('user_id', $user_id)
        ->first();

    if ($mocksUserAttempt) {
        // Get the current remaining_attempts value
        $remainingAttempts = $mocksUserAttempt->remaining_attempts;

        // Subtract 1 from the current value if it's greater than 0
        if ($remainingAttempts > 0) {
            $mocksUserAttempt->update(['remaining_attempts' => $remainingAttempts - 1]);

            return true; // Indicate that the update was successful
        } else {

            return false; // Indicate that the update was skipped
        }
    } else {

        return false; // Indicate that the update was not performed
    }
}






}
