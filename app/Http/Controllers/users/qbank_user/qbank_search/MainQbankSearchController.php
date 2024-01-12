<?php

namespace App\Http\Controllers\users\qbank_user\qbank_search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\users\qbank_user\qbank_user_tests\QbankUserTest;

class MainQbankSearchController extends Controller
{
    public function lunchUserQbankSearch(){

        return view('users.qbank_user.qbank_search.qbank_search');


      }

      public function loadQbankSearchQuestion(Request $request){

        $user_id = Session::get('user')->id;

        $qbank_id = Session::get('qbank_id');

        $questionId = $request->input('questionId');



        // Fetch all user test histories
        $userTestHistories =QbankUserTest::where('user_id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->get();

        if ($userTestHistories->isNotEmpty()) {

            foreach ($userTestHistories as $userTestHistory) {

                $user_test_id= encrypt($userTestHistory->user_test_id);
                $mode=$userTestHistory->mode;
                $test_status=$userTestHistory->testStatus;


                 if($mode === 'Timed Mode'){

                    $mode ='toggleTimed';
                }else{

                    $mode ='toggleTutor';
                }

                $question_mode=$userTestHistory->questionMode;

                foreach ($userTestHistory->testQuestionswithPivot as $question) {

                    if($question->qbank_question_id==$questionId){


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
                            $question->pivot->question_status,
                            "<a  href='$question_view_url' title='Preview Question' onclick='deleteLocalStorage()'>
                            <i class='la la-2x la-angle-right pointer fs-22 cursor-pointer ms-2'></i>
                          </a>",
                        ];

                        $dataTable[] = $rowData;



                        break 2;
                    }



                }

            }

        }

        // Check if the dataset is empty

       if(empty($dataTable)){

        $dataTable=null;

        $status=false;
       }else{

        $status=true;

       }


        return response()->json(['dataSet' => $dataTable, 'status'=>$status]);


      }
}
