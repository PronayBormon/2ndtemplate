<?php

namespace App\Http\Controllers\Web\Backend\User;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function userlist(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query();
            return DataTables::of($users)
                ->addColumn('role', function ($user) {
                    if ($user->role === "super_admin") {
                        $role = '<span class="badge bg-label-success">Super Admin</span>';
                    } elseif ($user->role === "admin") {
                        $role = '<span class="badge bg-label-success">Admin</span>';
                    } elseif ($user->role === "manager") {
                        $role = '<span class="badge bg-label-warning">Manager</span>';
                    } elseif ($user->role === "editor") {
                        $role = '<span class="badge bg-label-info">Editor</span>';
                    } else {
                        $role = '<span class="badge bg-light">User</span>';
                    }
                    return $role;
                })
                ->addColumn('status', function ($user) {
                    if ($user->status === "active") {
                        $status = '<span class="badge bg-success">Active</span>';
                    } elseif ($user->status === "inactive") {
                        $status = '<span class="badge bg-warning">Inactive</span>';
                    } else {
                        $status = '<span class="badge bg-danger">Banned</span>';
                    }
                    return $status;
                })
                ->addColumn('created_at', function ($user) {
                    return Carbon::parse($user->created_at)->format('M d Y, h:i A');
                })
                ->addColumn('action', function ($user) {
                    return '<a href="' . route("backend.users.details", $user->id) . '" class="btn btn-sm btn-primary">
                    <i class="tf-icons ti ti-eye"></i>
                    </a>';
                })
                ->rawColumns(['role', 'status', 'action'])
                ->make(true);
        }
        $total = User::count();
        $user = User::where('role', 'user')->count();

        $active = User::where('status', 'active')->count();
        $inactive = User::where('status', 'inactive')->count();
        $banned = User::where('status', 'banned')->count();

        return view('backend.layouts.users.list', compact(
            "total",
            "user",
            "active",
            "inactive",
            "banned"
        ));
    }

    public function userDetails(Request $request, $id)
    {
        $data = User::find($id);
        return view('backend.layouts.users.details', compact('data'));
    }

    public function userUpdate(Request $request, $id)
    {

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

    public function updatePassword(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('t-success', 'Password updated successfully.');
    }

    public function userStore(Request $request)
    {
        // 1️⃣ Validate request
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|string|min:6',
            'role'           => 'required|string',
            'phone'          => 'nullable|string|max:20',
            'address'        => 'nullable|string|max:255',
            'avatar'         => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'date_of_birth'  => 'nullable|date',
            'gender'         => 'nullable|string|in:male,female,other',
            'bio'            => 'nullable|string',
            'facebook_url'   => 'nullable|url',
            'twitter_url'    => 'nullable|url',
            'linkedin_url'   => 'nullable|url',
            'instagram_url'  => 'nullable|url',
            'website'        => 'nullable|url',
            'status'         => 'nullable|in:active,inactive',
            'last_login_at'  => 'nullable|date',
            'last_login_ip'  => 'nullable|ip',
        ]);

        // 2️⃣ Prepare data
        $data = $request->except('password', 'avatar');
        $data['password'] = bcrypt($request->password);

        // 3️⃣ Handle avatar upload
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = rand(1000, 9999) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('avatars', $imageName, 'public');
            $data['avatar'] = 'storage/' . $path; // store public path
        }

        // 4️⃣ Create user
        $user = User::create($data);

        // 5️⃣ Return response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully!',
            'user'    => $user
        ]);
    }
}
