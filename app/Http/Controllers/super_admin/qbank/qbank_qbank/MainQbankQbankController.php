<?php

namespace App\Http\Controllers\super_admin\qbank\qbank_qbank;

use App\Http\Controllers\Controller;
use App\Models\super_admin\qbank\qbank_qbank\QbankQbank;
use Illuminate\Http\Request;

class MainQbankQbankController extends Controller
{
    public function qbankQbankView(){

        return view('super_admin.amc_qbank.qbank_qbank.main_qbank_qbank');
    }


    public function addQbank(Request $request)
    {
        // Validate the request
        $request->validate([
            'qbank_name' => 'required|string|unique:qbank_qbanks,qbank_name', // Add any other validation rules as needed
        ]);

        // Create a new qbank instance
        $qbank = QbankQbank::create([
            'qbank_name' => $request->input('qbank_name'),
        ]);

        // Return a JSON response
        return response()->json(['message' => 'qbank added successfully']);
    }

    public function qbankQbankAddView(){

        return view('super_admin.amc_qbank.qbank_qbank.add_qbank_qbank');
    }



    public function getQbankData(Request $request)
    {
        // Fetch data from the database
        $data = QbankQbank::select('qbank_id', 'qbank_name')->get();

        // Return the data in the format expected by DataTables
        return response()->json(['data' => $data]);
    }


    public function deleteQbank($qbank_id)
    {
        // Find the record
        $qbank = QbankQbank::find($qbank_id);

        if (!$qbank) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Delete the record
        $qbank->delete();

        return response()->json(['message' => 'Record deleted successfully']);
    }


    public function loadQbankToEdit($qbank_id)
    {
        $qbank = QbankQbank::find($qbank_id);

        if (!$qbank) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        return response()->json(['qbank' => $qbank]);
    }

    public function updateQbank(Request $request, $qbank_id)
    {
        // Validate the request data
        $request->validate([
            'qbank_name' => 'required|string', // Add any other validation rules as needed
        ]);

        // Find the RecallsYear record
        $qbank = QbankQbank::find($qbank_id);

        if (!$qbank) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Update the record
        $qbank->update([
            'qbank_name' => $request->input('qbank_name'),
        ]);

        return response()->json(['message' => 'Recalls Year updated successfully']);
    }
}
