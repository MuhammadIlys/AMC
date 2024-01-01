<?php

namespace App\Http\Controllers\users\qbank_user\qbank_create_test;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_system\QbankSystem;
use App\Models\users\qbank_user\qbank_corrects\QbankCorrects;
use App\Models\users\qbank_user\qbank_incorrects\QbankIncorrects;
use App\Models\users\qbank_user\qbank_marked\QbankMarked;
use App\Models\users\qbank_user\qbank_omitted\QbankOmitted;
use App\Models\users\qbank_user\qbank_unused\QbankUnused;
use App\Models\users\qbank_user\qbank_used\QbankUsed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainQbankCreateTestController extends Controller
{
        public function lunchUserQbankCreateTest()
    {
        $qbank_id = Session::get('qbank_id'); // Replace with the desired qbank_id
        // Get the user ID from the session
        $userId = Session::get('user')->id;

        // Count the number of correct questions for the specified user and qbank_id
        $correctQuestionCount = QbankCorrects::where('id', $userId)
        ->where('qbank_id', $qbank_id)
        ->count();

        // Count the number of incorrect questions for the specified user and qbank_id
        $incorrectQuestionCount = QbankIncorrects::where('id', $userId)
        ->where('qbank_id', $qbank_id)
        ->count();

        // Count the number of omitted questions for the specified user and qbank_id
        $omittedQuestionCount = QbankOmitted::where('id', $userId)
        ->where('qbank_id', $qbank_id)
        ->count();

        // Count the number of marked questions for the specified user and qbank_id
        $markedQuestionCount = QbankMarked::where('id', $userId)
        ->where('qbank_id', $qbank_id)
        ->count();

        // Count the number of used questions for the specified user and qbank_id
        $usedQuestionCount = QbankUsed::where('id', $userId)
        ->where('qbank_id', $qbank_id)
        ->count();

         $unusedQuestionCount = QbankUnused::where('id', $userId)
         ->where('qbank_id', $qbank_id)
         ->count();

        // Fetch systems related to the specified qbank_id
        $systems = QbankSystem::whereHas('qbankQuestion', function ($query) use ($qbank_id) {
            $query->where('qbank_id', $qbank_id);
        })->withCount('qbankQuestion')->get();

        // Calculate total question count
        $totalQuestionCount = $systems->sum('qbank_question_count');

        return view('users.qbank_user.qbank_create_test.qbank_create_test', compact('systems', 'totalQuestionCount',

        'correctQuestionCount','incorrectQuestionCount', 'omittedQuestionCount','markedQuestionCount','usedQuestionCount',
        'unusedQuestionCount'

        ));




    }


    public function loadAllQuestion(){


        // Replace with the desired qbank_id
        $qbank_id =  Session::get('qbank_id');



        // Get the user ID from the session
        $userId = Session::get('user')->id;

        // Fetch systems related to the specified qbank_id
        $systems = QbankSystem::whereHas('qbankQuestion', function ($query) use ($qbank_id) {
            $query->where('qbank_id', $qbank_id);
        })->withCount('qbankQuestion')->get();


        // Calculate total question count
        $totalQuestionCount = $systems->sum('total_correct_count');



        // Return the result in JSON format
        return response()->json([
            'systems' => $systems

        ]);


    }

}
