<?php

namespace App\Http\Controllers\Web\Backend\User;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userlist(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return '<a href="' . route("backend.users.details", $user->id) . '" class="btn btn-sm btn-primary">
                    <i class="tf-icons ti ti-eye"></i>
                    </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.layouts.users.list');
    }

    public function userDetails(Request $request, $id){
        $data = User::find($id);        
        return view('backend.layouts.users.details', compact('data'));
    }
}
