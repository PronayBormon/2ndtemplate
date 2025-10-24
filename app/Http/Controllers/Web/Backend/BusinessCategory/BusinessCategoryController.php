<?php

namespace App\Http\Controllers\Web\Backend\BusinessCategory;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\BusinessCategory;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BusinessCategoryController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = BusinessCategory::orderBy('name', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn() // optional, for index column
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('backend.business.category.edit', ['id' => $row->id]) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="' . route('backend.business.category.delete', ['id' => $row->id]) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.layouts.business_category.index');
    }

    public function create()
    {

        return view('backend.layouts.business_category.create');
    }
    public function edit($id)
    {
        $category = BusinessCategory::find($id);

        return view('backend.layouts.business_category.edit', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        BusinessCategory::create($request->only('name', 'description'));
        

        return redirect()->route('backend.business.category.index')->with('t-success', 'Category save successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = BusinessCategory::findOrFail($id);
        $category->update($request->only('name', 'description'));

        return redirect()->route('backend.business.category.index')->with('t-success', 'Category Update successfully');
    }
    public function delete(Request $request, $id)
    {
        $category = BusinessCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return redirect()->route('backend.business.category.index')->with('t-success', 'Category delete successfully');
    }
}
