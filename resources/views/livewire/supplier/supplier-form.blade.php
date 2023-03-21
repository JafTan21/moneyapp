<div>
    @include('inc.success_error')

    <x-custom-input model="contact" label="Contact" />
    {{-- <x-custom-input model="company" label="Company" /> --}}
    <x-custom-input model="mobile" label="Mobile" />
    {{-- <x-custom-input model="email" label="email" /> --}}

    {{-- <x-custom-input model="bill" label="Bill" type="number" />
    <x-custom-input model="balance" label="Balance" type="number" /> --}}
    <x-custom-input model="payment" label="Payment" type="number" />

    {{-- <div class="form-group mt-3">
        <p>Product</p>
        <select wire:model="material_id">
            <option value="0">-- Select --</option>
            @forelse (\App\Models\Material::select('id','material_name')->get() as $material)
            <option value="{{ $material->id }}">{{ $material->material_name }}</option>
    @empty
    @endforelse
    </select>
</div> --}}

<button class="btn btn-success" wire:click="save">
    Save
</button>


</div>