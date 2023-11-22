<?php

namespace App\Http\Controllers\users\mocks_user\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\super_admin\user_management\Users;
use Illuminate\Support\Facades\Session;
use App\Models\super_admin\mocks\subject\Subject;


class MainReportController extends Controller
{
     // lunch report view
     public function reportView(){


        $user_id = Session::get('user')->id;

        // Fetch all user test histories
        $userTestHistories = Users::find($user_id)->mockUserTestHistories;

        // Initialize data structure to store results
        $dataTable2 = [];

        // Get all subjects
        $allSubjects = Subject::all();

        // Loop through each subject
        foreach ($allSubjects as $subject) {

            // Check if there are questions related to the subject
            $questionsForSubject = collect([]);

            // Loop through each user test history
            foreach ($userTestHistories as $userTestHistory) {
                // Loop through each question related to the test history
                foreach ($userTestHistory->questions as $question) {
                    // Check if the question is related to the current subject
                    if ($subject->subject_id == $question->subject->subject_id) {
                        $questionsForSubject->push($question);
                    }
                }
            }

            if ($questionsForSubject->isEmpty()) {
                // Skip the subject if there are no questions
                continue;
            }

            $totalSubjectCorrect = 0;
            $totalSubjectIncorrect = 0;
            $totalSubjectOmitted = 0;

            // Loop through each question related to the subject
            foreach ($questionsForSubject as $question) {
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

            // Get all specialities related to the current subject
            $specialities = $subject->specialties;

            // Initialize data structure for specialities
            $specialitiesData = [];

            // Loop through each speciality related to the subject
            foreach ($specialities as $speciality) {
                // Check if there are questions related to the speciality
                $questionsForSpeciality = $questionsForSubject->filter(function ($question) use ($speciality) {
                    return $speciality->speciality_id == $question->speciality->speciality_id;
                });

                if ($questionsForSpeciality->isEmpty()) {
                    // Skip the speciality if there are no questions
                    continue;
                }

                $totalSpecialityCorrect = 0;
                $totalSpecialityIncorrect = 0;
                $totalSpecialityOmitted = 0;

                // Loop through each question related to the speciality
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
                $specialitiesData[] = $specialityData;
            }

            // Create an associative array for the subject
            $subjectData = [
                'name' => $subject->subject_name,
                'correct' => $totalSubjectCorrect,
                'incorrect' => $totalSubjectIncorrect,
                'omitted' => $totalSubjectOmitted,
                'specialities' => $specialitiesData,
            ];

            // Append the subject data to the datatable
            $dataTable2[] = $subjectData;
        }

        // Assume $dataTable is your existing data structure

        $data2 = [];

        foreach ($dataTable2 as $subjectData) {
            // Check if the keys 'name', 'correct', 'incorrect', and 'omitted' exist in $subjectData
            if (array_key_exists('name', $subjectData) && array_key_exists('correct', $subjectData) && array_key_exists('incorrect', $subjectData) && array_key_exists('omitted', $subjectData)) {
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
        }

        // JSON encode the data
        $jsonData = json_encode($data2, JSON_PRETTY_PRINT);





                    // Pass data to the view
                    return view("users.mocks_user.report.reports", [
                        'jsonData' => $jsonData,

                    ]);
    }


}
