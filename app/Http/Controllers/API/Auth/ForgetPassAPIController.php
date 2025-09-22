<?php

namespace App\Http\Controllers\API\Auth;

use Carbon\Carbon;
use App\Models\User;
use Ichtrojan\Otp\Otp;
use App\Helpers\Helper;
use App\Mail\VerifyOTP;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgetPassAPIController extends Controller
{

    public function forgetPassword(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return Helper::error('Email not valid', 404);
        }

        if ($user->email_verified_at !== null) {
            return Helper::error('Email already verified', 404);
        }

        // Generate OTP (6 digits)
        $otp  = (new Otp)->generate($request->email, 'numeric', 6, 60);

        // dd($otp->token);

        // Send OTP via email
        Mail::to($request->email)->send(new VerifyOTP($otp->token, $user));

        return response()->json([
            'status'  => 'success',
            'message' => 'OTP sent to your email for password reset.',
            'data'    => [
                'otp' => $otp
            ],
        ]);
    }


    public function verifyOtp(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string',
            'otp' => 'required',
        ]);

        if ($validate->fails()) {
            return Helper::validation($validate->errors());
        }

        $user = User::where('email', $request->email)->first();

        $verify = (new Otp)->validate($request->email, $request->otp);

        // dd($verify);

        if ($verify) {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return Helper::error('Email not found', 404);
            }
            $resetToken = Str::random(40);
            $tokenExp = Carbon::now()->minutes(15);

            $user->update([
                'reset_password_token'      => $resetToken,
                'reset_password_token_exp'  => $tokenExp,
            ]);

            return response()->json([
                'status' => 201,
                'success' => "OTP verified successfully'",
                'token' => $resetToken,
                'user' => $user,
            ]);
        } else {
            return Helper::error('Email not found', 404);
        }
    }

    
    public function reset_password(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'token' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        if ($validate->fails()) {
            return Helper::validation($validate->errors());
        }

        try {
            $user = User::where('reset_password_token', $request->token)->first();

            if (!$user) {
                return Helper::error('Token not valid', 401);
            }
            // if ($user->reset_password_token_exp > Carbon::now()) {
            //     return Helper::error('Token expired', 403);
            // }
            $user->password = Hash::make($request->password);
            $user->reset_password_token = null;
            $user->reset_password_token_exp = null;
            $user->save();
            return Helper::success("Password change successfully", 200);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 404,
                'error' => $exception->getMessage(),
            ], 404);
        }
    }
}
