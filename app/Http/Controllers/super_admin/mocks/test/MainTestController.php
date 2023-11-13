<?php

namespace App\Http\Controllers\super_admin\mocks\test;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\question\Question;
use App\Models\super_admin\mocks\test\Test;
use Illuminate\Http\Request;

class MainTestController extends Controller
{
    //function for main view

    public function mainView(){

        return view('super_admin.mocks_test.test.main_test');
    }

    //function for add view

    public function addView(){

        return view('super_admin.mocks_test.test.add_test');
    }



     // load data into the datable
     public function getQuestionData(Request $request)
     {
         // Eager load the 'subject', 'speciality', and 'topic' relationships
         $questions = Question::with(['subject', 'speciality', 'topic'])
             ->where('test_id', null)
             ->get();

         // Transform the data to match DataTables column definitions
         $data = $questions->map(function ($question) {
             return [
                 'question_id' => $question->question_id,
                 'question_track_id' => $question->question_track_id,
                 'question_text' => $question->question_text,
                 'subject_name' => optional($question->subject)->subject_name,
                 'speciality_name' => optional($question->speciality)->speciality_name,
                 'topic_name' => optional($question->topic)->topic_name,
                 'option1' => $question->option1,
                 'option2' => $question->option2,
                 'option3' => $question->option3,
                 'option4' => $question->option4,
                 'option5' => $question->option5,
                 'correct_option' => $question->correct_option,
                 'question_type' => $question->question_type,
                 'question_explanation' => $question->question_explanation,
                 'subject_id' => optional($question->subject)->subject_id,
                 'speciality_id' => optional($question->speciality)->speciality_id,
                 'topic_id' => optional($question->topic)->topic_id,
             ];
         });

         // Return the data as a JSON response
         return response()->json(['data' => $data]);
     }




    public function createTest(Request $request)
    {
        $data = $request->all();

        // Create a new test record
        $test = Test::create([
            'test_name' => $data['test_name'],
            'total_mark' => $data['total_mark'],
            'passing_score' => $data['passing_score'],
            'allow_attempt' => $data['allow_attempt'],
            'test_status' => 'active', // You can set a default status
        ]);

        // Get the selected question IDs
        $questionIds = $data['questionIds'];

        // Update the 'test_id' in the Question model for the selected questions
        Question::whereIn('question_id', $questionIds)
            ->update(['test_id' => $test->test_id]);

        return response()->json(['message' => 'Test and questions created successfully']);
    }

    // load test data to datatable
        public function getTestData()
    {
        $data = Test::all(); // Assuming you want to retrieve all test records

        // You can customize the data if needed, e.g., transform it, format it, or filter it.

        return response()->json($data); // Return the data as JSON
    }

       // delete the test from database

       public function deleteTest($test_id)
       {

            try {
                // Find the test by its ID
                $test = Test::findOrFail($test_id);

                // Update the test_id to null in the related questions
                Question::where('test_id', $test_id)->update(['test_id' => null]);

                // Delete the test
                $test->delete();

                // Return a success response
                return response()->json(['success' => true]);
            } catch (\Exception $e) {


                // Return an error response
                return response()->json(['success' => false, 'message' => 'Failed to delete the test.']);
            }
       }


       public function editTest($test_id){



        return view('super_admin.mocks_test.test.test_edit')->with('test_id', $test_id);;
    }



// edit question
    public function editQuestion(Request $request )
    {

        $test_id=$request->input('test_id');
        // Eager load the test relationships
        $questions = Question::with(['test'])
        ->where(function ($query) use ($test_id) {
            $query->where('test_id', null)
                ->orWhere('test_id', '=', $test_id); // No quotes around $test_id
        })
        ->get();


        // Transform the data to match DataTables column definitions
        $data = $questions->map(function ($question) {
            return [
                'question_id' => $question->question_id,
                'question_track_id' => $question->question_track_id,
                'question_text' => $question->question_text,
                'test_id' => optional($question->test)->test_id,
                'test_name' => optional($question->test)->test_name,
                'total_mark' => optional($question->test)->total_mark,
                'passing_score' => optional($question->test)->passing_score,
                'allow_attempt' => optional($question->test)->allow_attempt,
                'test_status' => optional($question->test)->test_status,

            ];
        });

        // Return the data as a JSON response
        return response()->json(['data' => $data]);
    }


    // load test data to form

    public function loadTestData($test_id) {
        $testId = $test_id;
        $testData = Test::where('test_id', $testId)->first();

        if ($testData) {
            return response()->json([
                'success' => true,
                'message' => 'Test data retrieved successfully',
                'data' => $testData
            ]);
        } else {
            return response()->json(['success' => false, 'error' => 'Test data not found'], 404);
        }
    }


    public function updateTest(Request $request)
    {

        $test_id=$request->input('test_id');
        $test = Test::findOrFail($test_id);
        $test->test_name=$request->input('test_name');
        $test->total_mark=$request->input('total_mark');
        $test->passing_score=$request->input('passing_score');
        $test->allow_attempt=$request->input('allow_attempt');
        $test->test_status=$request->input('test_status');
        $test->update();

         // Get the selected question IDs
         $questionIds = $request->input('questionIds');


        // Set the 'test_id' to null for questions where 'test_id' matches the current test_id
        Question::where('test_id', $test->test_id)->update(['test_id' => null]);



        // Update the 'test_id' in the Question model for the selected questions
        Question::whereIn('question_id', $questionIds)
            ->update(['test_id' => $test->test_id]);

        return response()->json(['message' => 'Test and questions created successfully']);
    }






}
