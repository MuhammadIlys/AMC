<?php

namespace App\Http\Controllers\users\qbank_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\super_admin\user_management\user_subscription\UserSubscription;

class MainUserQbankController extends Controller
{
    public function lunchUserQbankDashboard($subscription_id=null){

        if (!Session::has('qbank_id')){

            session()->put('qbank_id', 1);


        }

        $user_id = Session::get('user')->id;

        if ($subscription_id !== null) {
            // $subscription_id is not null, proceed with the logic
            $subscription_id1 = decrypt($subscription_id);


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

        return view('users.qbank_user.index');


    }



    public function qbankSetup(Request $request)
    {
        $qbankId = $request->input('qbank_id');

        // Store qbank_id in the session
        session()->put('qbank_id', $qbankId);

        // You can perform additional logic here if needed

        return response()->json(['status' => 'success']);
    }




}
