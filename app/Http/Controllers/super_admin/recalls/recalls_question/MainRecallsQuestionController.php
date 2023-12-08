<?php

namespace App\Http\Controllers\super_admin\recalls\recalls_question;

use App\Http\Controllers\Controller;
use App\Models\super_admin\recalls\recalls_month\RecallsMonth;
use App\Models\super_admin\recalls\recalls_question\RecallsQuestion;
use App\Models\super_admin\recalls\recalls_system\RecallsSystem;
use App\Models\super_admin\recalls\recalls_Year\RecallsYear;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainRecallsQuestionController extends Controller
{
    public function recallsQuestionView(){

        return view('super_admin.amc_recalls.recalls_question.main_recalls_question');
    }

    public function loadRecallsQuestionsToTable()
    {
        $data = RecallsQuestion::all(); // Adjust this query based on your needs

         // Return the data in the format expected by DataTables
         return response()->json(['data' => $data]);
    }

    public function loadRecallsQuestionsToEdit($question_id){

        try {
            $data = RecallsQuestion::findOrFail($question_id);

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
                'option1' => 'required|string',
                'option2' => 'required|string',
                'option3' => 'required|string',
                'option4' => 'required|string',
                'option5' => 'required|string',
                'correct_option' => 'required|integer|between:1,5',
                'question_explanation' => 'required|string',
            ]);

            // If validation fails, return the errors
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Assuming you have a 'recalls_question_id' field in your form
            $questionId = $request->input('recalls_question_id');

            $question = RecallsQuestion::findOrFail($questionId);

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
            $question = RecallsQuestion::findOrFail($question_id);

            // Delete the question
            $question->delete();

            return response()->json(['success' => true, 'message' => 'Question deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error deleting question'], 500);
        }
    }

    public function recallsQuestionAddView(){

        return view('super_admin.amc_recalls.recalls_question.add_recalls_question');
    }

     // load recalls years to the form select
     public function fetchRecallsYears(): JsonResponse
     {
         // Fetch recalls years from the database
         $recallsYears = RecallsYear::all();

         // Generate options for the recalls year dropdown
         $recallsYearOptions = '<option value="" disabled selected>Choose Recalls Year</option>';
         foreach ($recallsYears as $recallsyear) {
             $recallsYearOptions .= '<option value="' . $recallsyear->recalls_year_id . '">' . $recallsyear->year . '</option>';
         }

         return response()->json(['recallsYearOptions' => $recallsYearOptions]);
     }



       // load recalls month to the form select
       public function fetchRecallsMonths(): JsonResponse
       {
           // Fetch recalls month from the database
           $recallsMonths = RecallsMonth::all();

           // Generate options for the recalls system dropdown
           $recallsMonthOptions = '<option value="" disabled selected>Choose Recalls Month</option>';
           foreach ($recallsMonths as $recallsMonth) {
               $recallsMonthOptions .= '<option value="' . $recallsMonth->recalls_month_id . '">' . $recallsMonth->month_name . '</option>';
           }

           return response()->json(['recallsMonthOptions' => $recallsMonthOptions]);
        }



     // load recalls system to the form select
     public function fetchRecallsSystems(): JsonResponse
     {
         // Fetch recalls years from the database
         $recallsSystems = RecallsSystem::all();

         // Generate options for the recalls system dropdown
         $recallsSystemOptions = '<option value="" disabled selected>Choose Recalls System</option>';
         foreach ($recallsSystems as $recallsSystem) {
             $recallsSystemOptions .= '<option value="' . $recallsSystem->recalls_system_id . '">' . $recallsSystem->system_name . '</option>';
         }

         return response()->json(['recallsSystemOptions' => $recallsSystemOptions]);
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
                'option1' => 'required|string',
                'option2' => 'required|string',
                'option3' => 'required|string',
                'option4' => 'required|string',
                'option5' => 'required|string',
                'correct_option' => 'required|integer|between:1,5',
                'question_explanation' => 'required|string',
            ];

            // Validate the form data
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Process the form data and save the question
            RecallsQuestion::create($request->all());

            return response()->json(['message' => 'Question added successfully'], 200);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'An error occurred while processing the request'], 500);
        }
    }

}
