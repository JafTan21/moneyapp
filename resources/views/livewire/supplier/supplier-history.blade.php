<div>
    <div class="row">
        @include('inc.searchable')
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <td># </td>
                <td>Contact</td>
                <td>Company</td>
                <td>Mobile</td>
                <td>Email</td>
                <td>Product</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $supplier)

            @if ($editId == $supplier->id)
            <tr>
                <td>
                    {{ $supplier->id }}
                </td>
                <td>
                    <x-edit-input model="contact" />
                </td>
                <td>
                    <x-edit-input model="company" />
                </td>
                <td>
                    <x-edit-input model="mobile" />
                </td>
                <td>
                    <x-edit-input model="email" />
                </td>
                <td>
                    <textarea wire:model="product" class="form-control"></textarea>
                </td>
                <td>
                    <button class="btn  btn-success" wire:click="save({{ $supplier->id }})">Save</button>
                </td>
            </tr>
            @else

            <tr>
                <td>
                    {{ $supplier->id }}
                </td>
                <td>
                    {{ $supplier->contact }}
                </td>
                <td>
                    {{ $supplier->company }}
                </td>
                <td>
                    {{ $supplier->mobile }}
                </td>
                <td>
                    {{ $supplier->email }}
                </td>
                <td>
                    {{ $supplier->product }}
                </td>
                <td>
                    <button class="btn btn-sm btn-info" wire:click="edit({{ $supplier->id }})">Edit</button>
                    |
                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $supplier->id }})">
                        Delete
                    </button>
                </td>
            </tr>
            @endif

            @endforeach
        </tbody>

    </table>
    {{ $data->links() }}
</div>