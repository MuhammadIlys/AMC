<?php

namespace App\Http\Controllers\users\mocks_user\mocks_list;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\test\Test;
use App\Models\users\mocks_user\mocks_user_attempt\MocksUserAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainMocksListController extends Controller
{
    // lunch the mocks list view
    public function mocksListView()
    {
        $user = Session::get('user');

        // Fetch data for the tests linked to the user and related questions
        $tests = $user->mocks_test_management()->with('questions')->where('test_status', 'active')->get();

        // You can further customize the data preparation based on your needs
        $mocksData = $tests->map(function ($test) use ($user) {

            $attemptsMade = 0;
            $remainingAttempts = 0;

            $attemptsHistory = MocksUserAttempt::where('user_id', $user->id)
                ->where('test_id', $test->test_id)
                ->get();

            // Check if there are any attempts in the history
            if ($attemptsHistory->isNotEmpty()) {
                // Assuming you are only interested in the first attempt, you can use first()
                $firstAttempt = $attemptsHistory->first();

                // Access the pivot attributes
                $attemptsMade = $firstAttempt->remaining_attempts;
                $remainingAttempts = $firstAttempt->remaining_attempts;
            }



            if ($attemptsMade == 0 || $test->questions->isEmpty()) {
                // Skip the test if the user has exceeded the allowed attempts or if there are no questions
                return null;
            }

            $test->mockUserTestHistories();
            return [
                'test_id' => $test->test_id,
                'test_name' => $test->test_name,
                'total_questions' => $test->questions->count(),
                'hard_questions' => $test->questions->where('question_type', '1')->count(),
                'easy_questions' => $test->questions->where('question_type', '3')->count(),
                'fair_questions' => $test->questions->where('question_type', '2')->count(),
                'remaining_attempts' => $remainingAttempts,
            ];
        })->filter(); // Remove null entries (skipped tests)

        // Send the data to the view
        return view("users.mocks_user.mocks_list.mocksList", compact('mocksData'));
    }




    public function storeMocksId(Request $request){

            // Check if the session variable 'user_mocks_id' already exists
        if (Session::has('user_mocks_id')) {
            // If it exists, update it with the new 'testId'
            Session::put('user_mocks_id', $request->input('testId'));
        } else {
            // If it doesn't exist, create it with the new 'testId'
            Session::put('user_mocks_id', $request->input('testId'));
        }

        // Return a response to AJAX with a success message or any other data
        return response()->json(['message' => 'Session variable updated successfully']);



    }

}
