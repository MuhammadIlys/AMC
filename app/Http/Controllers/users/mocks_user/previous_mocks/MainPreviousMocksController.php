<?php

namespace App\Http\Controllers\users\mocks_user\previous_mocks;

use App\Http\Controllers\Controller;
use App\Models\super_admin\user_management\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainPreviousMocksController extends Controller
{
    // lunch the previous mocks view
    public function previousMocksView()
    {
        $user_id = session::get('user')->id;

        // Assuming you have a one-to-many relationship between Users and MocksUserTestHistory
        $userTestHistories = Users::find($user_id)->mockUserTestHistories;

        $dataSet = [];

        foreach ($userTestHistories as $history) {
            $percentage = round($history->perscent) . "%";
            $mockName = $history->test->test_name; // Assuming 'test_name' is the field in the Test model that contains the mock name
            $date = $history->created_at->format('Y/m/d'); // Assuming 'created_at' is the field in the MocksUserTestHistory model representing the date

            // Assuming other fields are accessible directly from the $history object
            $score = $history->score;
            $correct = $history->correct;
            $incorrect = $history->incorrect;
            $omitted = $history->omitted;
            $test_status=$history->test_status;

            $badgeClass2 = (round($history->perscent)>= 50) ? 'badge rounded-pill bg-success' : 'badge rounded-pill bg-danger';

            // Determine the Bootstrap badge class based on the question status
            $badgeClass = ($history->test_status === 'Pass') ? 'badge badge-label bg-success' : 'badge badge-label bg-danger';
            $urlMockResults = "mocks_user_mocks_result/".$history->user_mocks_id; // Replace with the actual URL for mock results
            $urlTestAnalytics = "mocks_user_mocks_result/".$history->user_mocks_id;; // Replace with the actual URL for test analytics

            // Build the row for DataTable
            $row = [
                "<span class='$badgeClass2'>$percentage</span>",
                $mockName,
                $date,
                $score,
                $correct,
                $incorrect,
                $omitted,
                "<span class='$badgeClass'>$test_status</span>",
                '<a title="Show Test Preview" href="' . $urlMockResults . '"><i class="la la-play-circle la-lg pointer fs-22 cursor-pointer" style="color: #2196F3"></i></a> <a title="Show Test Result" href="' . $urlMockResults . '"><i class="la la-tasks la-lg pointer fs-22 cursor-pointer ms-2" style="color: #2196F3"></i></a> <a title="Show Test Analytics" href="' . $urlTestAnalytics . '"><i class="bx bx-bar-chart pointer fs-22 cursor-pointer ms-2" style="color: #2196F3"></i></a>'
            ];

            // Add the row to the DataSet
            $dataSet[] = $row;
        }

        return view("users.mocks_user.previous_mocks.previousMocks", compact('dataSet'));
    }

}
