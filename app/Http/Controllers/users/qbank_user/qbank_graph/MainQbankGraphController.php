<?php

namespace App\Http\Controllers\users\qbank_user\qbank_graph;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_system\QbankSystem;
use App\Models\users\qbank_user\qbank_user_tests\QbankUserTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainQbankGraphController extends Controller
{

   public function lunchUserQbankTestGraphs(){

    $user_id = Session::get('user')->id;

    $qbank_id = Session::get('qbank_id');

    // Fetch all user test histories
    $userTestHistories =QbankUserTest::where('user_id', $user_id)
    ->where('qbank_id', $qbank_id)
    ->get();

    // Transform data into the required structure
    $chartData = [];
    $chartData2 = [];
    $chartData3 = [];

    $testnamebase=0;

    foreach ($userTestHistories as $history) {
        // Use a combination of test name and user ID as the series name
        $testnamebase++;
        $seriesName = $history->name;
        $seriesName=$seriesName.'_'.$testnamebase;

        $chartData[$seriesName][] = [
            'date' => $history->created_at->format('m-d-Y'), // Adjust the date format as needed
            'score' => round($history->perscent),
        ];
    }


    // system wise performance


     // Fetch all user test histories
     $userTestHistories =QbankUserTest::where('user_id', $user_id)
     ->where('qbank_id', $qbank_id)
     ->get();


     // Get all Systems
     $allSystems = QbankSystem::all();

    // Loop through each system
     foreach ($allSystems as $system) {
         // Initialize totals for the current system
         $totalSystemCorrect = 0;
         $totalSystemIncorrect = 0;
         $totalSystemOmitted = 0;

         // Loop through each user test history
         foreach ($userTestHistories as $userTestHistory) {
             // Fetch all related questions with pivot information using the testQuestions relationship
             $questions = $userTestHistory->testQuestionswithPivot;

             // Filter questions related to the current system
             $questionsForSystem = $questions->filter(function ($question) use ($system) {
                 return $system->qbank_system_id == $question->qbankSystem->qbank_system_id;
             });

             // Check if there are questions for the system
             if ($questionsForSystem->isEmpty()) {
                 // Skip if no questions for this system
                 continue;
             }

             // Loop through each question related to the test history
             foreach ($questionsForSystem as $question) {
                 // Count total correct, incorrect, and omitted questions related to the system
                 switch ($question->pivot->question_status) {
                     case 'correct':
                         $totalSystemCorrect++;
                         break;

                     case 'incorrect':
                         $totalSystemIncorrect++;
                         break;

                     case 'omitted':
                         $totalSystemOmitted++;
                         break;

                     default:
                         // Handle unexpected values, if any
                         break;
                 }
             }
         }

         // Check if there are any questions for the system before adding to $systemTotals
         if ($totalSystemCorrect > 0 || $totalSystemIncorrect > 0 || $totalSystemOmitted > 0) {
             // Store totals in the associative array with the system name as the key
             $systemTotals[$system->system_name] = [
                 'correct' => $totalSystemCorrect,
                 'incorrect' => $totalSystemIncorrect,
                 'omitted' => $totalSystemOmitted,
             ];
         }
     }


    // Check if $systemTotals is not empty
        if (!empty($systemTotals)) {
            // Create the chart data array
            foreach ($systemTotals as $systemName => $totals) {
                $chartData2[] = [
                    'subject_name' => $systemName,
                    'data' => [
                        'correct' => $totals['correct'] ?? 0,
                        'incorrect' => $totals['incorrect'] ?? 0,
                        'omitted' => $totals['omitted'] ?? 0,
                    ],
                ];
            }
        }



     // Fetch all user test histories
     $userTestHistories =QbankUserTest::where('user_id', $user_id)
     ->where('qbank_id', $qbank_id)
     ->where('testStatus', 'end')
     ->where('mode', 'Timed Mod')
     ->get();


    if ($userTestHistories->isNotEmpty()) {
        foreach ($userTestHistories as $userTestHistory) {
            $totalTimeInSeconds = 0; // Initialize total time spent in seconds for each test
            $testName = $userTestHistory->name; // Assuming there is a 'test_name' field in your Test model

            // Loop through each question in the test
            foreach ($userTestHistory->testQuestionswithPivot as $question) {
                // Parse MM:SS and convert to seconds
                list($minutes, $seconds) = explode(':', $question->pivot->time_spent);
                $totalTimeInSeconds += $minutes * 60 + $seconds;
            }

            // Round total time to the nearest whole minute
            $totalTimeInMinutes = round($totalTimeInSeconds / 60);

            // Store the data in the chart array
            $chartData3[] = [
                'test_name' => $testName,
                'total_time_spent' => $totalTimeInMinutes,
            ];
        }

    }



    return view('users.qbank_user.qbank_graph.qbank_graph',[
        'chartData' => $chartData,

        'chartData2' => $chartData2,
        'chartData3' => $chartData3,
         ]);


   }
}
