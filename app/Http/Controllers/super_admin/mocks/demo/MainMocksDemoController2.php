<?php

namespace App\Http\Controllers\super_admin\mocks\demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\super_admin\mocks\demo\MocksDemoQuestion;
class MainMocksDemoController2 extends Controller
{
    public function showAddMocksDemoQuestionView(){

     return view('super_admin.mocks_test.demo.demo_question.add_question');


    }

    public function addMocksDemoQuestion(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'question_text' => 'required|string',
            'option1' => 'required|string',
            'option2' => 'required|string',
            'option3' => 'required|string',
            'option4' => 'required|string',
            'option5' => 'required|string',
            'correct_option' => 'required|in:1,2,3,4,5',
            'question_explanation' => 'required|string',
        ]);

        try {
            // Create a new instance of the MocksDemoQuestion model with the validated data
            $question = MocksDemoQuestion::create($validatedData);

            // You can do additional actions here if needed

            return response()->json(['message' => 'Question added successfully'], 200);
        } catch (\Exception $e) {

            dump($e->getMessage());
            \Log::error('Failed to add question: ' . $e->getMessage());
            // Log the error or handle it as needed
            return response()->json(['error' => 'Failed to add question'], 500);
        }
    }


    public function showDemoQuestionView(){

        return view('super_admin.mocks_test.demo.demo_question.main_question');


    }

    public function showDemoQuestionInTable(){


        // Fetch all questions
        $questions = MocksDemoQuestion::select([
            'question_id',

            'question_text',
        ])->get();

        // Map the data
        $data = $questions->map(function ($question) {
            return [
                'question_id' => $question->question_id,
                'question_text'=>$question->question_text,
            ];
        });

        // Return the data as a JSON response
        return response()->json(['data' => $data]);
    }


    public function deleteMocksDemoQuestion($question_id)
    {
        try {
            // Find the question by its ID
            $question = MocksDemoQuestion::find($question_id);

            if (!$question) {
                return response()->json(['success' => false, 'message' => 'Question not found'], 404);
            }

            // Delete the question
            $question->delete();

            return response()->json(['success' => true, 'message' => 'Question deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete question'], 500);
        }
    }


     // load the question data to edit
     public function editQuestionLoader($questionId)
     {
         // Retrieve the question by its ID
         $question = MocksDemoQuestion::find($questionId);

         if ($question) {
             // Prepare the data to send as JSON response
             $data = [

                 'question_id' => $question->question_id,
                 'question_text' => $question->question_text,
                 'option1' => $question->option1,
                 'option2' => $question->option2,
                 'option3' => $question->option3,
                 'option4' => $question->option4,
                 'option5' => $question->option5,
                 'correct_option' => $question->correct_option,

                 'question_explanation' => $question->question_explanation,
             ];

             // Return the data as a JSON response
             return response()->json($data);
         } else {
             // Return a response indicating that the question was not found
             return response()->json(['error' => 'Question not found'], 404);
         }
     }


     public function updateMocksDemoQuestion(Request $request)
    {
        // Find the question by its ID
        $question = MocksDemoQuestion::find($request->input('question_id'));


        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        // Update the question with the data from the request
        $question->update($request->all());

        return response()->json(['message' => 'Question updated successfully']);
    }

    public function showMocksDemoQuestionPreview($question_id){

        $question = MocksDemoQuestion::find($question_id);

        return view('super_admin.mocks_test.question_preview.question_preview', ['question' => $question]);
    }








}
