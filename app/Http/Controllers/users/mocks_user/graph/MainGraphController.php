<?php

namespace App\Http\Controllers\users\mocks_user\graph;

use App\Http\Controllers\Controller;
use App\Models\users\mocks_user\mocks_user_test_history\MocksUserTestHistory;
use Illuminate\Http\Request;

use App\Models\super_admin\user_management\Users;
use Illuminate\Support\Facades\Session;
use App\Models\super_admin\mocks\subject\Subject;

class MainGraphController extends Controller
{
    //lunch graph view

        public function graphView()
    {
        $user_id = Session::get('user')->id;

        // Fetch user test histories with related data
        $userTestHistories = MocksUserTestHistory::with(['test', 'questions'])
            ->where('user_id', $user_id)
            ->get();

        // Transform data into the required structure
        $chartData = [];
        foreach ($userTestHistories as $history) {
            // Use a combination of test name and user ID as the series name
            $seriesName = $history->test->test_name;

            $chartData[$seriesName][] = [
                'date' => $history->created_at->format('m-d-Y'), // Adjust the date format as needed
                'score' => $history->score,
            ];
        }




        $userTestHistories = Users::find($user_id)->mockUserTestHistories;

        $chartData2 = [];

        // Get all subjects
        $allSubjects = Subject::all();

        // Initialize arrays to store total counts
        $totalCorrect = [];
        $totalIncorrect = [];
        $totalOmitted = [];

        // Initialize arrays for subject names
        $subjectNames = [];

        // Loop through each subject
        foreach ($allSubjects as $subject) {
            $questionsForSubject = collect([]);

            // Loop through each user test history
            foreach ($userTestHistories as $userTestHistory) {
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

            // Store the totals for each subject
            $totalCorrect[$subject->subject_name] = $totalSubjectCorrect;
            $totalIncorrect[$subject->subject_name] = $totalSubjectIncorrect;
            $totalOmitted[$subject->subject_name] = $totalSubjectOmitted;

            // Store subject names
            $subjectNames[] = $subject->subject_name;
        }

        // Create the chart data array
        foreach ($subjectNames as $subjectName) {
            $chartData2[] = [
                'subject_name' => $subjectName,
                'data' => [
                    'correct' => $totalCorrect[$subjectName] ?? 0,
                    'incorrect' => $totalIncorrect[$subjectName] ?? 0,
                    'omitted' => $totalOmitted[$subjectName] ?? 0,
                ],
            ];
        }



        $chartData3 = [];

        $testcountname=1;

     // Initialize an array to keep track of test names
        $usedTestNames = [];

        // Loop through each user test history
        foreach ($userTestHistories as $userTestHistory) {
            $testcountname++;
            $totalTimeInSeconds = 0; // Initialize total time spent in seconds for each test
            $baseTestName = $userTestHistory->test->test_name; // Assuming there is a 'test_name' field in your Test model
            $testName = $baseTestName;

            // Check if the test name already exists
            $testNameCount = 1;
            while (in_array($testName, $usedTestNames)) {
                $testName = $baseTestName . ' No.' . $testNameCount;
                $testNameCount++;
            }

            // Add the unique test name to the used names array
            $usedTestNames[] = $testName;

            // Loop through each question in the test
            foreach ($userTestHistory->questions as $question) {
                // Parse MM:SS and convert to seconds
                list($minutes, $seconds) = explode(':', $question->pivot->time_spent);
                $totalTimeInSeconds += $minutes * 60 + $seconds;
            }

            // Convert total time to hours with one decimal
            $totalTimeInHours = round($totalTimeInSeconds / 3600, 1);

            // Store the data in the chart array
            $chartData3[] = [
                'test_name' => $testName,
                'total_time_spent' => $totalTimeInHours,
            ];
        }




        // Pass the chart data to the view
        return view("users.mocks_user.graph.graph", [
                   'chartData' => $chartData,

                   'chartData2' => $chartData2,
                   'chartData3' => $chartData3,
                    ]);


    }


}
