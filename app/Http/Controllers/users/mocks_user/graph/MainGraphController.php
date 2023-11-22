<?php

namespace App\Http\Controllers\users\mocks_user\graph;

use App\Http\Controllers\Controller;
use App\Models\users\mocks_user\mocks_user_test_history\MocksUserTestHistory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class MainGraphController extends Controller
{
    //lunch graph view

        public function graphView()
    {
        $user_id = Session::get('user')->id;

        // Fetch user test histories with related data
        $userTestHistories = MocksUserTestHistory::with(['test', 'questions'])
            ->where('user_id', $user_id)
            ->get();

        // Transform data into the required structure
        $chartData = [];
        foreach ($userTestHistories as $history) {
            // Use a combination of test name and user ID as the series name
            $seriesName = $history->test->test_name;

            $chartData[$seriesName][] = [
                'date' => $history->created_at->format('m-d-Y'), // Adjust the date format as needed
                'score' => $history->score,
            ];
        }

        // Pass the chart data to the view
        return view("users.mocks_user.graph.graph", ['chartData' => $chartData]);
    }


}
