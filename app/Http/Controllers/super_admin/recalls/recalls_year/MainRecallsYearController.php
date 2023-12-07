<?php

namespace App\Http\Controllers\super_admin\recalls\recalls_year;

use App\Http\Controllers\Controller;
use App\Models\super_admin\recalls\recalls_Year\RecallsYear;
use Illuminate\Http\Request;

class MainRecallsYearController extends Controller
{
    //

    public function recallsYearView(){

        return view('super_admin.amc_recalls.recalls_year.main_recalls_year');
    }

    public function recallsYearAddView(){

        return view('super_admin.amc_recalls.recalls_year.add_recalls_year');
    }

    public function addRecallsYear(Request $request)
    {
        // Validate the request
        $request->validate([
            'recalls_year_name' => 'required|integer|unique:recalls_years,year', // Add any other validation rules as needed
        ]);

        // Create a new RecallsYear instance
        $recallsYear = RecallsYear::create([
            'year' => $request->input('recalls_year_name'),
        ]);

        // Return a JSON response
        return response()->json(['message' => 'Year added successfully', 'data' => $recallsYear]);
    }


    public function getRecallsYearData(Request $request)
    {
        // Fetch data from the database
        $data = RecallsYear::select('recalls_year_id', 'year')->get();

        // Return the data in the format expected by DataTables
        return response()->json(['data' => $data]);
    }


    public function deleteRecallsYear($recall_year_id)
    {
        // Find the record
        $recallsYear = RecallsYear::find($recall_year_id);

        if (!$recallsYear) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Delete the record
        $recallsYear->delete();

        return response()->json(['message' => 'Record deleted successfully']);
    }


    public function loadRecallsYearToEdit($recall_year_id)
    {
        $recallsYear = RecallsYear::find($recall_year_id);

        if (!$recallsYear) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        return response()->json(['recallsYear' => $recallsYear]);
    }

    public function updateRecallsYear(Request $request, $recall_year_id)
    {
        // Validate the request data
        $request->validate([
            'recalls_year' => 'required|integer', // Add any other validation rules as needed
        ]);

        // Find the RecallsYear record
        $recallsYear = RecallsYear::find($recall_year_id);

        if (!$recallsYear) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Update the record
        $recallsYear->update([
            'year' => $request->input('recalls_year'),
        ]);

        return response()->json(['message' => 'Recalls Year updated successfully']);
    }

}
