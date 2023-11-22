<?php

namespace App\Http\Controllers\users\mocks_user\mocks_Result;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\speciality\Speciality;
use App\Models\super_admin\mocks\subject\Subject;
use Illuminate\Http\Request;
use App\Models\users\mocks_user\mocks_user_test_history\MocksUserTestHistory;


class MainMocksResultController extends Controller
{
    // lunch the mocks result view
    public function mocksResultView($custom_mocks_id){

        // Retrieve the MocksUserTestHistory with questions data
        $userCustomMocks = MocksUserTestHistory::with('questions')->find($custom_mocks_id);

        // Extract questions data from the user mocks
        $userCustomMocksquestion = $userCustomMocks->questions;


          // Prepare data for DataTable
    $dataTable = [];
    foreach ($userCustomMocksquestion as $question) {
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

        $rowData = [
            $icon,
            $question->question_id,
            $question->subject->subject_name,
            $question->speciality->speciality_name,
            $question->topic->topic_name,
            ($question->pivot->choose_option == 6) ? 'Not Selected' : chr(64 + $question->pivot->choose_option),
            $question->pivot->time_spent,
            "<a href='#' title='View Question'>
            <i class='la la-2x la-angle-right pointer fs-22 cursor-pointer ms-2'></i>
          </a>",
        ];

        $dataTable[] = $rowData;
    }

    $totalSubjectCorrect=0;
    $totalSubjectIncorrect=0;
    $totalSubjectOmitted=0;

    $totalSpecialityCorrect=0;
    $totalSpecialityIncorrect=0;
    $totalSpecialityOmitted=0;



        // Get all subjects
        $allSubjects = Subject::all();

        // Loop through each subject
        foreach ($allSubjects as $subject) {

            $totalSubjectCorrect=0;
            $totalSubjectIncorrect=0;
            $totalSubjectOmitted=0;

             // Filter questions related to the current subject
            $questionsForSubject = $userCustomMocksquestion->filter(function ($question) use ($subject) {
                return $subject->subject_id == $question->subject->subject_id;
            });

            // Check if there are questions for the subject
            if ($questionsForSubject->isEmpty()) {
                // Skip if no questions for this subject
                continue;
            }


            foreach ($userCustomMocksquestion as $question) {

                // this will count total correct, incorrect, and omitted question related to the subject

                if($subject->subject_id== $question->subject->subject_id){

                    switch ($question->pivot->question_status) {
                        case 'correct':
                            $totalSubjectCorrect++;
                            break;

                        case 'incorrect':
                            $totalSubjectIncorrect++;
                            break;

                        case 'omitted':
                            $totalSubjectOmitted++;
                            break;

                        default:
                            // Handle unexpected values, if any
                            break;
                    }

                }




            }



            // Get all specialities related to the current subject
            $specialities = $subject->specialties;

            // Loop through each speciality related to the subject
            foreach ($specialities as $speciality) {

                // Check if the speciality has questions before processing
                $questionsForSpeciality = $userCustomMocksquestion->filter(function ($question) use ($subject, $speciality) {
                    return $subject->subject_id == $question->subject->subject_id &&
                        $speciality->speciality_id == $question->speciality->speciality_id;
                });

                if ($questionsForSpeciality->isEmpty()) {
                    // Skip if no questions for this speciality
                    continue;
                }

                $totalSpecialityCorrect = 0;
                $totalSpecialityIncorrect = 0;
                $totalSpecialityOmitted = 0;

                // Calculate total counts for each question status related to the speciality
                foreach ($questionsForSpeciality as $question) {
                    switch ($question->pivot->question_status) {
                        case 'correct':
                            $totalSpecialityCorrect++;
                            break;

                        case 'incorrect':
                            $totalSpecialityIncorrect++;
                            break;

                        case 'omitted':
                            $totalSpecialityOmitted++;
                            break;

                        default:
                            // Handle unexpected values, if any
                            break;
                    }
                }


                // Create an associative array for the speciality
                $specialityData = [
                    'name' => $speciality->speciality_name,
                    'correct' => $totalSpecialityCorrect,
                    'incorrect' => $totalSpecialityIncorrect,
                    'omitted' => $totalSpecialityOmitted,
                ];

                // Append the speciality data to the datatable
                $dataTable2[$subject->subject_name][] = $specialityData;




            }


    $subjectData2 = [
        'name' => $subject->subject_name,
        'correct' => $totalSubjectCorrect,
        'incorrect' => $totalSubjectIncorrect,
        'omitted' => $totalSubjectOmitted,
        'specialities' => isset($dataTable2[$subject->subject_name]) ? $dataTable2[$subject->subject_name] : [],
    ];



    // Append the subject data to the datatable
    $dataTable2[$subject->subject_name] = $subjectData2;




}


// Assume $dataTable is your existing data structure

$data2 = [];

foreach ($dataTable2 as $subjectName => $subjectData) {


    // Calculate progress percentages for the progress bar
    $totalQuestions = $subjectData['correct'] + $subjectData['incorrect'] + $subjectData['omitted'];
    $correctPercentage = ($totalQuestions > 0) ? ($subjectData['correct'] / $totalQuestions) * 100 : 0;
    $incorrectPercentage = ($totalQuestions > 0) ? ($subjectData['incorrect'] / $totalQuestions) * 100 : 0;
    $omittedPercentage = ($totalQuestions > 0) ? ($subjectData['omitted'] / $totalQuestions) * 100 : 0;

    $subjectRow = [

        'name' => '<span>' . $subjectData['name'] . '</span>' .
            '<div class="progress mt-1" style="height:5px">' .
            '<div class="progress-bar bg-success" role="progressbar" style="width: ' . $correctPercentage . '%" aria-valuenow="' . $correctPercentage . '" aria-valuemin="0" aria-valuemax="100"></div>' .
            '<div class="progress-bar bg-danger" role="progressbar" style="width: ' . $incorrectPercentage . '%" aria-valuenow="' . $incorrectPercentage . '" aria-valuemin="0" aria-valuemax="100"></div>' .
            '<div class="progress-bar bg-warning " role="progressbar" style="width: ' . $omittedPercentage . '%" aria-valuenow="' . $omittedPercentage . '" aria-valuemin="0" aria-valuemax="100"></div>' .
            '</div>',
        'correct' => $subjectData['correct'],
        'incorrect' => $subjectData['incorrect'],
        'omitted' => $subjectData['omitted'],
        'specialities' => $subjectData['specialities'],
    ];

    $data2[] = $subjectRow;
}

// JSON encode the data
$jsonData = json_encode($data2, JSON_PRETTY_PRINT);


        $data = [
            'result' => '#test_results',
            'custom_mocks_id' => $custom_mocks_id,
            'userCustomMocks' => $userCustomMocks,
            'dataTable' => $dataTable, // Pass the DataTable data to the view
            'jsonData' => $jsonData,



        ];

        return view("users.mocks_user.mocks_result.mocksResult", $data);
    }

    public function mocksAnalyticsView(){
        $data = [
            'result' => '#test_analytics'

        ];
        return view("users.mocks_user.mocks_result.mocksResult",$data);
    }



    public function analyticsTableData($userCustomMocksquestion) {



            // Now $jsonData contains the required structure for DataTable in JSON format






    }






}
