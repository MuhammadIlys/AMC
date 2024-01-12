<?php

namespace App\Http\Controllers\users\qbank_user\qbank_previous_test;

use App\Http\Controllers\Controller;
use App\Models\super_admin\user_management\Users;
use App\Models\users\qbank_user\qbank_user_tests\QbankUserTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainQbankPreviousTestController extends Controller
{

    public function lunchUserQbankPreviousTests(){


        $user_id = session::get('user')->id;
        $qbank_id = Session::get('qbank_id');

        // Assuming you have a one-to-many relationship between Users and QbankUserTest
        $userTestHistories = Users::find($user_id)
        ->qbankUserTestHistories()
        ->where('qbank_id', $qbank_id) // Add condition for Qbank
        ->get();


        $dataSet = [];

        foreach ($userTestHistories as $history) {

            $user_test_id=encrypt($history->user_test_id);


            if($history->mode === 'Timed Mode'){

                $mode2 ='toggleTimed';
            }else{

                $mode2 ='toggleTutor';
            }

            $question_mode=$history->questionMode;

            $question_id='false';

            $test_status=$history->testStatus;

            $questionsWithPivot = $history->testQuestionswithPivot;

            $percentage = round($history->perscent) . "%";
            $blockName = $history->name;
            $blockId = $history->user_test_id;
            $mode = $history->mode;
            $date = $history->created_at->format('Y/m/d');

            // Assuming other fields are accessible directly from the $history object
            $marked = $history->marked;
            $correct = $history->correct;
            $incorrect = $history->incorrect;
            $omitted = $history->omitted;
            $testStatus=$history->testStatus;
            $badgeClass2 = (round($history->perscent)>= 50) ? 'badge rounded-pill bg-success' : 'badge rounded-pill bg-danger';
            $badgeClass3 = ($history->testStatus=== 'end') ? 'badge rounded-pill bg-success' : 'badge rounded-pill bg-danger';
            $urlMockResults = "/lunch_user_qbank_test_result/".$user_test_id;
            $urlTestAnalytics = "/lunch_user_qbank_test_analytics/".$user_test_id;

            $urlTestPreviewQuestion = '/lunch_user_qbank_test_exam/'.$user_test_id.'/'.$mode2.'/'.$question_mode .'/'.$question_id.'/'.$test_status;

            // Build the row for DataTable
            $row = [

                $blockId,
                "<div class='editable-container'>
                <input style='width:70px'  type='text' class='editable' data-name='block_name' data-url='save' data-test-id='$history->user_test_id' value='$blockName' readonly>
                <i style='cursor: pointer;' class='la la-edit fs-18 edit-icon' aria-hidden='true'></i>
                </div>",
                "<span class='$badgeClass2'>$percentage</span>",
                $date,
                $marked,
                $correct,
                $incorrect,
                $omitted,
                "<span class='$badgeClass3'>$testStatus</span>",
                $mode,
                '<a title="Show Test Preview" href="' . $urlTestPreviewQuestion . '"  onclick="deleteLocalStorage()"><i class="la la-play-circle la-lg pointer fs-22 cursor-pointer" style="color: #2196F3"></i></a> <a title="Show Test Result" href="' . $urlMockResults . '"><i class="la la-tasks la-lg pointer fs-22 cursor-pointer ms-2" style="color: #2196F3"></i></a> <a title="Show Test Analytics" href="' . $urlTestAnalytics . '"><i class="bx bx-bar-chart pointer fs-22 cursor-pointer ms-2" style="color: #2196F3"></i></a>'
            ];

            // Add the row to the DataSet
            $dataSet[] = $row;
        }



        return view('users.qbank_user.qbank_previous_test.qbank_previous_test', compact('dataSet'));


    }



    public function updateUserTestName(Request $request)
    {
        $user_test_id = $request->input('test_id');
        $test_name = $request->input('value');

        $test = QbankUserTest::find($user_test_id);

        if ($test) {
            $test->update([
                'name' => $test_name
            ]);

            return response()->json(['status' => 'success', 'message' => 'Test name updated successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Test not found'], 404);
        }
    }



}
