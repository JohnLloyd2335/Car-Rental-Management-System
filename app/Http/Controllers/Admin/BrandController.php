<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\StoreBrandRequest;
use App\Http\Requests\Admin\Brand\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::withCount('cars')->orderByDesc("id")->get();
        if ($request->ajax()) {
            return DataTables::of($brands)
                ->addIndexColumn()
                ->addColumn("date_added", function ($brand) {
                    return date('M d, Y h:i A', strtotime($brand->created_at));
                })
                ->addColumn('action', function ($brand) {
                    $route = route('brand.edit', $brand->id);
                    return "<a class='bg-primary' href='" . $route . "'><i class='fas fa-edit'></i></a>";
                })
                ->rawColumns(['date_added', 'action'])
                ->make(true);
        }

        return view('admin.brand.index');
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(StoreBrandRequest $request)
    {
        Brand::create([
            'name' => $request->name
        ]);

        return redirect()->route('brand.index')->with('success', 'Brand Successfully Added');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', compact('brand'));
    }

    public function update($id, UpdateBrandRequest $request)
    {
        $brand = Brand::findOrFail($id);

        $brand->update([
            'name' => $request->name
        ]);

        return redirect()->route('brand.index')->with('success', 'Brand Successfully Updated');
    }
}
