<?php

namespace App\Http\Controllers\users\qbank_user\qbank_account_reset;

use App\Http\Controllers\Controller;
use App\Models\users\qbank_user\qbank_account_reset\QbankAccountReset;
use App\Models\users\qbank_user\qbank_corrects\QbankCorrects;
use App\Models\users\qbank_user\qbank_highlights\QbankHighlight;
use App\Models\users\qbank_user\qbank_incorrects\QbankIncorrects;
use App\Models\users\qbank_user\qbank_last_correct_fetch_question\LastCorrectFetchedQuestion;
use App\Models\users\qbank_user\qbank_last_fetch_question\LastFetchedQuestion;
use App\Models\users\qbank_user\qbank_last_incorrect_fetch_question\LastIncorrectFetchedQuestion;
use App\Models\users\qbank_user\qbank_last_marked_fetch_question\LastMarkedFetchedQuestion;
use App\Models\users\qbank_user\qbank_last_omitted_fetch_question\LastOmittedFetchedQuestion;
use App\Models\users\qbank_user\qbank_last_unused_fetch_question\LastUnusedFetchedQuestion;
use App\Models\users\qbank_user\qbank_last_used_fetch_question\LastUsedFetchedQuestion;
use App\Models\users\qbank_user\qbank_marked\QbankMarked;
use App\Models\users\qbank_user\qbank_notes\QbankNote;
use App\Models\users\qbank_user\qbank_omitted\QbankOmitted;
use App\Models\users\qbank_user\qbank_unused\QbankUnused;
use App\Models\users\qbank_user\qbank_used\QbankUsed;
use App\Models\users\qbank_user\qbank_user_tests\QbankUserTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class MainQbankAccountResetController extends Controller
{

   public function lunchUserQbankTestResetAccount(){

    $user_id = Session::get('user')->id;
    $qbank_id = Session::get('qbank_id');

    $usertests = QbankUserTest::where('user_id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->get();

    $accountReset = QbankAccountReset::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->where('reset_type', 'test')
        ->first();



    $hasTests = false; // Initialize the variable

    if ($usertests->isEmpty()) {
        // No user tests found
        $hasTests = false;
    } else {
        if ($accountReset) {
            if ($accountReset->reset_count < 2) {
                // User has tests and reset_count is less than 2
                $hasTests = true;
            } else {
                // User has tests, but reset_count is 2 or more
                $hasTests = false;
            }
        } else {
            // User has tests, but no reset record found
            $hasTests = true;
        }
    }

    $userNotes = QbankNote::where('id', $user_id)
    ->where('qbank_id', $qbank_id)
    ->get();

    $accountReset = QbankAccountReset::where('id', $user_id)
    ->where('qbank_id', $qbank_id)
    ->where('reset_type', 'note')
    ->first();

    $hasNotes = false;

    if ($userNotes->isEmpty()) {
        // No user tests found
        $hasNotes = false;
    } else {
        if ($accountReset) {
            if ($accountReset->reset_count < 2) {
                // User has tests and reset_count is less than 2
                $hasNotes = true;
            } else {
                // User has tests, but reset_count is 2 or more
                $hasNotes = false;
            }
        } else {
            // User has tests, but no reset record found
            $hasNotes = true;
        }
    }


    $userHighlights = QbankHighlight::where('id', $user_id)
    ->where('qbank_id', $qbank_id)
    ->get();

    $accountReset = QbankAccountReset::where('id', $user_id)
    ->where('qbank_id', $qbank_id)
    ->where('reset_type', 'highlight')
    ->first();

    $hasHighlights = false;

    if ($userHighlights->isEmpty()) {
        // No user tests found
        $hasHighlights = false;
    } else {
        if ($accountReset) {
            if ($accountReset->reset_count < 2) {
                // User has tests and reset_count is less than 2
                $hasHighlights = true;
            } else {
                // User has tests, but reset_count is 2 or more
                $hasHighlights = false;
            }
        } else {
            // User has tests, but no reset record found
            $hasHighlights = true;
        }
    }


    $userMarked = QbankMarked::where('id', $user_id)
    ->where('qbank_id', $qbank_id)
    ->get();

    $accountReset = QbankAccountReset::where('id', $user_id)
    ->where('qbank_id', $qbank_id)
    ->where('reset_type', 'marked')
    ->first();

    $hasMarked = false;

    if ($userMarked->isEmpty()) {
        // No user tests found
        $hasMarked = false;
    } else {
        if ($accountReset) {
            if ($accountReset->reset_count < 2) {
                // User has tests and reset_count is less than 2
                $hasMarked = true;
            } else {
                // User has tests, but reset_count is 2 or more
                $hasMarked = false;
            }
        } else {
            // User has tests, but no reset record found
            $hasMarked = true;
        }
    }



    $data = ['hasTests' => $hasTests, 'hasNotes'=>$hasNotes, 'hasHighlights'=>$hasHighlights,'hasMarked'=>$hasMarked];

    return view('users.qbank_user.qbank_account_reset.qbank_account_reset',$data);


   }

   public function userQbankTestReset(Request $request){

    $user_id = Session::get('user')->id;

    $qbank_id = Session::get('qbank_id');

    $reset_type= $request->input('resetType');

    // Find the existing QbankAccountReset object for the user and qbank
    $accountReset = QbankAccountReset::where('id', $user_id)
    ->where('qbank_id', $qbank_id)
    ->where('reset_type', $reset_type)
    ->first();

    if ($accountReset) {

         // If the reset_count is less than 2, update the reset_count
        if ($accountReset->reset_count < 2) {
            $count=$accountReset->reset_count+1;
            $accountReset->update(['reset_count' => $count]);

            $status=$this->testDataReset();

            if($status){

                return response()->json(['message'=>'Tests Reset Successfully!','status'=>$status]);

            }else{

                return response()->json(['message'=>'Error Occure During Reset!','status'=>$status]);
            }


        } else {

          // error show account reset completed
          $status=false;
          return response()->json(['message'=>'Your Tests Reset is Over!','status'=>$status]);

        }


    }else{

        QbankAccountReset::create([
            'id' => $user_id,
            'qbank_id' => $qbank_id,
            'reset_type' => $reset_type,
            'reset_count' => 1,
        ]);

        $status=$this->testDataReset();
        if($status){

            return response()->json(['message'=>'Tests Reset Successfully!','status'=>$status]);

        }else{

            return response()->json(['message'=>'Error Occure During Reset!','status'=>$status]);
        }

    }


   }


   private function testDataReset() {
    $user_id = Session::get('user')->id;
    $qbank_id = Session::get('qbank_id');

    try {
        // Delete the object based on user_id and qbank_id in each table
        QbankUserTest::where('user_id', $user_id)->where('qbank_id', $qbank_id)->delete();
        LastFetchedQuestion::where('user_id', $user_id)->where('qbank_id', $qbank_id)->delete();
        LastCorrectFetchedQuestion::where('user_id', $user_id)->where('qbank_id', $qbank_id)->delete();
        LastIncorrectFetchedQuestion::where('user_id', $user_id)->where('qbank_id', $qbank_id)->delete();
        LastOmittedFetchedQuestion::where('user_id', $user_id)->where('qbank_id', $qbank_id)->delete();
        LastUsedFetchedQuestion::where('user_id', $user_id)->where('qbank_id', $qbank_id)->delete();
        LastUnusedFetchedQuestion::where('user_id', $user_id)->where('qbank_id', $qbank_id)->delete();
        LastMarkedFetchedQuestion::where('user_id', $user_id)->where('qbank_id', $qbank_id)->delete();
        QbankCorrects::where('id', $user_id)->where('qbank_id', $qbank_id)->delete();
        QbankIncorrects::where('id', $user_id)->where('qbank_id', $qbank_id)->delete();
        QbankOmitted::where('id', $user_id)->where('qbank_id', $qbank_id)->delete();
        QbankUsed::where('id', $user_id)->where('qbank_id', $qbank_id)->delete();
        QbankUnused::where('id', $user_id)->where('qbank_id', $qbank_id)->delete();

        return true;
    } catch (QueryException $exception) {

        return false;
    }
}



   public function userQbankNotesReset(Request $request){

    $user_id = Session::get('user')->id;

    $qbank_id = Session::get('qbank_id');

    $reset_type= $request->input('resetType');

    // Find the existing QbankAccountReset object for the user and qbank
    $accountReset = QbankAccountReset::where('id', $user_id)
    ->where('qbank_id', $qbank_id)
    ->where('reset_type', $reset_type)
    ->first();

    if ($accountReset) {

         // If the reset_count is less than 2, update the reset_count
        if ($accountReset->reset_count < 2) {
            $count=$accountReset->reset_count+1;
            $accountReset->update(['reset_count' => $count]);

            $status=$this->notesDataReset();

            if($status){

                return response()->json(['message'=>'Account Notes Successfully!','status'=>$status]);

            }else{

                return response()->json(['message'=>'Error Occure During Reset!','status'=>$status]);
            }


        } else {

          // error show account reset completed
          $status=false;
          return response()->json(['message'=>'Your Notes Reset is Over!','status'=>$status]);

        }


    }else{

        QbankAccountReset::create([
            'id' => $user_id,
            'qbank_id' => $qbank_id,
            'reset_type' => $reset_type,
            'reset_count' => 1,
        ]);

        $status=$this->notesDataReset();
        if($status){

            return response()->json(['message'=>'Notes Reset Successfully!','status'=>$status]);

        }else{

            return response()->json(['message'=>'Error Occure During Reset!','status'=>$status]);
        }

    }


   }

    private function notesDataReset(){
        $user_id = Session::get('user')->id;

        $qbank_id = Session::get('qbank_id');

        try{

            QbankNote::where('id', $user_id)->where('qbank_id', $qbank_id)->delete();
            return true;
        } catch (QueryException $exception) {

            return false;
        }
    }




   public function userQbankHighlightsReset(Request $request){
    $user_id = Session::get('user')->id;

    $qbank_id = Session::get('qbank_id');

    $reset_type= $request->input('resetType');

    // Find the existing QbankAccountReset object for the user and qbank
    $accountReset = QbankAccountReset::where('id', $user_id)
    ->where('qbank_id', $qbank_id)
    ->where('reset_type', $reset_type)
    ->first();

    if ($accountReset) {

         // If the reset_count is less than 2, update the reset_count
        if ($accountReset->reset_count < 2) {
            $count=$accountReset->reset_count+1;
            $accountReset->update(['reset_count' => $count]);

            $status=$this->highlightsDataReset();

            if($status){

                return response()->json(['message'=>'Highlights Reset Successfully!','status'=>$status]);

            }else{

                return response()->json(['message'=>'Error Occure During Reset!','status'=>$status]);
            }


        } else {

          // error show account reset completed
          $status=false;
          return response()->json(['message'=>'Your Highlights Reset is Over!','status'=>$status]);

        }


    }else{

        QbankAccountReset::create([
            'id' => $user_id,
            'qbank_id' => $qbank_id,
            'reset_type' => $reset_type,
            'reset_count' => 1,
        ]);

        $status=$this->highlightsDataReset();
        if($status){

            return response()->json(['message'=>'Highlights Reset Successfully!','status'=>$status]);

        }else{

            return response()->json(['message'=>'Error Occure During Reset!','status'=>$status]);
        }

    }


   }

   private function highlightsDataReset(){
    $user_id = Session::get('user')->id;

    $qbank_id = Session::get('qbank_id');

    try{

        QbankHighlight::where('id', $user_id)->where('qbank_id', $qbank_id)->delete();
        return true;
    } catch (QueryException $exception) {

        return false;
    }
}

   public function userQbankMarkedReset(Request $request){
    $user_id = Session::get('user')->id;

    $qbank_id = Session::get('qbank_id');

    $reset_type= $request->input('resetType');

    // Find the existing QbankAccountReset object for the user and qbank
    $accountReset = QbankAccountReset::where('id', $user_id)
    ->where('qbank_id', $qbank_id)
    ->where('reset_type', $reset_type)
    ->first();

    if ($accountReset) {

         // If the reset_count is less than 2, update the reset_count
        if ($accountReset->reset_count < 2) {
            $count=$accountReset->reset_count+1;
            $accountReset->update(['reset_count' => $count]);

            $status=$this->markedDataReset();

            if($status){

                return response()->json(['message'=>'Marked Reset Successfully!','status'=>$status]);

            }else{

                return response()->json(['message'=>'Error Occure During Reset!','status'=>$status]);
            }


        } else {

          // error show account reset completed
          $status=false;
          return response()->json(['message'=>'Your Marked  Reset is Over!','status'=>$status]);

        }


    }else{

        QbankAccountReset::create([
            'id' => $user_id,
            'qbank_id' => $qbank_id,
            'reset_type' => $reset_type,
            'reset_count' => 1,
        ]);

        $status=$this->markedDataReset();
        if($status){

            return response()->json(['message'=>'Marked Reset Successfully!','status'=>$status]);

        }else{

            return response()->json(['message'=>'Error Occure During Reset!','status'=>$status]);
        }

    }


   }


   private function markedDataReset(){

    $user_id = Session::get('user')->id;

    $qbank_id = Session::get('qbank_id');

    try{

        QbankMarked::where('id', $user_id)->where('qbank_id', $qbank_id)->delete();
        return true;
    } catch (QueryException $exception) {

        return false;
    }
}



}
