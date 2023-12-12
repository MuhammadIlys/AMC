<?php

namespace App\Http\Controllers\super_admin\qbank\qbank_demo;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_demo\QbankDemoQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainQbankDemoController extends Controller
{


    public function qbankQuestionView(){

        return view('super_admin.amc_qbank.qbank_demo.main_qbank_demo_question');
    }


    public function loadQbankQuestionsToTable()
    {
        $data = QbankDemoQuestion::all(); // Adjust this query based on your needs

         // Return the data in the format expected by DataTables
         return response()->json(['data' => $data]);
    }

    public function loadQbankQuestionsToEdit($question_id){

        try {
            $data = QbankDemoQuestion::findOrFail($question_id);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Question not found'], 404);
        }

    }

    public function updateQbankQuestion(Request $request){

        try {
            // Validate the form data
            $validator = Validator::make($request->all(), [

                'question_track_id' => 'required|numeric',
                'qbank_id' => 'required|exists:qbank_qbanks,qbank_id',
                'qbank_system_id' => 'required|exists:qbank_systems,qbank_system_id',
                'question_text' => 'required|string',

                'correct_option' => 'required|integer|between:1,5',
                'question_explanation' => 'required|string',
            ]);

            // If validation fails, return the errors
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Assuming you have a 'recalls_question_id' field in your form
            $questionId = $request->input('qbank_question_id');

            $question = QbankDemoQuestion::findOrFail($questionId);

            // Update the question fields based on your form fields
            $question->fill($request->all());
            $question->save();

            return response()->json(['message' => 'Question updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating question'], 500);
        }


    }


    public function deleteQbankQuestion($question_id)
    {
        try {
            // Find the question by ID
            $question = QbankDemoQuestion::findOrFail($question_id);

            // Delete the question
            $question->delete();

            return response()->json(['success' => true, 'message' => 'Question deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error deleting question'], 500);
        }
    }







    public function qbankQuestionAddView(){

        return view('super_admin.amc_qbank.qbank_demo.add_qbank_demo_question');
    }



        public function createQbankQuestion(Request $request)
        {
            try {
                // Validation rules
                $rules = [
                    'question_track_id'=>'required|numeric',
                    'qbank_id' => 'required|exists:qbank_qbanks,qbank_id',
                    'qbank_system_id' => 'required|exists:qbank_systems,qbank_system_id',
                    'question_text' => 'required|string',

                    'correct_option' => 'required|integer|between:1,5',
                    'question_explanation' => 'required|string',
                ];

                // Validate the form data
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                // Process the form data and save the question
                QbankDemoQuestion::create($request->all());

                return response()->json(['message' => 'Question added successfully'], 200);
            } catch (\Exception $e) {
                // Handle unexpected errors
                return response()->json(['error' => 'An error occurred while processing the request'], 500);
            }
        }
}
