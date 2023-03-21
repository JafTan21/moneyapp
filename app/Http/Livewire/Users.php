<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Users extends Component
{
    public $search = '';
    public $editId = '', $checkedPermissions = [];


    public function edit($id)
    {
        $this->editId = $id;
        $this->checkedPermissions = User::where('id', $id)->first()->permissions->pluck('name');
    }

    public function save($id)
    {
        User::where('id', $id)->first()->syncPermissions($this->checkedPermissions);
        $this->editId = '';
    }

    public function render()
    {
        $users = User::search($this->search)
            ->with(['roles:name', 'permissions:name'])
            ->paginate(20);


        return view('livewire.users', [
            'users' => $users,
            'permissions' => Permission::select('name')->get()
        ]);
    }
}