<?php


namespace App\Helpers;

class Helper
{
    public static function validation($validatorErrors, $code = 422)
    {
        return response()->json([
            'status'  => false,
            'code'    => $code,
            'error' => $validatorErrors,
        ], $code);
    }
    public static function success($message = 'Success', $code = 200)
    {
        return response()->json([
            'status'    => true,
            'code'      => $code,
            'message'   => $message,
        ], $code);
    }
    public static function successData($data, $message = 'Success', $code = 200)
    {
        return response()->json([
            'status'    => true,
            'code'      => $code,
            'message'   => $message,
            'data'      => $data,
        ], $code);
    }
    public static function error($errors = 'error', $code = 400)
    {
        return response()->json([
            'status'  => false,
            'code'    => $code,
            'error' => $errors,
        ], $code);
    }

    public static function responseOtp($message = "OTP send successfully", $otp, $code = 200)
    {
        return response()->json([
            'status' => $code,
            'success' => $message,
            'otp' => $otp,
        ], $code);
    }
}
