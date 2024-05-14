<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Accessory\StoreAccessoryRequest;
use App\Http\Requests\Admin\Accessory\UpdateAccessoryRequest;
use App\Models\Accessory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AccessoryController extends Controller
{
    public function index(Request $request)
    {
        $accessories = Accessory::orderByDesc("id")->get();
        if ($request->ajax()) {
            return DataTables::of($accessories)
                ->addIndexColumn()
                ->addColumn("date_added", function ($accessory) {
                    return date('M d, Y h:i A', strtotime($accessory->created_at));
                })
                ->addColumn('action', function ($accessory) {
                    $route = route('accessory.edit', $accessory->id);
                    return "<a class='bg-primary' href='" . $route . "'><i class='fas fa-edit'></i></a>";
                })
                ->rawColumns(['date_added', 'action'])
                ->make(true);
        }

        return view('admin.accessory.index');
    }

    public function create()
    {
        return view('admin.accessory.create');
    }

    public function store(StoreAccessoryRequest $request)
    {
        Accessory::create([
            'name' => $request->name
        ]);

        return redirect()->route('accessory.index')->with('success', 'Accessory Successfully Added');
    }

    public function edit($id)
    {
        $accessory = Accessory::findOrFail($id);

        return view('admin.accessory.edit', compact('accessory'));
    }

    public function update($id, UpdateAccessoryRequest $request)
    {
        $accessory = Accessory::findOrFail($id);

        $accessory->update([
            'name' => $request->name
        ]);

        return redirect()->route('accessory.index')->with('success', 'Accessory Successfully Updated');
    }
}
