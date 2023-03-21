<div class="collapse show" id="ConstructorGroups">
    <table class="table">
        <thead>

            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Description</td>
                <td>Action</td>
            </tr>

        </thead>

        <tbody>

            @forelse ($groups as $group)

            @if ($editId == $group->id)
            <tr>
                <td>{{ $group->id }}</td>
                <td>
                    <x-edit-input model="name" />
                </td>
                <td>
                    <x-edit-input model="description" />
                </td>
                <td>
                    <button wire:click="update({{ $group->id }})" class="btn btn-success">Update</button>
                </td>
            </tr>
            @else
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->description }}</td>
                <td>
                    <button class="btn btn-sm btn-info" wire:click="edit({{ $group->id }})">Edit</button>
                    |
                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $group->id }})">
                        Delete
                    </button>
                </td>
            </tr>
            @endif

            @empty

            @endforelse


            @if ($editId =='')
            <tr>
                <td></td>
                <td>
                    <x-custom-input model="name" label="Name" />
                </td>
                <td>
                    <x-custom-input model="description" label="Description" />
                </td>
                <td>
                    <div class="form-group" style="margin-top: 40px;">
                        <button wire:click="save()" class="btn btn-success" {{ $name ==''?'disabled':'' }}>
                            save
                        </button>
                    </div>
                </td>

            </tr>
            @endif

        </tbody>
    </table>
</div>