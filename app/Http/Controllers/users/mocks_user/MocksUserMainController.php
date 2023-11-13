<?php

namespace App\Http\Controllers\users\mocks_user;

use App\Http\Controllers\Controller;
use App\Models\super_admin\user_management\user_subscription\UserSubscription;
use App\Models\super_admin\user_management\Users;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class MocksUserMainController extends Controller
{
    //

    public function welcomeView($subscription_id=null){

        if ($subscription_id !== null) {
            // $subscription_id is not null, proceed with the logic
            $subscription_id1 = decrypt($subscription_id);
            $user_id = Session::get('user')->id;

            $userSubscription = UserSubscription::where([
                ['user_id', '=', $user_id],
                ['subscription_id', '=', $subscription_id1],
            ])->select('expiry_timestamp')->first();

            if ($userSubscription) {
                // Check if the session key 'mocks_expiry_timestamp' already exists
                if (Session::has('mocks_expiry_timestamp')) {
                    // Session key already exists, update its value
                    Session::put('mocks_expiry_timestamp', $userSubscription->expiry_timestamp);
                } else {
                    // Session key doesn't exist, create it
                    Session::put('mocks_expiry_timestamp', $userSubscription->expiry_timestamp);
                }
            }
        }

        // The rest of your logic or view rendering goes here
        return view("users.mocks_user.index");
    }



}
