<?php

namespace App\Http\Controllers\Web\Backend\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $data = auth()->user();
        return view('backend.layouts.profile.details', compact('data'));
    }
    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $id = auth()->id();
        $user = User::findOrFail($id);

        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'bio' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'website' => 'nullable|url',
            'status' => 'required|string',
        ]);

        // Update fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->gender;
        $user->bio = $request->bio;
        $user->facebook_url = $request->facebook_url;
        $user->twitter_url = $request->twitter_url;
        $user->linkedin_url = $request->linkedin_url;
        $user->instagram_url = $request->instagram_url;
        $user->website = $request->website;
        $user->status = $request->status;
        $user->last_login_at = $request->last_login_at;
        $user->last_login_ip = $request->last_login_ip;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {

            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $image = $request->file('avatar');
            $imageName = rand(1000, 9999) . '_' . time() . '.' . $image->getClientOriginalExtension();

            // Store in 'avatars' folder in public disk
            $path = $image->storeAs('avatars', $imageName, 'public');

            $user->avatar = 'storage/' . $path;
        }


        $user->save();

        return redirect()->back()->with('t-success', 'User profile updated successfully.');
    }
}
