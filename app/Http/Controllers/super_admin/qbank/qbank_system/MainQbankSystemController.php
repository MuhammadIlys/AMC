<?php

namespace App\Http\Controllers\super_admin\qbank\qbank_system;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_system\QbankSystem;
use Illuminate\Http\Request;

class MainQbankSystemController extends Controller
{
    public function qbankSystemView(){

        return view('super_admin.amc_qbank.qbank_system.main_qbank_system');
    }




    public function getQbankSystemData(Request $request)
    {
        // Fetch data from the database
        $data = QbankSystem::select('qbank_system_id', 'system_name')->get();

        // Return the data in the format expected by DataTables
        return response()->json(['data' => $data]);
    }


    public function deleteQbankSystem($qbank_system_id)
    {
        // Find the record
        $qbankSystem = QbankSystem::find($qbank_system_id);

        if (!$qbankSystem) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Delete the record
        $qbankSystem->delete();

        return response()->json(['message' => 'Record deleted successfully']);
    }


    public function loadQbankSystemToEdit($qbank_system_id)
    {
        $qbankSystem = QbankSystem::find($qbank_system_id);

        if (!$qbankSystem) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        return response()->json(['qbankSystem' =>  $qbankSystem]);
    }

    public function updateQbankSystem(Request $request, $qbank_system_id)
    {
        // Validate the request data
        $request->validate([
            'qbank_system' => 'required|string',
        ]);

        // Find the RecallsYear record
        $qbankSystem = QbankSystem::find($qbank_system_id);

        if (!$qbankSystem ) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Update the record
        $qbankSystem ->update([
            'system_name' => $request->input('qbank_system'),
        ]);

        return response()->json(['message' => 'Recalls system updated successfully']);
    }

    public function qbankSystemAddView(){

        return view('super_admin.amc_qbank.qbank_system.add_qbank_system');
    }


    public function saveQbankSystem(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'qbank_system_name' => 'required|string|max:800|unique:qbank_systems,system_name',

        ]);

        // Create and save the RecallsSystem instance
        $recallsSystem = QbankSystem::create([

            'system_name'=>$request->input('qbank_system_name')
        ]);

        return response()->json(['message' => 'Recalls System added successfully']);
    }
}
