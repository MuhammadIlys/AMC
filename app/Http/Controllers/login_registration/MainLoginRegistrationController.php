<?php

namespace App\Http\Controllers\login_registration;
use App\Http\Controllers\Controller;
use App\Models\super_admin\user_management\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class MainLoginRegistrationController extends Controller
{
    public function showLogin()
    {
        return view('login_registration.login_registration_main'); // Your blade template for login and registration
    }


    // logout for the super admin
    public function superAdminLogout(){

        Session::forget('user');
        return redirect('/');
    }

    // logout for users
    public function userLogout(){

        Session::forget('user');
        return redirect('/');
    }

    public function login(Request $request)
    {


        // Attempt to authenticate the user
        $user = Users::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            // Authentication failed
            return redirect('/')->with('error', 'Invalid credentials. Please try again.');
        }

        // Authentication successful, redirect to appropriate dashboard based on role
        if ($user->isSuperAdmin()) {
            // Store user information in session
            Session::put('user', $user);
            return redirect('/super_dashboard');
        } else {
            // Store user information in session
            Session::put('user', $user);
            return redirect('/user_dashboard');
        }
    }

    public function register(Request $request)
    {



    // Create the user with the current date
    $user = Users::create([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'country' => $request->input('country'),
        'role' => 'user',
    ]);

        // Store user information in session
        session(['user' => $user]);

        // Redirect to dashboard after successful registration
        return redirect('/user_dashboard')->with('success', 'Registration successful. You are now logged in.');
    }




}
