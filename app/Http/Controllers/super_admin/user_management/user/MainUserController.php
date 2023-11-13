<?php

namespace App\Http\Controllers\super_admin\user_management\user;

use App\Http\Controllers\Controller;
use App\Models\super_admin\user_management\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainUserController extends Controller
{
    public function userView(){

        return view('super_admin.user_management.users.main_user');
    }

    // load user data to table
    public function getUserData(Request $request)
    {
        // Fetch users with the 'user' role and select all columns
        $userData = Users::where('role', 'user')->get();

        // Return the user data as JSON
        return response()->json(['data' => $userData]);
    }


    public function addUserView(){

        return view('super_admin.user_management.users.add_user');
    }


    //add user function
    public function addUser(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'country' => 'required|string',
        ]);

        // Check if the email already exists
        $existingUser = Users::where('email', $request->input('email'))->first();

        if ($existingUser) {
            return response()->json(['status' => '0', 'message' => 'Email already exists in the database']);
        }

        // Create and save the user with a hashed password
        $user = new Users();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // Hash the password
        $user->country = $request->input('country');
        $user->role = 'user';

        $user->save();

        return response()->json(['status' => '1', 'message' => 'User added successfully']);
    }


    public function deleteUser(Request $request, $userId)
    {
        // Find the user by ID
        $user = Users::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check if the user is a super admin (or any other conditions you need)
        if ($user->isSuperAdmin()) {
            return response()->json(['message' => 'Super admins cannot be deleted'], 400);
        }

        try {
            // Delete the user
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting the user'], 500);
        }
    }



        public function updateUser(Request $request)
    {
        $userId = $request->input('userId');
        $user = Users::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }


        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId, // Unique rule should exclude the current user
            'country' => 'required|string',
        ]);

        $user->update($validatedData);

        return response()->json(['message' => 'User updated successfully']);
    }



    public function addSubscriptionToUser(Request $request) {
        $id = $request->input('id');


         //  pass it to the view:
         return view('super_admin.user_management.subscription.add_subscription_to_user')->with('id', $id);
    }





}
