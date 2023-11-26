<?php

namespace App\Http\Controllers\super_admin\user_management\mocks_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\super_admin\user_management\Users;
use Carbon\Carbon;
use App\Models\super_admin\mocks\test\Test;
use App\Models\super_admin\user_management\mocks_management\MocksManagement;
class MainMocksManagementController extends Controller
{
    //

    public function mocksUserView(){

        return view('super_admin.user_management.mocks_management.main_mocks_management');
    }



    public function getMocksUserData()
    {
            // Fetch users with the 'user' role and select all columns
            $userData = Users::where('role', 'user')
            ->with(['subscriptions' => function ($query) {
                $now = Carbon::now();
                $query->where('subscription_name', 'MOCKS')
                    ->where('expiry_timestamp', '>', $now);
            }])
            ->get();

                // Filter users who have 'MOCKS' subscription and it's not expired
            $filteredUserData = $userData->filter(function ($user) {
                // Check if the user has 'MOCKS' subscription and no other subscriptions
                return $user->subscriptions->count() === 1 && $user->subscriptions->first()->subscription_name === 'MOCKS';
            });



        // If you want to remove subscriptions from the result and keep only users, you can use map
        $filteredUserData = $filteredUserData->map(function ($user) {
            return [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'country' => $user->country,

            ];
        });

        // Return the filtered user data as JSON
        return response()->json(['data' => $filteredUserData->values()->toArray()]);
    }


    public function loadAddMocksUserView($user_id){

     // Get all tests
     $tests = Test::all();

     // Get the user
     $user = Users::findOrFail($user_id);

     // Load the mocksManagementUsers relationship
     $user->load('mocks_test_management');

     // Attach an additional property to each test indicating whether it is linked to the user
     $tests = $tests->map(function ($test) use ($user) {
         $test->linked_to_user = $user->mocks_test_management && $user->mocks_test_management->contains('test_id', $test->test_id);
         return $test;
     });

     return view('super_admin.user_management.mocks_management.add_mocks_to_user_view', [
         'user_id' => $user_id,
         'tests' => $tests,
     ]);


    }

        public function saveMocksToUser(Request $request)
    {
        $user_id = $request->input('user_id');
        $linked_tests = $request->input('linked_tests', []);

        // Delete existing records for the user before updating
        MocksManagement::where('user_id', $user_id)->delete();

        // Update or create records based on the selected tests
        foreach ($linked_tests as $test_id) {
            MocksManagement::updateOrCreate(
                ['user_id' => $user_id, 'test_id' => $test_id],
                ['user_id' => $user_id, 'test_id' => $test_id]
            );
        }

        // Redirect or perform additional actions as needed
        return redirect()->back()->with('success', 'Mocks updated successfully.');
    }


}
