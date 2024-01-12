<?php

namespace App\Http\Controllers\users\qbank_user\qbank_exam;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
use App\Models\users\qbank_user\qbank_corrects\QbankCorrects;
use App\Models\users\qbank_user\qbank_incorrects\QbankIncorrects;
use App\Models\users\qbank_user\qbank_marked\QbankMarked;
use App\Models\users\qbank_user\qbank_notes\QbankNote;
use App\Models\users\qbank_user\qbank_omitted\QbankOmitted;
use App\Models\users\qbank_user\qbank_unused\QbankUnused;
use App\Models\users\qbank_user\qbank_used\QbankUsed;
use App\Models\users\qbank_user\qbank_user_tests\QbankUserTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainQbankExamController extends Controller
{

   public function lunchUserQbankTestExam($test_id,$test_mode,$question_mode,$question_id=null,$test_status=null){

     if($question_id==='' || empty($question_id) || $question_id===null){

        $question_id='false';
     }

    $userTest = QbankUserTest::find(decrypt($test_id));

    // Assuming you want to get testQuestions using the testQuestions relationship defined in the model
    $questions = $userTest->testQuestionswithPivot;

    // Assuming you want to get qbankNoteQuestion and qbankMarkedQuestion only for the specified user_id and qbank_id
    $user_id = $userTest->user_id;
    $qbank_id = $userTest->qbank_id;

    $question_notes = QbankNote::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->whereIn('qbank_question_id', $questions->pluck('qbank_question_id'))
        ->get();

    $question_marked = QbankMarked::where('id', $user_id)
        ->where('qbank_id', $qbank_id)
        ->whereIn('qbank_question_id', $questions->pluck('qbank_question_id'))
        ->get();


    return view('users.qbank_user.qbank_exam.qbank_exam_lunch',[

        'questions' => $questions->values()->toJson(),
        'test_mode'=>$test_mode,
        'question_mode'=>$question_mode,
        'question_notes'=>$question_notes->values()->toJson(),
        'question_marked'=>$question_marked->values()->toJson(),
        'userTest'=>$test_id,
        'questionId'=>$question_id,
        'testStatus'=>$test_status,


    ]);


   }


   public function qbankExamEndResult(Request $request){

     // Decode the incoming JSON data
     $examResults = json_decode($request->getContent(), true);

     // Replace with the desired qbank_id
     $qbankId =  Session::get('qbank_id');

     // Get the user ID from the session
     $userId = Session::get('user')->id;

     $userTestId=decrypt($examResults['userTest']);

    // Access the arrays from the decoded JSON
    $markedQuestions = $examResults['markedQuestion'];
    $notesQuestion = $examResults['notesQuestion'];
    $omittedQuestions = $examResults['omittedQuestion'];
    $incorrectQuestions = $examResults['incorrectQuestion'];
    $correctQuestions = $examResults['correctQuestion'];
    $timeSpentQuestions = $examResults['timeSpentQuestions'];
    $testMode = $examResults['testMode'];
    $questionMode = $examResults['questionMode'];
    $testStatus=$examResults['testStatus'];

    if($testMode === 'toggleTimed'){

        $testMode ='Timed Mode';
    }else{

        $testMode ='Tutor Mode';
    }


     // Count the total number of correct, incorrect, omitted, and marked questions
     $totalCorrect = count($correctQuestions);
     $totalIncorrect = count($incorrectQuestions);
     $totalOmitted = count($omittedQuestions);
     $totalMarked = count($markedQuestions);


     // Calculate the total number of questions
    $totalQuestions = $totalCorrect + $totalIncorrect + $totalOmitted + $totalMarked;

    // Calculate the percentage of correct questions
    $percentageCorrect = ($totalCorrect / $totalQuestions) * 100;

     // Format the percentage to two decimal places
     $formattedPercentage = number_format($percentageCorrect, 2);

     // Retrieve the existing QbankUserTest record based on some criteria (for example, user_id and qbank_id)
    $qbankUserTest = QbankUserTest::where('user_test_id', $userTestId)
    ->where('user_id', $userId)
    ->where('qbank_id', $qbankId)
    ->first();

     // Update the attributes of the retrieved record
    if ($qbankUserTest) {
        $qbankUserTest->update([
            'name'=>'Block Name',
            'mode'=>$testMode,
            'questionMode'=>$questionMode,
            'testStatus'=>$testStatus,
            'marked' => $totalMarked,
            'correct' => $totalCorrect,
            'incorrect' => $totalIncorrect,
            'omitted' => $totalOmitted,
            'perscent' => $formattedPercentage ,
        ]);
    }

    // Loop through the time spent per questions
    foreach ($timeSpentQuestions as $timeQuestionId=>$timeQuestion) {


        foreach($timeQuestion as $timeQId =>$time){

            $qbankUserTest->testQuestionswithPivot()
                ->where('qbank_user_test_question_history.user_test_id', $userTestId)
                ->where('qbank_user_test_question_history.qbank_question_id', $timeQId)
                ->update([
                    'time_spent' => $time,

                ]);


        }


    }


    // Loop through the incorrect questions
    foreach ($incorrectQuestions as $incorrectQuestionId=>$incorrectQuestion) {


        foreach($incorrectQuestion as $incorrectQId =>$incorrect){

            $qbankUserTest->testQuestionswithPivot()
                ->where('qbank_user_test_question_history.user_test_id', $userTestId)
                ->where('qbank_user_test_question_history.qbank_question_id', $incorrectQId)
                ->update([
                    'choose_option' => $incorrect,
                    'question_status' => 'incorrect',
                ]);

                    // delete correct of this from omitted questions
            $existingNote = Qbankcorrects::where('qbank_question_id', $incorrectQId)
            ->where('id', $userId)
            ->where('qbank_id', $qbankId)
            ->first();

            if ($existingNote) {

                $existingNote->delete();

            }

            // delete omitted question object

           $existingNote = QbankOmitted::where('qbank_question_id', $incorrectQId)
           ->where('id', $userId)
           ->where('qbank_id', $qbankId)
           ->first();
           if ($existingNote) {

              $existingNote->delete();

            }

          // create correct questions
           $existingNote = QbankIncorrects::where('qbank_question_id', $incorrectQId)
           ->where('id', $userId)
           ->where('qbank_id', $qbankId)
           ->first();

           if (!$existingNote){

            QbankIncorrects::create([
                'qbank_question_id' => $incorrectQId,
                'id' => $userId,
                'qbank_id' => $qbankId,
            ]);


           }


           // create used questions
           $existingNote = QbankUsed::where('qbank_question_id', $incorrectQId)
           ->where('id', $userId)
           ->where('qbank_id', $qbankId)
           ->first();

           if (!$existingNote){

            QbankUsed::create([
                'qbank_question_id' => $incorrectQId,
                'id' => $userId,
                'qbank_id' => $qbankId,
            ]);


           }



        }


    }

    // Loop through the correct questions
    foreach ($correctQuestions as $correctQuestionId=>$correctQuestion) {


        foreach($correctQuestion as $correctQId =>$correct){

            $qbankUserTest->testQuestionswithPivot()
                ->where('qbank_user_test_question_history.user_test_id', $userTestId)
                ->where('qbank_user_test_question_history.qbank_question_id', $correctQId)
                ->update([
                    'choose_option' => $correct,
                    'question_status' => 'correct',
                ]);



            // delete correct of this from omitted questions
            $existingNote = QbankIncorrects::where('qbank_question_id', $correctQId)
            ->where('id', $userId)
            ->where('qbank_id', $qbankId)
            ->first();

            if ($existingNote) {

                $existingNote->delete();

            }

            // delete omitted question object

           $existingNote = QbankOmitted::where('qbank_question_id', $correctQId)
           ->where('id', $userId)
           ->where('qbank_id', $qbankId)
           ->first();
           if ($existingNote) {

              $existingNote->delete();

            }

          // create correct questions
           $existingNote = QbankCorrects::where('qbank_question_id', $correctQId)
           ->where('id', $userId)
           ->where('qbank_id', $qbankId)
           ->first();

           if (!$existingNote){

            QbankCorrects::create([
                'qbank_question_id' => $correctQId,
                'id' => $userId,
                'qbank_id' => $qbankId,
            ]);


           }


            // create used questions
            $existingNote = QbankUsed::where('qbank_question_id', $correctQId)
            ->where('id', $userId)
            ->where('qbank_id', $qbankId)
            ->first();

            if (!$existingNote){

             QbankUsed::create([
                 'qbank_question_id' => $correctQId,
                 'id' => $userId,
                 'qbank_id' => $qbankId,
             ]);


            }





        }


    }

     // Loop through the omitted questions

    foreach($omittedQuestions as $omitted){



        $qbankUserTest->testQuestionswithPivot()
            ->where('qbank_user_test_question_history.user_test_id', $userTestId)
            ->where('qbank_user_test_question_history.qbank_question_id', $omitted)
            ->update([
                'choose_option' => 'Not Selected',
                'question_status' => 'omitted',
            ]);


            // delete correct of this from omitted questions
            $existingNote = QbankCorrects::where('qbank_question_id', $omitted)
            ->where('id', $userId)
            ->where('qbank_id', $qbankId)
            ->first();

            if ($existingNote) {

                $existingNote->delete();

            }

            // delete correct of this from omitted questions
            $existingNote = QbankIncorrects::where('qbank_question_id', $omitted)
            ->where('id', $userId)
            ->where('qbank_id', $qbankId)
            ->first();

            if ($existingNote) {

                $existingNote->delete();

            }

           // create omitted question object

           $existingNote = QbankOmitted::where('qbank_question_id', $omitted)
           ->where('id', $userId)
           ->where('qbank_id', $qbankId)
           ->first();

           if (!$existingNote){

            QbankOmitted::create([
                'qbank_question_id' => $omitted,
                'id' => $userId,
                'qbank_id' => $qbankId,
            ]);


           }


    }





    // Loop through the note per questions
    foreach ($notesQuestion as $notesQuestionId=>$noteQuestion) {


        foreach($noteQuestion as $noteQId =>$note){


            // if condition to check and then update or create a QbankNote object
                $existingNote = QbankNote::where('qbank_notes.qbank_question_id', $noteQId)
                ->where('qbank_notes.id', $userId)
                ->where('qbank_notes.qbank_id', $qbankId)
                ->first();


                if ($existingNote) {

                    if(empty($note)){

                        $existingNote->delete();

                    }else{

                        // Update the existing record
                        $existingNote->update(['note' => $note]);

                    }

                } else {

                    if(!empty($note)){

                         // Create a new record
                        QbankNote::create([
                            'qbank_question_id' => $noteQId,
                            'id' => $userId,
                            'qbank_id' => $qbankId,
                            'note' => $note,
                        ]);


                    }


                }




        }


    }




    // Loop through the note per questions
    foreach ($markedQuestions as $markedQuestionId => $markedQuestion) {
        foreach ($markedQuestion as $markedQId2 => $marked) {

           // dd($marked);
            if ($marked === "true") {
                $existingNote = QbankMarked::where('qbank_question_id', $markedQId2)
                    ->where('id', $userId)
                    ->where('qbank_id', $qbankId)
                    ->first();

                if (!$existingNote) {
                    // Create a new record
                    QbankMarked::create([
                        'qbank_question_id' => $markedQId2,
                        'id' => $userId,
                        'qbank_id' => $qbankId,
                    ]);
                }
            } else {


                // if condition to check and then update or create a QbankNote object
                $existingNote = QbankMarked::where('qbank_question_id', $markedQId2)
                    ->where('id', $userId)
                    ->where('qbank_id', $qbankId)
                    ->first();

                if ($existingNote) {
                    $existingNote->delete();
                }
            }
        }
    }



    // managing unused question


       // Get the IDs of used questions matching user and qbank
       $usedQuestionIds = QbankUsed::where('id', $userId)
       ->where('qbank_id', $qbankId)
       ->pluck('qbank_question_id');

       foreach ($usedQuestionIds as $questionId) {

        $record = QbankUnused::firstOrNew([
            'qbank_question_id' => $questionId,
            'id' => $userId,
            'qbank_id' => $qbankId,
        ]);

        if ($record->exists) {
            $record->delete();
        }


       }

       // Retrieve all unused question IDs matching user and qbank
       $filteredUnusedQuestionIds = QbankQuestion::where('qbank_id', $qbankId)
       ->whereNotIn('qbank_question_id', $usedQuestionIds)
       ->pluck('qbank_question_id');



       // Store the filtered unused question IDs in the QbankUnused model
       foreach ($filteredUnusedQuestionIds as $questionId) {

            $record = QbankUnused::firstOrNew([
                'qbank_question_id' => $questionId,
                'id' => $userId,
                'qbank_id' => $qbankId,
            ]);

            if (!$record->exists) {
                $record->save();
            }
        }







   }




}
