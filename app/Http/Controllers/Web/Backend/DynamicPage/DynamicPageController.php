<?php

namespace App\Http\Controllers\Web\Backend\DynamicPage;

use App\Models\DynamicPage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class DynamicPageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pages = DynamicPage::select(['id', 'title', 'slug', 'status', 'created_at']);

            return DataTables::of($pages)
                ->addIndexColumn()
                ->addColumn('action', function ($page) {
                    return '
                    <a href="' . route('backend.pages.edit', $page->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    
                ';
                })
                ->editColumn('status', function ($page) {
                    $colors = [
                        'draft' => 'secondary',
                        'published' => 'success',
                        'archived' => 'warning'
                    ];
                    $color = $colors[$page->status] ?? 'secondary';
                    return '<span class="badge bg-' . $color . '">' . ucfirst($page->status) . '</span>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('backend.layouts.pages.index');
    }

    public function pageEdit($id)
    {
        $page = DynamicPage::find($id);
        return view('backend.layouts.pages.edit', compact('page'));
    }
    public function pageUpdate(Request $request, $id)
    {
        // Find the page
        $page = DynamicPage::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'slug'    => 'required|string|max:255|unique:dynamic_pages,slug,' . $page->id,
            'content' => 'required|string',
            'status'  => 'required|in:draft,published,archived',
        ]);

        // Update page
        $page->update($validated);
        // Optional: flash message
        return redirect()->route('backend.pages.list')->with('t-success', 'Page updated successfully.');
    }
}
