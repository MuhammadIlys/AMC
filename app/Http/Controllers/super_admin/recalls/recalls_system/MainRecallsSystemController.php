<?php

namespace App\Http\Controllers\super_admin\recalls\recalls_system;

use App\Http\Controllers\Controller;
use App\Models\super_admin\recalls\recalls_system\RecallsSystem;
use Illuminate\Http\Request;

class MainRecallsSystemController extends Controller
{

    public function recallsSystemView(){

        return view('super_admin.amc_recalls.recalls_system.main_recalls_system');
    }





    public function getRecallsSystemData(Request $request)
    {
        // Fetch data from the database
        $data = RecallsSystem::select('recalls_system_id', 'system_name')->get();

        // Return the data in the format expected by DataTables
        return response()->json(['data' => $data]);
    }


    public function deleteRecallsSystem($recall_system_id)
    {
        // Find the record
        $recallsSystem = RecallsSystem::find($recall_system_id);

        if (!$recallsSystem) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Delete the record
        $recallsSystem->delete();

        return response()->json(['message' => 'Record deleted successfully']);
    }


    public function loadRecallsSystemToEdit($recall_system_id)
    {
        $recallsSystem = RecallsSystem::find($recall_system_id);

        if (!$recallsSystem) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        return response()->json(['recallsSystem' =>  $recallsSystem]);
    }

    public function updateRecallsSystem(Request $request, $recall_system_id)
    {
        // Validate the request data
        $request->validate([
            'recalls_system' => 'required|string',
        ]);

        // Find the RecallsYear record
        $recallsSystem = RecallsSystem::find($recall_system_id);

        if (!$recallsSystem ) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Update the record
        $recallsSystem ->update([
            'system_name' => $request->input('recalls_system'),
        ]);

        return response()->json(['message' => 'Recalls system updated successfully']);
    }

    public function recallsSystemAddView(){

        return view('super_admin.amc_recalls.recalls_system.add_recalls_system');
    }

    public function saveRecallsSystem(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'recalls_system_name' => 'required|string|max:800|unique:recalls_systems,system_name',

        ]);

        // Create and save the RecallsSystem instance
        $recallsSystem = RecallsSystem::create([

            'system_name'=>$request->input('recalls_system_name')
        ]);

        return response()->json(['message' => 'Recalls System added successfully']);
    }


}
