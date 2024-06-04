<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use DB;
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

    public function changeStatus($id)
    {

        DB::beginTransaction();

        try {
            $user = User::find($id);

            $new_status = !$user->is_blocked;

            $user->update([
                'is_blocked' => $new_status
            ]);

            $success_response = [
                'success' => true,
                'message' => 'User Status Successfully Updated'
            ];

            DB::commit();

            return response()->json($success_response);

        } catch (\Throwable $th) {

            $failed_response = [
                'success' => false,
                'message' => $th->getMessage()
            ];

            DB::rollBack();

            return response()->json($failed_response, 500);

        }


    }
}
