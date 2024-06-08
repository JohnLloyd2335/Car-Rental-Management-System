<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Mail\Auth\RegistrationVerification;
use App\Models\EmailVerificationTokens;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;
use Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function handleLogin(LoginRequest $request)
    {
        $credentails = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = User::where('email', $request->email)->count();

        if (!$user > 0) {

            $response = [
                'success' => false,
                'message' => 'User Not Found',
            ];

            return response()->json($response, 404);
        }

        if (!Auth::attempt($credentails)) {

            $response = [
                'success' => false,
                'message' => 'Incorrect Password',
            ];

            return response()->json($response, 401);
        }

        if (is_null(auth()->user()->email_verified_at) || empty(auth()->user()->email_verified_at)) {

            $response = [
                'success' => false,
                'message' => 'User is not verified please check your email'
            ];

            Auth::logout();

            return response()->json($response, 401);
        }

        if (auth()->user()->is_blocked) {

            $response = [
                'success' => false,
                'message' => 'User is Blocked please contact the administrator'
            ];

            Auth::logout();

            return response()->json($response, 401);

        }

        if (auth()->user()->is_admin) {
            return response()->json(['is_admin' => 1]);
        } else {
            return response()->json(['is_admin' => 0]);
        }

    }

    public function register()
    {
        return view('auth.register');
    }

    public function handleRegistration(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'address' => ['required', 'max:255'],
            'mobile_number' => ['required', 'digits:10'],
            'password' => ['required', 'max:255', 'confirmed'],
            'password_confirmation' => ['required', 'max:255'],
        ]);

        if ($validated->fails()) {

            $validation_error_response = [
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validated->errors()
            ];

            return response()->json($validation_error_response, 422);

        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'address' => $request->address,
                'password' => Hash::make($request->password)
            ]);

            $success_response = [
                'success' => true,
                'message' => 'We send an email please verify your account'
            ];

            $token = \Str::random(90);

            $mailData = [
                'title' => 'Email Verification',
                'message' => 'Click the link to verify your email',
                'link' => route('verify_email', $token)
            ];

            Mail::to($user->email)->send(new RegistrationVerification($mailData));

            EmailVerificationTokens::create([
                'email' => $user->email,
                'token' => $token,
            ]);

            DB::commit();

            return response()->json($success_response);

        } catch (\Throwable $th) {

            DB::rollBack();

            $failed_response = [
                'success' => false,
                'message' => $th->getMessage()
            ];

            return response()->json($failed_response, 500);
        }


    }

    public function verifyEmail(string $token)
    {

        $user_token = EmailVerificationTokens::where('token', $token)->first();

        if (!$user_token) {
            abort(404, 'Invlalid Token');
        }

        if ($user_token->token != $token) {
            abort(403, 'Token Mismatched');
        }

        $user = User::where('email', $user_token->email)->first();

        $user->update([
            'email_verified_at' => Carbon::now()
        ]);

        $user_token->delete();

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
    }
}
