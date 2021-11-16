<div>
    @include('inc.success_error')

    <x-input model="contact" label="Contact" />
    <x-input model="company" label="Company" />
    <x-input model="mobile" label="Mobile" />
    <x-input model="email" label="email" />

    <div class="form-group mt-3">
        <p>Product</p>
        <textarea wire:model="product">

    </textarea>
    </div>

    <button class="btn btn-success" wire:click="save">
        Save
    </button>


</div>