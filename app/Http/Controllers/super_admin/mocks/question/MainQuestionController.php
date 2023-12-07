<?php

namespace App\Http\Controllers\super_admin\mocks\question;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\question\Question;
use App\Models\super_admin\mocks\topic\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainQuestionController extends Controller
{
    //function for main view

    public function mainView(){

        return view('super_admin.mocks_test.question.main_question');
    }

    //function for add view

    public function addView(){

        return view('super_admin.mocks_test.question.add_question');
    }


     // load topic which is related to the subject and speciality
     public function loadTopics($subjectId, $specialityId)
     {
         // Retrieve topics related to the given subject and speciality
         $topics = Topic::whereHas('subjects', function ($query) use ($subjectId) {
             $query->where('subject.subject_id', $subjectId);
         })->whereHas('specialities', function ($query) use ($specialityId) {
             $query->where('speciality.speciality_id', $specialityId);
         })->get();

         // Create an HTML options string for the select element
         $topicOptions = '';
         $topicOptions .='<option selected disabled>Choose  Topic</option>';
         foreach ($topics as $topic) {
             $topicOptions .= "<option value='{$topic->topic_id}'>{$topic->topic_name}</option>";
         }

         // Return the options as a JSON response
         return response()->json(['topicOptions' => $topicOptions]);
     }



        public function questionStore(Request $request)
    {
        // Validate the form data
        $request->validate([
            'question_track_id' => 'required|numeric', // Requires a non-empty numeric value
            'question_text' => 'required|string', // Requires a non-empty string
            'option1' => 'required|string',
            'option2' => 'required|string',
            'option3' => 'required|string',
            'option4' => 'required|string',
            'option5' => 'required|string',
            'correct_option' => 'required|in:1,2,3,4,5', // Requires a value from 1 to 5
            'question_type' => 'required|in:1,2,3', // Requires a value from 1 to 3
            'question_explanation' => 'required|string',
        ]);

        // Create a new Question instance and fill it with form data
        $question = new Question();
        $question->question_track_id = $request->input('question_track_id');
        $question->subject_id = $request->input('subjects');
        $question->speciality_id = $request->input('specialities');
        $question->topic_id = $request->input('topic');
        $question->question_text = $request->input('question_text');
        $question->option1 = $request->input('option1');
        $question->option2 = $request->input('option2');
        $question->option3 = $request->input('option3');
        $question->option4 = $request->input('option4');
        $question->option5 = $request->input('option5');
        $question->correct_option = $request->input('correct_option');
        $question->question_type = $request->input('question_type');
        $question->question_explanation = $request->input('question_explanation');


        // Save the question to the database
        $question->save();

        // You can return a response here or redirect as needed
        return response()->json(['message' => 'Question saved successfully']);
    }

    // load data into the datable
    public function getQuestionData(Request $request)
    {
        // Eager load the 'subject', 'speciality', and 'topic' relationships
        $questions = Question::with(['subject', 'speciality', 'topic'])->get();

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


    //delete question from table

    public function deleteQuestion($question_id)
    {
        try {
            // Find the question by its ID
            $question = Question::find($question_id);

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
        $question = Question::find($questionId);

        if ($question) {
            // Prepare the data to send as JSON response
            $data = [
                'question_track_id' => $question->question_track_id,
                'question_id' => $question->question_id,
                'question_text' => $question->question_text,
                'option1' => $question->option1,
                'option2' => $question->option2,
                'option3' => $question->option3,
                'option4' => $question->option4,
                'option5' => $question->option5,
                'correct_option' => $question->correct_option,
                'question_type' => $question->question_type,
                'question_explanation' => $question->question_explanation,
            ];

            // Return the data as a JSON response
            return response()->json($data);
        } else {
            // Return a response indicating that the question was not found
            return response()->json(['error' => 'Question not found'], 404);
        }
    }


    //update the question

    public function updateQuestion(Request $request)
    {
        // Find the question by its ID
        $question = Question::find($request->input('question_id'));
        $question->subject_id=$request->input('subjects');
        $question->speciality_id=$request->input('specialities');
        $question->topic_id=$request->input('topic');

        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        // Update the question with the data from the request
        $question->update($request->all());

        return response()->json(['message' => 'Question updated successfully']);
    }













}
