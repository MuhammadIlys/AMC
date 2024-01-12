<?php

namespace App\Http\Controllers\users\qbank_user;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
use App\Models\users\qbank_user\qbank_corrects\QbankCorrects;
use App\Models\users\qbank_user\qbank_highlights\QbankHighlight;
use App\Models\users\qbank_user\qbank_incorrects\QbankIncorrects;
use App\Models\users\qbank_user\qbank_marked\QbankMarked;
use App\Models\users\qbank_user\qbank_notes\QbankNote;
use App\Models\users\qbank_user\qbank_omitted\QbankOmitted;
use App\Models\users\qbank_user\qbank_unused\QbankUnused;
use App\Models\users\qbank_user\qbank_used\QbankUsed;
use App\Models\users\qbank_user\qbank_user_tests\QbankUserTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\super_admin\user_management\user_subscription\UserSubscription;

class MainUserQbankController extends Controller
{
    public function lunchUserQbankDashboard($subscription_id=null){

        if (!Session::has('qbank_id')){

            session()->put('qbank_id', 1);


        }

        $user_id = Session::get('user')->id;

        $qbank_id = Session::get('qbank_id');

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


        // Query the QbankCorrects model to get the count
        $totalCorrectCount = QbankCorrects::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->count();



        // Query the Qbankincorrects model to get the count
        $totalIncorrectCount = QbankIncorrects::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->count();


        // Query the QbankOmitted model to get the count
        $totalOmittedCount = QbankOmitted::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->count();


        // Query the QbankUserTest model to get the count
        $totalTestCount = QbankUserTest::where('user_id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->count();


        // Query the QbankUserTest model to get the count
        $totalCompleteTestCount = QbankUserTest::where('user_id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->where('testStatus', 'end')
        ->count();


        // Query the QbankUserTest model to get the count
        $totalSuspendTestCount = QbankUserTest::where('user_id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->where('testStatus', 'suspend')
        ->count();

        // Query the QbankUsed model to get the count
        $totalUsedQuestionCount = QbankUsed::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->count();

        // Query the QbankUnused model to get the count
        $totalUnusedQuestionCount = QbankUnused::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->count();

        // Query the QbankUnused model to get the count
        $totalQuestionCount = QbankQuestion::where('qbank_id', $qbank_id)
        ->count();

        // Query the QbankMarked model to get the count
        $totalMarkedQuestionCount = QbankMarked::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->count();

        // Query the QbankNote model to get the count
        $totalNoteQuestionCount = QbankNote::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->count();

        // Query the QbankHighlight model to get the count of unique qbank_question_id values
        $totalHighlightQuestionCount = QbankHighlight::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->distinct('qbank_question_id')
        ->count();


        // Query the QbankUserTest model to get the count
        $totalTestAbove70Count = QbankUserTest::where('user_id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->where('perscent', '>=', 70)
        ->count();

        // Query the QbankUserTest model to get the count
        $totalTestBelow50Count = QbankUserTest::where('user_id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->where('perscent', '>', 30) // Ensure perscent is greater than 30
        ->where('perscent', '<=', 50) // Ensure perscent is less than or equal to 50
        ->count();

         // Query the QbankUserTest model to get the count
         $totalTestBelow30Count = QbankUserTest::where('user_id', $user_id)
         ->where('qbank_id', $qbank_id)
         ->where('perscent', '<=', 30)
         ->count();

         $mostRecentTest = QbankUserTest::where('qbank_id', $qbank_id)
         ->where('user_id', $user_id)
         ->where('testStatus', 'end')
         ->where('mode', 'Timed Mod')
         ->latest('created_at')
         ->first();

         $totalTimeSpentRecentTest='00:00';

        if ($mostRecentTest) {

             // Use the testQuestionswithPivot relationship and iterate over the related questions
            $totalTimeSpent = 0;
            foreach ($mostRecentTest->testQuestionswithPivot as $question) {
                // Convert MM:SS time to seconds and accumulate
                list($minutes, $seconds) = explode(':', $question->pivot->time_spent);
                $totalTimeSpent += ($minutes * 60) + $seconds;
            }

            // Convert the total time spent back to MM:SS format
            $minutes = floor($totalTimeSpent / 60);
            $seconds = $totalTimeSpent % 60;

            $totalTimeSpentRecentTest = sprintf('%02d:%02d', $minutes, $seconds);

        }else{

            $totalTimeSpentRecentTest='00:00';


        }


        // Fetch all user test histories
        $userTestHistories =QbankUserTest::where('user_id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->where('testStatus', 'end')
        ->where('mode', 'Timed Mod')
        ->get();

        $formattedAverageTimeSpent='00:00';

        if ($userTestHistories->isNotEmpty()) {
            $totalTimeSpent = 0;
            $numberOfTests = $userTestHistories->count();

            foreach ($userTestHistories as $userTestHistory) {
                // Loop through each question in the test
                foreach ($userTestHistory->testQuestionswithPivot as $question) {
                    // Parse MM:SS and convert to seconds
                    list($minutes, $seconds) = explode(':', $question->pivot->time_spent);
                    $totalTimeSpent += $minutes * 60 + $seconds;
                }
            }

            // Calculate average time spent in seconds
            $averageTimeSpentInSeconds = $numberOfTests > 0 ? $totalTimeSpent / $numberOfTests : 0;

            // Convert the average time spent back to MM:SS format
            $averageMinutes = floor($averageTimeSpentInSeconds / 60);
            $averageSeconds = $averageTimeSpentInSeconds % 60;

            // Format the average time spent
            $formattedAverageTimeSpent = sprintf('%02d:%02d', $averageMinutes, $averageSeconds);
        }

        $data = [
            'totalCorrectCount' => $totalCorrectCount,
            'totalIncorrectCount' => $totalIncorrectCount,
            'totalOmittedCount' => $totalOmittedCount,
            'totalTestCount' => $totalTestCount,
            'totalCompleteTestCount' => $totalCompleteTestCount,
            'totalSuspendTestCount' => $totalSuspendTestCount,
            'totalUsedQuestionCount' => $totalUsedQuestionCount,
            'totalUnusedQuestionCount' => $totalUnusedQuestionCount,
            'totalQuestionCount' => $totalQuestionCount,
            'totalMarkedQuestionCount' => $totalMarkedQuestionCount,
            'totalNoteQuestionCount' => $totalNoteQuestionCount,
            'totalHighlightQuestionCount' => $totalHighlightQuestionCount,
            'totalTestAbove70Count' => $totalTestAbove70Count,
            'totalTestBelow50Count' => $totalTestBelow50Count,
            'totalTestBelow30Count' => $totalTestBelow30Count,
            'totalTimeSpentRecentTest' => $totalTimeSpentRecentTest,
            'formattedAverageTimeSpent' => $formattedAverageTimeSpent,
        ];


        return view('users.qbank_user.index', $data);


    }



    public function qbankSetup(Request $request)
    {
        $qbankId = $request->input('qbank_id');

        // Store qbank_id in the session
        session()->put('qbank_id', $qbankId);

        // You can perform additional logic here if needed

        return response()->json(['status' => 'success']);
    }




}
