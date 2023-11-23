<?php

namespace App\Http\Controllers\users\mocks_user\account_reset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\super_admin\user_management\Users;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MainAccountResetController extends Controller
{
    //

    public function showAccountResetView()
    {
        $user = Session::get('user');
        $user_id = $user->id;

        // Fetch all user test histories
        $userTestHistories = Users::find($user_id)->mockUserTestHistories;

        // Check if the user has any test
        $hasTest = count($userTestHistories) > 0;

        return view('users.mocks_user.account_reset.account_reset', ['hasTest' => $hasTest]);
    }


    public function mocksUserAccountReset(){


        $user = Session::get('user');
        $user_id = $user->id;

        // Fetch all user test histories
        $userTestHistories = Users::find($user_id)->mockUserTestHistories;

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Delete all related user test histories and associated questions
            foreach ($userTestHistories as $history) {
                // Delete questions associated with this test history
                $history->questions()->detach();

                // Delete the test history
                $history->delete();
            }

            // Commit the transaction
            DB::commit();

            // Return a success response
            return response()->json(['status' => 'success', 'message' => 'Account reset successfully.']);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Return an error response
            return response()->json(['status' => 'error', 'message' => 'An error occurred while resetting the account.']);
        }


    }
}
