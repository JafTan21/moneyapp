<?php

namespace App\Http\Livewire;

use App\Models\ConstructionGroup as ModelsConstructionGroup;
use Livewire\Component;

class ConstructionGroup extends Component
{

    public $name = '', $description = '';
    public $editId = '';

    protected $listeners = [
        'update-construction-groups' => 'render'
    ];

    public function save()
    {
        if ($this->name == '') {
            return;
        }
        ModelsConstructionGroup::create([
            'name' => $this->name,
            'description' => $this->description
        ]);

        $this->name = '';
        $this->description = '';
        $this->emit('update-construction-groups');
    }

    public function delete($id)
    {
        ModelsConstructionGroup::where('id', $id)->first()->delete();
        $this->emit('update-construction-groups');
    }

    public function edit($id)
    {
        $this->editId = $id;
        $group = ModelsConstructionGroup::where('id', $id)->first();

        $this->name = $group->name;
        $this->description = $group->description;
    }

    public function update($id)
    {
        ModelsConstructionGroup::where('id', $id)->first()->update([
            'name' => $this->name,
            'description' => $this->description
        ]);


        $this->name = '';
        $this->description = '';
        $this->editId = '';

        $this->emit('update-construction-groups');
    }

    public function render()
    {
        return view('livewire.construction-group', [
            'groups' => ModelsConstructionGroup::all()
        ]);
    }
}