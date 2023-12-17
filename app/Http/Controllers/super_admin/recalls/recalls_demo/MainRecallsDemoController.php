<?php

namespace App\Http\Controllers\super_admin\recalls\recalls_demo;

use App\Http\Controllers\Controller;
use App\Models\super_admin\recalls\recalls_demo\RecallsDemoQuestion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainRecallsDemoController extends Controller
{
    public function recallsDemoQuestionView(){

        return view('super_admin.amc_recalls.recalls_demo.main_recalls_demo_question');
    }

    public function recallsDemoQuestionAddView(){

        return view('super_admin.amc_recalls.recalls_demo.add_recalls_demo_question');
    }


    public function loadRecallsQuestionsToTable()
    {
        $data = RecallsDemoQuestion::all(); // Adjust this query based on your needs

         // Return the data in the format expected by DataTables
         return response()->json(['data' => $data]);
    }

    public function loadRecallsQuestionsToEdit($question_id){

        try {
            $data = RecallsDemoQuestion::findOrFail($question_id);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Question not found'], 404);
        }

    }

    public function updateRecallsQuestion(Request $request){

        try {
            // Validate the form data
            $validator = Validator::make($request->all(), [
                'question_track_id' => 'required|numeric',
                'recalls_year_id' => 'required|exists:recalls_years,recalls_year_id',
                'recalls_month_id' => 'required|exists:recalls_months,recalls_month_id',
                'recalls_system_id' => 'required|exists:recalls_systems,recalls_system_id',
                'question_text' => 'required|string',

                'correct_option' => 'required|integer|between:1,5',
                'question_explanation' => 'required|string',
            ]);

            // If validation fails, return the errors
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Assuming you have a 'recalls_question_id' field in your form
            $questionId = $request->input('recalls_question_id');

            $question = RecallsDemoQuestion::findOrFail($questionId);

            // Update the question fields based on your form fields
            $question->fill($request->all());
            $question->save();

            return response()->json(['message' => 'Question updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating question'], 500);
        }


    }


    public function deleteRecallsQuestion($question_id)
    {
        try {
            // Find the question by ID
            $question = RecallsDemoQuestion::findOrFail($question_id);

            // Delete the question
            $question->delete();

            return response()->json(['success' => true, 'message' => 'Question deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error deleting question'], 500);
        }
    }



   public function createRecallsQuestion(Request $request)
   {
        try {
            // Validation rules
            $rules = [
                'question_track_id'=>'required|numeric',
                'recalls_year_id' => 'required|exists:recalls_years,recalls_year_id',
                'recalls_month_id' => 'required|exists:recalls_months,recalls_month_id',
                'recalls_system_id' => 'required|exists:recalls_systems,recalls_system_id',
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
            RecallsDemoQuestion::create($request->all());

            return response()->json(['message' => 'Question added successfully'], 200);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'An error occurred while processing the request'], 500);
        }
    }


    public function recallsDemoQuestionPreview($question_id){

        // Fetch the question based on the provided $question_id
        $question = RecallsDemoQuestion ::find($question_id);
        // Pass the question data to the view
        return view('super_admin.amc_recalls.recalls_preview.qbank_lunch_preview', ['question' => $question]);

    }

}
