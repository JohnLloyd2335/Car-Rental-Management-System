<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUserTableComponent extends Component
{

    use WithPagination;

    public string $keywords;

    public string $status;

    public string $orderBy;

    public function mount()
    {
        $this->status = "All";
        $this->orderBy = "DESC";
    }

    public function render()
    {

        $users = User::where('is_admin', false);

        if (!empty($this->keywords)) {

            $users = User::whereAny(['name', 'email', 'address'], 'LIKE', '%' . $this->keywords . '%');

        }

        if ($this->status != "All") {
            $users = $users->where('is_blocked', $this->status);
        }

        $users = $users->orderBy('created_at', $this->orderBy);

        $users = $users->paginate(5);

        return view('livewire.admin.manage-user-table-component', compact('users'));
    }

}
