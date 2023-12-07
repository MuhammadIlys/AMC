<?php

namespace App\Http\Controllers\users\mocks_user;

use App\Http\Controllers\Controller;
use App\Models\super_admin\user_management\user_subscription\UserSubscription;
use App\Models\super_admin\user_management\Users;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class MocksUserMainController extends Controller
{
    //

    public function welcomeView($subscription_id=null){

         // Initialize variables for calculations

        $totalTimeSpentInRecentMocks = 0;
        $totalTimeLastRecentMock = 0;
        $totalTimeSpentInHours = 0;
        $totalMocksCompleted = 0;
        $totalMocksPassed = 0;
        $totalMocksFailed = 0;
        $totalHardQuestions = 0;
        $totalFairQuestions = 0;
        $totalEasyQuestions = 0;
        $totalCorrectQuestions = 0;
        $totalIncorrectQuestions = 0;
        $totalOmittedQuestions = 0;
        $totalCorrectQuestionsPerSubject = [];
        $totalQuestionsPerSubject= [];

        $user_id = Session::get('user')->id;

        if ($subscription_id !== null) {
            // $subscription_id is not null, proceed with the logic
            $subscription_id1 = decrypt($subscription_id);


            $userSubscription = UserSubscription::where([
                ['user_id', '=', $user_id],
                ['subscription_id', '=', $subscription_id1],
            ])->select('expiry_timestamp')->first();

            if ($userSubscription) {
                // Check if the session key 'mocks_expiry_timestamp' already exists
                if (Session::has('mocks_expiry_timestamp')) {
                    // Session key already exists, update its value
                    Session::put('mocks_expiry_timestamp', $userSubscription->expiry_timestamp);
                } else {
                    // Session key doesn't exist, create it
                    Session::put('mocks_expiry_timestamp', $userSubscription->expiry_timestamp);
                }
            }
        }



       // Fetch user test histories
       $userTestHistories = Users::find($user_id)->mockUserTestHistories;
       // Find the most recent mock
       $mostRecentHistory = $userTestHistories->sortByDesc('created_at')->first();

       if ($mostRecentHistory) {

        // Calculate total time spent for the last recent mock
        $totalTimeSpentInRecentMocks = $this->calculateTimeSpent($mostRecentHistory->questions);

       }


    // Iterate through user test histories
    foreach ($userTestHistories as $history) {


       // Update total time spent in hours
        $totalTimeSpentInHours += $history->questions->sum(function ($question) {
            // Convert MM:SS to hours and add to the total time spent
            list($minutes, $seconds) = explode(':', $question->pivot->time_spent);
            return $minutes / 60 + $seconds / 3600;
        });


        // Update other metrics
        $totalMocksCompleted++;
        $totalMocksPassed += $history->test_status === 'Pass' ? 1 : 0;
        $totalMocksFailed += $history->test_status === 'Fail' ? 1 : 0;
        $totalHardQuestions += $history->hard_correct;
        $totalFairQuestions += $history->fair_correct;
        $totalEasyQuestions += $history->easy_correct;
        $totalCorrectQuestions += $history->correct;
        $totalIncorrectQuestions += $history->incorrect;
        $totalOmittedQuestions += $history->omitted;

        // Update total correct questions per subject
        foreach ($history->questions as $question) {
            $subject = $question->subject; // Assuming there's a 'subject' relationship on the Question model
            $subjectKey = $subject->subject_name; // Replace 'name' with the actual property you want to use as the key
            // Update total questions per subject
            $totalQuestionsPerSubject[$subjectKey] = isset($totalQuestionsPerSubject[$subjectKey])
            ? $totalQuestionsPerSubject[$subjectKey] + 1 : 1;

            $totalCorrectQuestionsPerSubject[$subjectKey] = isset($totalCorrectQuestionsPerSubject[$subjectKey])
                ? $totalCorrectQuestionsPerSubject[$subjectKey] + ($question->pivot->question_status === 'correct' ? 1 : 0)
                : ($question->pivot->question_status === 'correct' ? 1 : 0);
        }

    }



    // Convert total time spent on recent mocks to HH:MM format
    $totalTimeSpentInRecentMocks = gmdate('H:i', $totalTimeSpentInRecentMocks * 3600);

    // Calculate average time spent
    $averageTimeSpent = $totalMocksCompleted > 0 ? gmdate('H:i', ($totalTimeSpentInHours / $totalMocksCompleted) * 3600) : '00:00';



    // The rest of your logic or view rendering goes here
    return view("users.mocks_user.index", compact(

        'totalTimeSpentInRecentMocks',
        'averageTimeSpent',
        'totalMocksCompleted',
        'totalMocksPassed',
        'totalMocksFailed',
        'totalHardQuestions',
        'totalFairQuestions',
        'totalEasyQuestions',
        'totalCorrectQuestions',
        'totalIncorrectQuestions',
        'totalOmittedQuestions',
        'totalCorrectQuestionsPerSubject',
        'totalQuestionsPerSubject'

    ));






    }


    public function calculateTimeSpent($questions)
    {
        $totalTimeSpent = 0;

        foreach ($questions as $question) {
            // Convert MM:SS to hours and add to the total time spent
            list($minutes, $seconds) = explode(':', $question->pivot->time_spent);
            $totalTimeSpent += $minutes / 60 + $seconds / 3600;
        }

        return $totalTimeSpent;
    }




}
