<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\super_admin\user_management\subscription\Subscription;
use App\Models\super_admin\user_management\Users;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    //
    public function superAdminView(){

        return view('super_admin.index');
    }

    public function userAdminView() {
        // Assuming $user_id is the user's ID, and you have User, Subscription, and UserSubscription models
         $user_id= Session::get('user')->id;
        // Get the user subscriptions that the user has subscribed to with pivot attributes
        $user = Users::find($user_id);
        $userSubscriptions = $user->subscriptions()
            ->withPivot('activation_timestamp', 'expiry_timestamp')
            ->get();

        // Get all available subscriptions (you need a Subscription model for this)
        $allSubscriptions = Subscription::all();

        // Find the subscriptions that the user has not subscribed to
        $notSubscribedSubscriptions = $allSubscriptions->diff($userSubscriptions);

        // Filter expired subscriptions
        $expiredSubscriptions = $userSubscriptions->filter(function ($subscription) {
            return strtotime($subscription->pivot->expiry_timestamp) < time();
        });

        // Filter active subscriptions (those not expired)
        $activeSubscriptions = $userSubscriptions->filter(function ($subscription) {
            return strtotime($subscription->pivot->expiry_timestamp) >= time();
        });

        return view('users.index', compact('activeSubscriptions', 'notSubscribedSubscriptions', 'expiredSubscriptions','user'));
    }


    //update user profile info

    public function updateUserProfileInfo(Request $request) {
        try {
            $userId = $request->input('user_id');
            $user = Users::find($userId);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',

                'country' => 'required',

                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($user->id),
                ],
            ]);

            // Update user information based on the form data
            $user->update($request->all());

            return response()->json(['message' => 'User information updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


    public function updateUserPassword(Request $request)
    {
        $request->validate([
            'user_id3' => 'required|exists:users,id',
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Users::find($request->user_id3);

        // Verify the current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['success' => false, 'errors' => ['current_password' => 'Current password is incorrect']]);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Password updated successfully']);
    }






}
