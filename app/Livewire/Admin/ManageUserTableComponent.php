<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUserTableComponent extends Component
{

    use WithPagination;

    public function render()
    {

        $users = User::where('is_admin', false);

        $users = $users->paginate(5);

        return view('livewire.admin.manage-user-table-component', compact('users'));
    }

    public function changeStatus(User $user)
    {
        $new_status = !$user->is_blocked;

        $user->update(['is_blocked' => $new_status]);
    }

}
