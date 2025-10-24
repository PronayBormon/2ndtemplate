<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileApiController extends Controller
{
    public function index()
    {
        $data = auth()->user();
        return Helper::successData($data, 200);
    }

    public function updateDetails(Request $request)
    {
        $user = auth()->user(); // if using auth
        // Or if admin updates: $user = User::findOrFail($request->id);

        $validator = Validator::make($request->all(), [
            'name'          => 'nullable|string|max:255',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender'        => 'nullable|in:male,female,other',
            'bio'           => 'nullable|string|max:500',
            'facebook_url'  => 'nullable|url',
            'twitter_url'   => 'nullable|url',
            'linkedin_url'  => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'website'       => 'nullable|url',
            'avatar'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return Helper::validation($validator->errors());
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('avatars', $imageName, 'public');
            $user->avatar = 'storage/' . $path;
        }

        // Update other fields
        $user->fill($request->only([
            'name',
            'phone',
            'address',
            'date_of_birth',
            'gender',
            'bio',
            'facebook_url',
            'twitter_url',
            'linkedin_url',
            'instagram_url',
            'website',
        ]));

        $user->save();

        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => 'User details updated successfully.',
            'data'    => $user,
        ]);
    }


    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return Helper::success("Password update successfully");
    }
}
