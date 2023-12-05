<?php

namespace App\Http\Controllers\super_admin\user_management\subscription;

use App\Http\Controllers\Controller;
use App\Models\super_admin\user_management\subscription\Subscription;
use App\Models\super_admin\user_management\user_subscription\UserSubscription;
use App\Models\super_admin\user_management\Users;
use Illuminate\Http\Request;
use Mail;

class MainSubscriptionController extends Controller
{
    public function addSubscriptionView(){

        return view('super_admin.user_management.subscription.add_subscription');
    }

    public function subscriptionView(){

        return view('super_admin.user_management.subscription.main_subscription');
    }


    public function addSubscription(Request $request)
    {
        // Validate the request data
        $request->validate([
            'subscription_name' => 'required|string',
            'demo_link' => 'required|string',
            'lunch_link' => 'required|string',
            'renew_link' => 'required|string',
        ]);

        // Create a new subscription
        $subscription = Subscription::create([
            'subscription_name' => $request->subscription_name,
            'demo_link' => $request->demo_link,
            'lunch_link' => $request->lunch_link,
            'renewal_link' => $request->renew_link,
        ]);

        // You can do additional actions here if needed, e.g., attach it to a user.

        return response()->json([
            'status' => '1',
            'message' => 'Subscription added successfully',
        ]);
    }


    public function getSubscriptionData()
    {
        $subscriptions = Subscription::select([
            'subscription_id',
            'subscription_name',
            'demo_link',
            'lunch_link',
            'renewal_link',
        ])->get();

        return response()->json(['data' => $subscriptions]);
    }


    public function deleteSubscription($subscriptionId)
    {
        $subscription = Subscription::find($subscriptionId);

        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        $subscription->delete();

        return response()->json(['message' => 'Subscription deleted successfully']);
    }


    public function updateSubscription(Request $request)
    {
        $subscriptionId = $request->input('subscription_id');

        // Validate the request data, adjust the validation rules as needed
        $request->validate([
            'subscription_id' => 'required|exists:subscription,subscription_id', // Ensure the subscription exists
            'subscription_name' => 'required|string',
            'demo_link' => 'required|string',
            'lunch_link' => 'required|string',
            'renew_link' => 'required|string',
        ]);

        // Find the subscription to update
        $subscription = Subscription::find($subscriptionId);

        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        // Update the subscription attributes
        $subscription->update([
            'subscription_name' => $request->input('subscription_name'),
            'demo_link' => $request->input('demo_link'),
            'lunch_link' => $request->input('lunch_link'),
            'renewal_link' => $request->input('renew_link'),
        ]);

        return response()->json(['message' => 'Subscription updated successfully']);
    }


    public function getSubscriptions()
    {
        $subscriptions = Subscription::all(); // Assuming you have a Subscription model

        return response()->json($subscriptions);
    }



    public function addSubscriptiontoUser(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required',
            'subscription_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Check if the user already has an active subscription for the same subscription type
        $existingSubscription = UserSubscription::where('user_id', $request->user_id)
            ->where('subscription_id', $request->subscription_id)
            ->first();

        if ($existingSubscription) {
            return response()->json(['message' => 'User already has an active subscription for this subscription type', 'status' => '0']);
        }

        // Create a new UserSubscription record
        $userSubscription = new UserSubscription;
        $userSubscription->user_id = $request->user_id;
        $userSubscription->subscription_id = $request->subscription_id;
        $userSubscription->activation_timestamp = $request->start_date;
        $userSubscription->expiry_timestamp = $request->end_date;

        $userSubscription->save();

        $user = Users::find($request->user_id);
        $subscription = Subscription::find($request->subscription_id);
        $email = $user->email;
        $subscription_name = $subscription->subscription_name;

        Mail::send('mail.subscription.subscription_add_success', ['last_name' => $user->last_name, 'subscription_name'=>$subscription_name], function ($message) use ($email) {
            $message->to($email)->subject('Subscription Successfully Activated - AceAmcQ');
        });

        return response()->json(['message' => 'Subscription added successfully', 'status' => '1']);
    }



    public function getSubscriptionDatatoTable(Request $request)
    {
        $userId = $request->input('userId');

        $data = UserSubscription::with(['subscription', 'user'])
            ->where('user_id', $userId) // Add a where condition to filter by user_id
            ->select('id', 'subscription_id', 'user_id', 'activation_timestamp', 'expiry_timestamp')
            ->get();

        // Transform the data as needed for DataTables
        $transformedData = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'user_id' => $item->user_id,
                'subscription_id' => $item->subscription_id,
                'user' => [
                    'first_name' => $item->user->first_name,
                    // Add other user properties as needed
                ],
                'subscription' => [
                    'subscription_name' => $item->subscription->subscription_name,
                    // Add other subscription properties as needed
                ],
                'activation_timestamp' => $item->activation_timestamp,
                'expiry_timestamp' => $item->expiry_timestamp,
                // You can add more properties here as needed
            ];
        });

        return response()->json($transformedData);
    }



    public function deleteUserSubscription($subscriptionId)
    {
        // Find the UserSubscription record
        $userSubscription = UserSubscription::find($subscriptionId);

        if (!$userSubscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        // Delete the UserSubscription record
        $userSubscription->delete();

        return response()->json(['message' => 'Subscription deleted successfully']);
    }


    public function updateUserSubscription(Request $request)
    {
        $id = $request->input('id');
        $subscriptionId = $request->input('subscriptionId');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $userId = $request->input('userId');

        try {
            $user = Users::find($userId);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $subscription = Subscription::find($subscriptionId);

            if (!$subscription) {
                return response()->json(['message' => 'Subscription not found'], 404);
            }

            // Use the sync method to synchronize the user's subscriptions
            $user->subscriptions()->sync([$subscriptionId => [
                'activation_timestamp' => $startDate,
                'expiry_timestamp' => $endDate,
            ]], false);

            return response()->json(['message' => 'Subscription updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating subscription', 'error' => $e->getMessage()], 500);
        }
    }




}
