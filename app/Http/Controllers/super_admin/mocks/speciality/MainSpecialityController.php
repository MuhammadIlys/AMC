<?php

namespace App\Http\Controllers\super_admin\mocks\speciality;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\speciality\Speciality;
use App\Models\super_admin\mocks\speciality_subject\SpecialitySubject;
use App\Models\super_admin\mocks\subject\Subject;
use Illuminate\Http\Request;

class MainSpecialityController extends Controller
{
    //function for main view

    public function mainView(){

        return view('super_admin.mocks_test.speciality.main_speciality');
    }

    //function for add view

    public function addView(){
        $subjects = Subject::all();
        return view('super_admin.mocks_test.speciality.add_speciality')->with('subjects', $subjects);;
    }


      // add speciality to the database
    public function addSpeciality(Request $request)
    {
        // Validate the request
        $request->validate([
            'subject_id' => 'required|exists:subject,subject_id',
            'specialty_name' => 'required|string|max:255',
        ]);

        // Check if the specialty already exists
        $speciality = Speciality::where('speciality_name', $request->input('specialty_name'))->first();

        if (!$speciality) {
            // Specialty doesn't exist, create a new one
            $speciality = Speciality::create([
                'speciality_name' => $request->input('specialty_name'),
            ]);
        }

        // Check if the association already exists
        $existingAssociation = SpecialitySubject::where('subject_id', $request->input('subject_id'))
            ->where('speciality_id', $speciality->speciality_id)
            ->first();

        if (!$existingAssociation) {
            // Association doesn't exist, create a new one
            SpecialitySubject::create([
                'subject_id' => $request->input('subject_id'),
                'speciality_id' => $speciality->speciality_id,
            ]);

            return response()->json(['message' => 'Specialty added successfully.','status'=>'1']);
        } else {
            return response()->json(['message' => 'Association already exists.','status'=>'0']);
        }
    }


    // load speciality data into datatable

    public function getSpecialityData()
    {
        $specialities = Speciality::with('subjects')->get();
        return response()->json(['data' => $specialities]);
    }


    // delete the speciality from database

    public function deleteSpeciality($id)
    {
        $speciality = Speciality::findOrFail($id);
        $speciality->delete();

        return response()->json(['message' => 'Speciality deleted successfully']);
    }


    // updating the the speciality
    public function loadDataToModel($specialityId)
    {
        $allSubjects = Subject::all();
        $speciality = Speciality::findOrFail($specialityId);
        $selectedSubjects = $speciality->subjects->pluck('subject_id')->toArray();

        return response()->json([
            'allSubjects' => $allSubjects,
            'selectedSubjects' => $selectedSubjects
        ]);
    }


        public function updateSpeciality($id)
    {
        $speciality = Speciality::findOrFail($id);

        // Update speciality name
        $speciality->speciality_name = request()->input('speciality_name', $speciality->speciality_name);
        $speciality->save();

        // Update the subjects associated with the speciality
        $subjectIds = request()->input('subject_ids', []);
        $speciality->subjects()->sync($subjectIds);

        return response()->json(['message' => 'Speciality updated successfully']);
    }












}
