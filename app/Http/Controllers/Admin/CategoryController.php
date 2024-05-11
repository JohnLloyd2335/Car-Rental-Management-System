<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('cars')->orderByDesc("id")->get();
        if ($request->ajax()) {
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn("date_added", function ($category) {
                    return date('M d, Y h:i A', strtotime($category->created_at));
                })
                ->addColumn('action', function ($category) {
                    $route = route('category.edit', $category->id);
                    return "<a class='bg-primary' href='" . $route . "'><i class='fas fa-edit'></i></a>";
                })
                ->rawColumns(['date_added', 'action'])
                ->make(true);
        }

        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('category.index')->with('success', 'Category Successfully Added');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update($id, UpdateCategoryRequest $request)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('category.index')->with('success', 'Category Successfully Updated');
    }
}
