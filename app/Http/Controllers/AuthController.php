<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function handleRegistration(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'password' => Hash::make($request->password)
        ]);

        if ($user) {

            Auth::login($user);

            return redirect()->route('index');
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
