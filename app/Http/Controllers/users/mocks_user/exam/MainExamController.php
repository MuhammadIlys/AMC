<?php

namespace App\Http\Controllers\users\mocks_user\exam;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\test\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainExamController extends Controller
{
    public function mocksLunchMocks(){

        $testId = Session::get('user_mocks_id');
        if ($testId === null) {
            // Handle the case where the user does not have a mock test ID
            return view('users.mocks_user.exam.exam_start');
        }

        $test=Test::find($testId)->first();

        return view('users.mocks_user.exam.exam_start', compact('test'));
    }

    public function mocksTerms(){

        $testId = Session::get('user_mocks_id');
        if ($testId === null) {
            // Handle the case where the user does not have a mock test ID
            return view('users.mocks_user.exam.exam_start');
        }

        $test=Test::find($testId)->first();

        return view('users.mocks_user.exam.before_start_exam', compact('test'));
    }

    public function mocksStart(){

        $testId = Session::get('user_mocks_id');

        if ($testId === null) {
            // Handle the case where the user does not have a mock test ID
            return view('users.mocks_user.exam.exam_start');
        }

        // Assuming you have a relationship between Test and Question model
        $questions = Test::find($testId)->questions;
        $test=Test::find($testId)->first();

        // Pass the questions to the view
        return view('users.mocks_user.exam.start_real_exam', compact('questions','test'));
    }
}
