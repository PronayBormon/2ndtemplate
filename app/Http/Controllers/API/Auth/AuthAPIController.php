<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Ichtrojan\Otp\Otp;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Notifications\VerifyEmail;

class AuthAPIController extends Controller
{
    public function login(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return Helper::validation($validator->errors());
        }

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            return Helper::successData([
                'token' => $user->createToken('API Token')->plainTextToken,
                'user'  => $user,
            ], 'Login successful', 200);
        }

        return Helper::error('Invalid credentials', 404);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|string|min:6',
        ]);

        if ($validator->fails()) {
            return Helper::validation($validator->errors());
        }

        // Create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $otp  = (new Otp)->generate($request->email, 'numeric', 6, 60);

        Mail::to($user->email)->send(new EmailVerification($otp, $user));

        return Helper::successData('User registered successfully. OTP sent to your email.', [
            'otp'  => $otp,
            'user' => $user,
        ]);
    }

    public function verifyEmail(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp'   => 'required',
        ]);


        if ($validate->fails()) {
            return Helper::validation($validate->errors());
        }

        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return Helper::error('Email not valid', 404);
            }

            if ($user->email_verified_at !== null) {
                return Helper::error('Email already verified', 404);
            }

            $verify = (new Otp)->validate($request->email, $request->otp);

            if ($verify->status) {
                $user->email_verified_at = now();
                $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Email verified successfully',
                    'token_type' => 'Bearer',
                    'token' => $user->createToken('AuthToken')->plainTextToken,
                    'data' => $user
                ]);
            } else {
                return Helper::error('One time password not match', 404);
            }
        } catch (\Exception $exception) {
            return Helper::error('Server errors', 500);
        }
    }


    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return Helper::error('Email not valid', 404);
        }

        if ($user->email_verified_at !== null) {
            return Helper::error('Email already verified', 404);
        }


        // Generate a new OTP (6 digits)
        $otp = (new Otp)->generate($request->email, 'numeric', 6, 60);
        // Send OTP via email
        Mail::to($request->email)->send(new EmailVerification($otp, $user));

        return response()->json([
            'status'  => 'success',
            'message' => 'OTP resent successfully.',
            'data'    => [
                'otp' => $otp
            ],
        ]);
    }
}
