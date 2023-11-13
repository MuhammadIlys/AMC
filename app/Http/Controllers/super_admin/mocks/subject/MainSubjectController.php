<?php

namespace App\Http\Controllers\super_admin\mocks\subject;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\subject\Subject;
use Illuminate\Http\Request;

class MainSubjectController extends Controller
{
    ///function for main view

    public function mainView(){

        return view('super_admin.mocks_test.subject.main_subject');
    }

    //function for add view

    public function addView(){

        return view('super_admin.mocks_test.subject.add_subject');
    }

     // add subject to the database table
     public function addSubject(Request $request)
     {
         $validatedData = $request->validate([
             'subject_id' => 'required|numeric',
             'subject_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
         ]);

         try {
             // Check if subject with the same name already exists
             $existingSubject = Subject::where('subject_name', $validatedData['subject_name'])->first();

             if ($existingSubject) {
                 return response()->json(['message' => 'Subject with the same name already exists'], 409);
             }

             // Create the subject
             $subject = Subject::create([
                 'subject_id' => $validatedData['subject_id'],
                 'subject_name' => $validatedData['subject_name'],
             ]);

             return response()->json(['message' => 'Subject created successfully', 'subject' => $subject], 201);

         } catch (\Exception $e) {
             return response()->json(['message' => 'An error occurred while creating the subject'], 500);
         }
     }



    // load data to the datatable for further action


            public function getSubjectsForDataTable()
        {
            try {
                // Fetch all subjects from the database
                $subjects = Subject::all();

                // Prepare the data in the format expected by DataTables
                $data = [];
                foreach ($subjects as $subject) {
                    $data[] = [
                        'subject_id' => $subject->subject_id,
                        'subject_name' => $subject->subject_name,

                    ];
                }

                return response()->json(['data' => $data]);
            } catch (\Exception $e) {
                // Log the error for debugging purposes (optional)
                \Log::error('Error fetching subjects: ' . $e->getMessage());

                // Return an error JSON response
                return response()->json(['error' => 'An error occurred while fetching subjects.'], 500);
            }
        }


        // delete the subject

        public function deleteSubject($subjectId)
        {
            // Perform the deletion
            try {
                $subject = Subject::findOrFail($subjectId);
                $subject->delete();

                return response()->json(['message' => 'Subject deleted successfully']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Unable to delete subject'], 500);
            }
        }

        public function editSubject($subjectId)
        {
            try {
                // Fetch the subject based on the subjectId
                $subject = Subject::findOrFail($subjectId);

                // Return the subject data as a JSON response
                return response()->json(['subject' => $subject]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Unable to fetch subject'], 500);
            }
        }

        public function updateSubject(Request $request, $subjectId)
        {
            try {
                // Find the subject
                $subject = Subject::findOrFail($subjectId);

                // Update subject data
                $subject->subject_name = $request->input('subject_name');
                $subject->save();

                return response()->json(['message' => 'Subject updated successfully']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Unable to update subject'], 500);
            }
        }


}
