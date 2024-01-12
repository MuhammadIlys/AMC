<?php

namespace App\Http\Controllers\users\qbank_user\qbank_test_result;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_system\QbankSystem;
use App\Models\users\qbank_user\qbank_user_tests\QbankUserTest;
use Illuminate\Http\Request;

class MainQbankTestResultController extends Controller
{

    public function lunchUserQbankTestResults($test_id){

        // Assuming $userTestId is the ID of the QbankUserTest instance you want to fetch questions for
        $userTest = QbankUserTest::find(decrypt($test_id));

        $user_test_id=$test_id;
        $mode=$userTest->mode;
        $test_status=$userTest->testStatus;


         if($mode === 'Timed Mode'){

            $mode ='toggleTimed';
        }else{

            $mode ='toggleTutor';
        }

         $question_mode=$userTest->questionMode;

        // Fetch all related questions with pivot information using the testQuestions relationship
        $questions = $userTest->testQuestionswithPivot;

        // Prepare data for DataTable
        $dataTable = [];

        foreach ($questions as $question) {
            $icon = "<i style='margin-left: 18px;'></i>";
            $status = $question->pivot->question_status;

            // Set icon based on question status
            if ($status == 'correct') {
                $icon .= "<i class='la la-check' style='color: green;'></i>";
            } elseif ($status == 'omitted') {
                $icon .= "<i class='la la-lg la-minus-circle ng-star-inserted' style='color: blue;'></i>";
            } elseif ($status == 'incorrect') {
                $icon .= "<i class='la la-lg la-times' style='color: red;'></i>";
            }

            $question_view_url='/lunch_user_qbank_test_exam/'.$user_test_id.'/'.$mode.'/'.$question_mode.'/'.$question->qbank_question_id.'/'.$test_status;
            $rowData = [
                $icon,
                $question->qbank_question_id,
                $question->qbankSystem->system_name,
                $question->pivot->choose_option,
                $question->pivot->time_spent,
                "<a  href='$question_view_url' title='Preview Question' onclick='deleteLocalStorage()'>
                <i class='la la-2x la-angle-right pointer fs-22 cursor-pointer ms-2'></i>
              </a>",
            ];

            $dataTable[] = $rowData;

        }


            // Get all QbankSystem
            $allSystems = QbankSystem::all();

            // Loop through each subject
            foreach ($allSystems as $system) {



                 // Filter questions related to the current system
                $questionsForSystem= $questions->filter(function ($question) use ($system) {
                    return $system->qbank_system_id == $question->qbankSystem->qbank_system_id;
                });

                // Check if there are questions for the subject
                if ($questionsForSystem->isEmpty()) {
                    // Skip if no questions for this subject
                    continue;
                }

                // Initialize totals for the current system
                $totalSystemCorrect = 0;
                $totalSystemIncorrect = 0;
                $totalSystemOmitted = 0;


                foreach ($questions as $question) {

                    // this will count total correct, incorrect, and omitted question related to the subject

                    if($system->qbank_system_id== $question->qbankSystem->qbank_system_id){

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


                 // Store totals in the associative array with the system name as the key
                $systemTotals[$system->system_name] = [
                    'correct' => $totalSystemCorrect,
                    'incorrect' => $totalSystemIncorrect,
                    'omitted' => $totalSystemOmitted,
                ];


            }



            $systemData = [];

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

            // JSON encode the data
            $jsonData = json_encode($systemData, JSON_PRETTY_PRINT);

            $data = [
                'result' => '#test_results',
                'test_id' => $test_id,
                'userTest' => $userTest,
                'dataTable' => $dataTable, // Pass the DataTable data to the view
                'jsonData' => $jsonData,

            ];



       return view('users.qbank_user.qbank_test_result.qbank_result',$data);


       }


       public function lunchUserQbankTestAnalytics($test_id){

         // Assuming $userTestId is the ID of the QbankUserTest instance you want to fetch questions for
         $userTest = QbankUserTest::find(decrypt($test_id));

         $user_test_id=$test_id;
         $mode=$userTest->mode;
         $test_status=$userTest->testStatus;

         if($mode === 'Timed Mode'){

            $mode ='toggleTimed';
        }else{

            $mode ='toggleTutor';
        }

         $question_mode=$userTest->questionMode;

         // Fetch all related questions with pivot information using the testQuestions relationship
         $questions = $userTest->testQuestionswithPivot;

         // Prepare data for DataTable
         $dataTable = [];

         foreach ($questions as $question) {
             $icon = "<i style='margin-left: 18px;'></i>";
             $status = $question->pivot->question_status;

             // Set icon based on question status
             if ($status == 'correct') {
                 $icon .= "<i class='la la-check' style='color: green;'></i>";
             } elseif ($status == 'omitted') {
                 $icon .= "<i class='la la-lg la-minus-circle ng-star-inserted' style='color: blue;'></i>";
             } elseif ($status == 'incorrect') {
                 $icon .= "<i class='la la-lg la-times' style='color: red;'></i>";
             }



             $question_view_url='/lunch_user_qbank_test_exam/'.$user_test_id.'/'.$mode.'/'.$question_mode.'/'.$question->qbank_question_id.'/'.$test_status;
             $rowData = [
                 $icon,
                 $question->qbank_question_id,
                 $question->qbankSystem->system_name,
                 $question->pivot->choose_option,
                 $question->pivot->time_spent,
                 "<a  href='$question_view_url' title='Preview Question'>
                 <i class='la la-2x la-angle-right pointer fs-22 cursor-pointer ms-2'></i>
               </a>",
             ];

             $dataTable[] = $rowData;

         }


             // Get all QbankSystem
             $allSystems = QbankSystem::all();

             // Loop through each subject
             foreach ($allSystems as $system) {

                // $totalSubjectCorrect=0;
                // $totalSubjectIncorrect=0;
                // $totalSubjectOmitted=0;

                  // Filter questions related to the current system
                 $questionsForSystem= $questions->filter(function ($question) use ($system) {
                     return $system->qbank_system_id == $question->qbankSystem->qbank_system_id;
                 });

                 // Check if there are questions for the subject
                 if ($questionsForSystem->isEmpty()) {
                     // Skip if no questions for this subject
                     continue;
                 }

                 // Initialize totals for the current system
                 $totalSystemCorrect = 0;
                 $totalSystemIncorrect = 0;
                 $totalSystemOmitted = 0;


                 foreach ($questions as $question) {

                     // this will count total correct, incorrect, and omitted question related to the subject

                     if($system->qbank_system_id== $question->qbankSystem->qbank_system_id){

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


                  // Store totals in the associative array with the system name as the key
                 $systemTotals[$system->system_name] = [
                     'correct' => $totalSystemCorrect,
                     'incorrect' => $totalSystemIncorrect,
                     'omitted' => $totalSystemOmitted,
                 ];


             }



             $systemData = [];

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

             // JSON encode the data
             $jsonData = json_encode($systemData, JSON_PRETTY_PRINT);

             $data = [
                 'result' => '#test_analytics',
                 'test_id' => $test_id,
                 'userTest' => $userTest,
                 'dataTable' => $dataTable, // Pass the DataTable data to the view
                 'jsonData' => $jsonData,

             ];


            return view('users.qbank_user.qbank_test_result.qbank_result', $data);


       }
}
