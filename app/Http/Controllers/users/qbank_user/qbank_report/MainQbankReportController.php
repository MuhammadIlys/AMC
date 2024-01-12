<?php

namespace App\Http\Controllers\users\qbank_user\qbank_report;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_system\QbankSystem;
use App\Models\users\qbank_user\qbank_user_tests\QbankUserTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainQbankReportController extends Controller
{
    public function lunchUserQbankTestReports(){

        $user_id = Session::get('user')->id;

        $qbank_id = Session::get('qbank_id');

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





        $systemData = [];

        // Check if $systemTotals is not empty
        if (!empty($systemTotals)) {

            foreach ($systemTotals as $systemName => $totals) {
                // Access individual counts
                $correctCount = $totals['correct'];
                $incorrectCount = $totals['incorrect'];
                $omittedCount = $totals['omitted'];

                // Calculate progress percentages for the progress bar
                $totalQuestions = $correctCount + $incorrectCount + $omittedCount;

                $correctPercentage = ($totalQuestions > 0) ? ($correctCount / $totalQuestions) * 100 : 0;
                $incorrectPercentage = ($totalQuestions > 0) ? ($incorrectCount / $totalQuestions) * 100 : 0;
                $omittedPercentage = ($totalQuestions > 0) ? ($omittedCount / $totalQuestions) * 100 : 0;

                // Build the subjectRow array
                $systemRow = [
                    'name' => '<span>' . $systemName . '</span>' .
                        '<div class="progress mt-1" style="height:5px">' .
                        '<div class="progress-bar bg-success" role="progressbar" style="width: ' . $correctPercentage . '%" aria-valuenow="' . $correctPercentage . '" aria-valuemin="0" aria-valuemax="100"></div>' .
                        '<div class="progress-bar bg-danger" role="progressbar" style="width: ' . $incorrectPercentage . '%" aria-valuenow="' . $incorrectPercentage . '" aria-valuemin="0" aria-valuemax="100"></div>' .
                        '<div class="progress-bar bg-warning" role="progressbar" style="width: ' . $omittedPercentage . '%" aria-valuenow="' . $omittedPercentage . '" aria-valuemin="0" aria-valuemax="100"></div>' .
                        '</div>',
                    'correct' => $correctCount,
                    'incorrect' => $incorrectCount,
                    'omitted' => $omittedCount,
                ];

                // Add the systemRow to the systemData array
                $systemData[] = $systemRow;
            }
        }

        // JSON encode the data
        $jsonData = json_encode($systemData, JSON_PRETTY_PRINT);

        $data = [

            'jsonData' => $jsonData,

        ];


        return view('users.qbank_user.qbank_report.qbank_reports', $data);


       }
}
