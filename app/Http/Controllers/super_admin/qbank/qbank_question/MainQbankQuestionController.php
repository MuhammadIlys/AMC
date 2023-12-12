<?php

namespace App\Http\Controllers\super_admin\qbank\qbank_question;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_qbank\QbankQbank;
use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
use App\Models\super_admin\qbank\qbank_system\QbankSystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainQbankQuestionController extends Controller
{

    public function qbankQuestionView(){

        return view('super_admin.amc_qbank.qbank_question.main_qbank_question');
    }


    public function loadQbankQuestionsToTable()
    {
        $data = QbankQuestion::all(); // Adjust this query based on your needs

         // Return the data in the format expected by DataTables
         return response()->json(['data' => $data]);
    }

    public function loadQbankQuestionsToEdit($question_id){

        try {
            $data = QbankQuestion::findOrFail($question_id);

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

            $question = QbankQuestion::findOrFail($questionId);

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
            $question = QbankQuestion::findOrFail($question_id);

            // Delete the question
            $question->delete();

            return response()->json(['success' => true, 'message' => 'Question deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error deleting question'], 500);
        }
    }







    public function qbankQuestionAddView(){

        return view('super_admin.amc_qbank.qbank_question.add_qbank_question');
    }


           // load recalls month to the form select
           public function fetchQbanks(): JsonResponse
           {
               // Fetch qbanks from the database
               $qbanks = QbankQbank::all();

               // Generate options for the qbanks dropdown
               $qbankOptions = '<option value="" disabled selected>Choose QBank</option>';
               foreach ($qbanks  as $qbank) {
                $qbankOptions .= '<option value="' . $qbank->qbank_id . '">' . $qbank->qbank_name . '</option>';
               }

               return response()->json(['qbankOptions' => $qbankOptions]);
            }



         // load qbank system to the form select
         public function fetchQbankSystems(): JsonResponse
         {
             // Fetch recalls years from the database
             $qbankSystems = QbankSystem::all();

             // Generate options for the qbank system dropdown
             $qbankSystemOptions = '<option value="" disabled selected>Choose QBank System</option>';
             foreach ($qbankSystems as $qbankSystem) {
                $qbankSystemOptions .= '<option value="' . $qbankSystem->qbank_system_id . '">' . $qbankSystem->system_name . '</option>';
             }

             return response()->json(['qbankSystemOptions' => $qbankSystemOptions]);
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
                QbankQuestion::create($request->all());

                return response()->json(['message' => 'Question added successfully'], 200);
            } catch (\Exception $e) {
                // Handle unexpected errors
                return response()->json(['error' => 'An error occurred while processing the request'], 500);
            }
        }
}
