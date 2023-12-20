<?php

namespace App\Http\Controllers\users\qbank_user\qbank_used;

use App\Http\Controllers\Controller;
use App\Models\users\qbank_user\qbank_used\QbankUsed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class QbankUsedController extends Controller
{
    public function loadUsedSystems(Request $request)
    {
       // Get the user ID from the session
       $userId = Session::get('user')->id;

       // Replace with the desired qbank_id or use a default value
       $qbankId =  Session::get('qbank_id');

    // Fetch records based on user ID and qbank ID
    $corrects = QbankUsed::where('id', $userId)
        ->where('qbank_id', $qbankId)
        ->with('qbankQuestion.qbankSystem') // Eager load the relationships
        ->get();

    // Create an associative array to store the total correct count, system ID, and system name for each system
    $totalCorrectCounts = [];

    // Now you can access the related data and count in each system
    foreach ($corrects as $correct) {
        // Access QbankQuestion model related to each QbankCorrects record
        $qbankQuestion = $correct->qbankQuestion;

        // Access QbankSystem model related to each QbankQuestion record
        $qbankSystem = $qbankQuestion->qbankSystem;

        // Get the qbank_system_id, system_name, and system_id for the current system
        $systemId = $qbankSystem->qbank_system_id;
        $systemName = $qbankSystem->system_name;

        // Increment the total correct count for the current system
        if (!isset($totalCorrectCounts[$systemId])) {
            $totalCorrectCounts[$systemId] = [
                'qbank_system_id' => $systemId,
                'system_name' => $systemName,
                'total_correct_count' => 0,
            ];
        }
        $totalCorrectCounts[$systemId]['total_correct_count']++;
    }

    // Prepare the data to be returned
    $result = [
        'systems' => array_values($totalCorrectCounts),
    ];

    return response()->json($result);


    }
}
