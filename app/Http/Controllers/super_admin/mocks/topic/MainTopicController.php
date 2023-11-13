<?php

namespace App\Http\Controllers\super_admin\mocks\topic;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\speciality\Speciality;
use App\Models\super_admin\mocks\speciality_subject\SpecialitySubject;
use App\Models\super_admin\mocks\subject\Subject;
use App\Models\super_admin\mocks\subject_speciality_topic\SubjectSpecialityTopic;
use App\Models\super_admin\mocks\topic\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainTopicController extends Controller
{
    //function for main view

    public function mainView(){

        return view('super_admin.mocks_test.topic.main_topic');
    }

    //function for add view

    public function addView(){

        return view('super_admin.mocks_test.topic.add_topic');
    }


   // load subject to the form select
    public function fetchSubjects(): JsonResponse
    {
        // Fetch subjects from the database
        $subjects = Subject::all();

        // Generate options for the subject dropdown
        $subjectOptions = '<option value="" disabled selected>Choose Subject</option>';
        foreach ($subjects as $subject) {
            $subjectOptions .= '<option value="' . $subject->subject_id . '">' . $subject->subject_name . '</option>';
        }

        return response()->json(['subjectOptions' => $subjectOptions]);
    }

    // load the speciality to the select related to the subject
    public function fetchSpecialities($subjectId)
    {
        // Fetch the subject along with its related specialities
        $subject = Subject::with('specialties')->find($subjectId);

        // Check if the subject was found
        if (!$subject) {
            return response()->json(['specialityOptions' => '<option value="" disabled selected>No Specialities found for this subject</option>']);
        }

        // Get the specialities related to the subject
        $specialities = $subject->specialties;

        // Generate options for the speciality dropdown
        $specialityOptions = '<option value="" disabled selected>Choose Speciality</option>';
        foreach ($specialities as $speciality) {
            $specialityOptions .= '<option value="' . $speciality->speciality_id . '">' . $speciality->speciality_name . '</option>';
        }

        return response()->json(['specialityOptions' => $specialityOptions]);
    }


        public function addTopic(Request $request)
    {
        // Validate the request data as needed
        $request->validate([
            'subject_id' => 'required',
            'speciality_id' => 'required',
            'topic_name' => 'required',
        ]);


         // Check if the topic already exists
         $topic = Topic::where('topic_name', $request->input('topic_name'))->first();

         if (!$topic) {
             // topic doesn't exist, create a new one
             $topic = Topic::create([
                 'topic_name' => $request->input('topic_name'),
             ]);
         }



            // Check if the association already exists
        $existingAssociation = SubjectSpecialityTopic::where('subject_id', $request->input('subject_id'))
        ->where('speciality_id', $request->input('speciality_id'))
        ->where('topic_id', $topic->topic_id)
        ->first();

        if (!$existingAssociation) {
            // Association doesn't exist, create a new one
            SubjectSpecialityTopic::create([
                'subject_id' => $request->input('subject_id'),
                'speciality_id' => $request->input('speciality_id'),
                'topic_id' => $topic->topic_id,
            ]);

            return response()->json(['message' => 'Specialty added successfully.','status'=>'1']);
        } else {
            return response()->json(['message' => 'Association already exists.','status'=>'0']);
        }


    }


    //load topic to the datatable
        public function getTopicData()
    {
        $topics = Topic::with('subjects', 'specialities')->get();
        return response()->json(['data' => $topics]);
    }



    // delete the Topic from database

    public function deleteTopic($id)
    {
        $topic = Topic::findOrFail($id);

        // Detach all subjects and specialities related to this topic
        $topic->subjects()->detach();
        $topic->specialities()->detach();

        // Delete the topic
        $topic->delete();

        return response()->json(['message' => 'Topic and related relationships deleted successfully']);
    }


          // load the specialities related to the subject
          public function loadSpecialities(Request $request)
          {
              // Get the input array directly from the request
              $selectedSubjects = $request->input('selectedSubjects', []);

              // If there are no selected subjects, return a response
              if (empty($selectedSubjects)) {
                  return response()->json(['specialityOptions' => '<option value="" disabled selected>No Subjects selected</option']);
              }

              // Use Eloquent to fetch specialities related to the selected subjects
              $specialities = Speciality::whereHas('subjects', function ($query) use ($selectedSubjects) {
                  $query->whereIn('subject.subject_id', $selectedSubjects);
              })->get();

              // Generate options for the speciality dropdown
              $specialityOptions = '<option value="" disabled selected>Choose Speciality</option>';
              foreach ($specialities as $speciality) {
                  $specialityOptions .= '<option value="' . $speciality->speciality_id . '">' . $speciality->speciality_name . '</option>';
              }

              return response()->json(['specialityOptions' => $specialityOptions]);
          }





    // update the topic and syn the association


    public function updateTopic(Request $request, $topicId)
    {
        $topic = Topic::find($topicId);

        if (!$topic) {
            return response()->json(['message' => 'Topic not found'], 404);
        }

        $topicName = $request->input('topicName');

        // Update the topic name
        $topic->update([
            'topic_name' => $topicName,
        ]);

        $selectedData = $request->input('selectedData', []);

        // Detach existing relationships
        $topic->subjects()->detach();
        $topic->specialities()->detach();

        // Iterate through the selected data and establish relationships
        foreach ($selectedData as $selection) {
            $subjectId = $selection['subject_id'];
            $specialityId = $selection['speciality_id'];

            // Attach the subject and speciality to the topic, explicitly providing speciality_id
            $topic->subjects()->attach($subjectId, ['speciality_id' => $specialityId]);
            $topic->specialities()->attach($specialityId, ['subject_id' => $subjectId]);
        }

        return response()->json(['message' => 'Topic updated successfully'], 200);
    }





















}
