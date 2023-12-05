<?php

namespace App\Http\Controllers\login_registration;
use App\Http\Controllers\Controller;
use App\Models\super_admin\user_management\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Mail\registration\MainRegistrationMailHandler;
use Mail;
use Illuminate\Support\Str;


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


        try {
            // Validate email format
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                throw new \Exception('Invalid email format. Please provide a valid email address.');
            }

            // Attempt to authenticate the user
            $user = Users::where('email', $request->email)->first();

            // Check if user exists and password is correct
            if (!$user || !Hash::check($request->password, $user->password)) {
                // Authentication failed
                throw new \Exception('Invalid credentials. Please try again.');
            }

            // Authentication successful, redirect to appropriate dashboard based on role
            if ($user->isSuperAdmin() && $user->isEmailVerified()) {
                // Store user information in session
                Session::put('user', $user);
                return redirect('/super_dashboard');
            } else {

                if($user->isEmailVerified() && $user->isUser()){
                        // Store user information in session
                    Session::put('user', $user);
                    return redirect('/user_dashboard');

                }

                return redirect('/')->with('error','Please verify your email');

            }
        } catch (\Exception $e) {
            // Log the exception or handle it appropriately
            Log::error('Authentication error: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect('/')->with('error', $e->getMessage());
        }

    }

    public function register(Request $request)
    {
        try {
            // Validate user registration data
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|string|min:8|confirmed',
                'country' => 'required|string|max:255',
                'age_confirmation' => 'required|accepted',
            ]);

            if ($validator->fails()) {
                return redirect('/')
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error2', 'Registration failed. Please correct the errors below.');
            }

            // Generate reset token
            $token = base64_encode(Str::random(40));

            // Attempt to send email
            $isEmailSend = $this->sendEmailValidation($request->input('email'), $token, $request->input('last_name'));

            if ($isEmailSend) {
                // Create the user with the current date
                $user = Users::create([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'country' => $request->input('country'),
                    'email_token' => $token,
                    'role' => 'user',
                ]);

                // Redirect to dashboard after successful registration
                return redirect('/')->with('account_success', 'Registration successful. Verify Your Email.');
            } else {
                // Email sending failed. Redirect with an error message
                return redirect('/')->with('error2', 'Email send failed. Please check your email and try again.');
            }
        } catch (\Exception $e) {
            // Log the exception or handle it appropriately
            Log::error('Registration error: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect('/')->with('error2', 'Registration failed. Please try again.');
        }
    }


    private function sendEmailValidation($email, $token,$last_name)
    {
        $emailVerificationLink = route('email.verification', $token);

        try {
            Mail::send('mail.registration.registration_mail', ['emailVerificationLink' => $emailVerificationLink, 'last_name' => $last_name], function ($message) use ($email) {
                $message->to($email)->subject('Welcome To AceAmcq - Verify Your Email');
            });

            // If no exception is thrown, the email sending was successful
            return true;
        } catch (\Exception $e) {

            \Log::error("Error sending email: {$e->getMessage()}");

            // Return false to indicate that the email sending failed
            return false;
        }
    }

    public function emailVerification($token){

        $user = Users::where('email_token', $token)->first();

        if(!$user){
            return redirect('/')->with('email_token_error', 'token not found!');

        }
        $user->email_token = null;
        $user->email_status = 1;
        $user->save();

        return redirect('/')->with('success', 'Password reset successfully! Please login with your new password.');




    }


    public function forgotPassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Users::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Generate reset token
        $token = base64_encode(Str::random(40));

        // Set reset token and expiration time
        $user->reset_token = $token;
        $user->token_expires_at = now()->addHours(2);

        // Save the user record
        $user->save();

        if ($user->wasChanged()) {
            // Send reset link email
            $this->sendResetEmail($user->email, $token);

            return response()->json(['message' => 'Reset link sent successfully!']);
        } else {
            return response()->json(['errors' => ['email' => ['Failed to update user.']]], 500);
        }
    }



    private function sendResetEmail($email, $token)
    {
        $resetLink = route('password.reset', $token);

        Mail::send('mail.forgot_password.forgot_password_link_send', ['resetLink' => $resetLink], function ($message) use ($email) {
            $message->to($email)->subject('Reset Your Password');
        });
    }


    public function passwordRest($token){


        return view('forgot_password.password_reset',[
            'token'=>$token,
        ]);
    }

    public function changePassword(Request $request){


        $validator = \Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed', // 'confirmed' ensures that password_confirmation field matches password
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Users::where('reset_token', $request->token)
            ->where('token_expires_at', '>', now())
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid or expired token.');
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->token_expires_at = null;
        $user->save();

        $email=$user->email;

         Mail::send('mail.change_password_success.change_password_success', ['last_name' => $user->last_name], function ($message) use ($email) {
                $message->to($email)->subject('Your Account Password has been changed Successfully- AceAmcQ');
            });

        // Redirect the user after successful password reset
        return redirect('/')->with('success', 'Password reset successfully! Please login with your new password.');



    }


    public function contactUs(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'massage' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Get form data
        $name = $request->input('name');
        $email = $request->input('email');
        $massage = $request->input('massage');

        // Call the email sender function
        try {
            $this->contactUsEmailSender($email, $massage, $name);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while sending the email.'], 500);
        }
    }

    private function contactUsEmailSender($email, $massage, $name)
    {
        // Generate a random ticket number
        $ticketNumber = mt_rand(100000, 999999);

        try {
            // Send the email
            Mail::send('mail.contact_us.contact_us', ['name' => $name, 'massage' => $massage, 'ticketNumber' => $ticketNumber], function ($message) use ($email, $ticketNumber) {
                $message->to(['support@aceamcq.com', $email])
                    ->subject('AceAmcQ Support Ticket No. ' . $ticketNumber)
                    ->replyTo($email, 'AceAmcQ');
            });
        } catch (\Exception $e) {
            // Handle the email sending error
            throw new \Exception('Error sending email: ' . $e->getMessage());
        }
    }



    public function emailtesting(){



        $mailData = [

            'first_name' =>'khan',

            'last_name' => 'khan jan',

        ];



        Mail::to('luckyjansoft@gmail.com')->send(new MainRegistrationMailHandler($mailData));
    }




}
