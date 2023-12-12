<?php

namespace App\Http\Controllers\users\qbank_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\super_admin\user_management\user_subscription\UserSubscription;

class MainUserQbankController extends Controller
{
    public function lunchUserQbankDashboard($subscription_id=null){

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

   public function lunchUserQbankCreateTest(){

    return view('users.qbank_user.qbank_create_test.qbank_create_test');


   }


   public function lunchUserQbankPreviousTests(){

    return view('users.qbank_user.qbank_previous_test.qbank_previous_test');


   }


   public function lunchUserQbankTestResults(){

    return view('users.qbank_user.qbank_test_result.qbank_result');


   }


   public function lunchUserQbankTestAnalytics(){

    return view('users.qbank_user.qbank_test_result.qbank_result');


   }

   public function lunchUserQbankTestReports(){

    return view('users.qbank_user.qbank_report.qbank_reports');


   }


   public function lunchUserQbankTestGraphs(){

    return view('users.qbank_user.qbank_graph.qbank_graph');


   }


   public function lunchUserQbankSearch(){

    return view('users.qbank_user.qbank_search.qbank_search');


  }

  public function lunchUserQbankNotes(){

    return view('users.qbank_user.qbank_notes.qbank_notes');


  }

   public function lunchUserQbankTestResetAccount(){

    return view('users.qbank_user.qbank_account_reset.qbank_account_reset');


   }


   public function lunchUserQbankTestHelp(){

    return view('users.qbank_user.qbank_help.qbank_help');


   }






}
