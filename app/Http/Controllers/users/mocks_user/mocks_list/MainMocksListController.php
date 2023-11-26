<?php

namespace App\Http\Controllers\users\mocks_user\mocks_list;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\test\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainMocksListController extends Controller
{
    // lunch the mocks list view
    public function mocksListView()

    {
        $user=Session::get('user');

        // Fetch data for the tests linked to the user and related questions
        $tests = $user->mocks_test_management()->with('questions')->where('test_status', 'active')->get();

        // You can further customize the data preparation based on your needs
        $mocksData = $tests->map(function ($test) {
            return [
                'test_id' => $test->test_id,
                'test_name' => $test->test_name,
                'total_questions' => $test->questions->count(),
                'hard_questions' => $test->questions->where('question_type', '1')->count(),
                'easy_questions' => $test->questions->where('question_type', '3')->count(),
                'fair_questions' => $test->questions->where('question_type', '2')->count(),
            ];
        });

        // Send the data to the view
        return view("users.mocks_user.mocks_list.mocksList", compact('mocksData'));
    }


    public function storeMocksId(Request $request){

            // Check if the session variable 'user_mocks_id' already exists
        if (Session::has('user_mocks_id')) {
            // If it exists, update it with the new 'testId'
            Session::put('user_mocks_id', $request->input('testId'));
        } else {
            // If it doesn't exist, create it with the new 'testId'
            Session::put('user_mocks_id', $request->input('testId'));
        }

        // Return a response to AJAX with a success message or any other data
        return response()->json(['message' => 'Session variable updated successfully']);



    }

}
