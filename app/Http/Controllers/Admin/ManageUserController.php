<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class ManageUserController extends Controller
{

    public function index()
    {
        return view('admin.manage_user.index');
    }

    public function edit(User $user)
    {
        return view('admin.manage_user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'email' => $request->email
        ]);

        return redirect()->route('manage_user.index')->with('success', 'User Updated Successfully');
    }
}
