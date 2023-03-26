<div>
    <div class="row">
        @include('inc.searchable')
        <x-export-button />
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <td># </td>
                <td>Contact</td>
                {{-- <td>Company</td> --}}
                <td>Mobile</td>
                {{-- <td>Email</td> --}}
                <td>Products</td>

                <td>Bill</td>
                <td>Payment</td>
                <td>Balance</td>

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
                {{-- <td>
                    <x-edit-input model="company" />
                </td> --}}
                <td>
                    <x-edit-input model="mobile" />
                </td>
                {{-- <td>
                    <x-edit-input model="email" />
                </td> --}}

                <td>
                    <ul>
                        @forelse ($supplier->materials as $material)
                        <li>{{ $material->material_name }},</li>
                        @empty
                        @endforelse
                    </ul>
                </td>
                <td>
                    {{ $supplier->materials->sum('bill') }}
                </td>
                <td>
                    <x-edit-input model="payment" />
                </td>
                <td>
                    {{ $supplier->materials->sum('bill') - $supplier->payment}}
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
                {{-- <td>
                    {{ $supplier->company }}
                </td> --}}
                <td>
                    {{ $supplier->mobile }}
                </td>
                {{-- <td>
                    {{ $supplier->email }}
                </td> --}}
                <td>
                    <ul>
                        @forelse ($supplier->materials as $material)
                        <li>{{ $material->material_name }},</li>
                        @empty
                        @endforelse
                    </ul>
                </td>
                <td>
                    {{ $supplier->materials->sum('bill') }}
                </td>
                <td>{{ $supplier->payment }}</td>
                <td>
                    {{ $supplier->materials->sum('bill') - $supplier->payment}}
                </td>
                <td>
                    <button class="btn btn-sm btn-info" wire:click="edit({{ $supplier->id }})">Edit</button>
                    |
                    <button class="btn btn-sm btn-danger"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="delete({{ $supplier->id }})">
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