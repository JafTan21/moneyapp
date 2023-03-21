<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-scroll bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="row">
            <div class="col-md-5 mt-4">
                <b>Profile info</b>
                <hr>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form action="{{ route('update_profile') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="form-group mt-3">
                        <span>Name</span>
                        <input required name="name" value="{{ auth()->user()->name }}" type="text" class="form-control">
                    </div>


                    <div class="form-group mt-3">
                        <span>Email</span>
                        <input required name="email" value="{{ auth()->user()->email }}" type="text"
                            class="form-control">
                    </div>



                    <div class="form-group mt-3">
                        <span>Password</span>
                        <input required name="password" type="password" class="form-control">
                    </div>

                    <button class="btn btn-success mt-5">Save</button>
                </form>
            </div>
            <div class="col-md-5 mt-4">
                <b>Change password</b>
                <hr>

                @if (Session::has('password_error'))
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    <li>{{ Session::get('password_error') }}</li>
                </ul>
                @endif

                <form action="{{ route('change_password') }}" method="POST">
                    @csrf

                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="form-group mt-3">
                        <span>Old password</span>
                        <input required name="old_password" type="text" class="form-control">
                    </div>


                    <div class="form-group mt-3">
                        <span>New password</span>
                        <input required name="new_password" type="text" class="form-control">
                    </div>


                    <div class="form-group mt-3">
                        <span>Confirm password</span>
                        <input required name="confirm_password" type="text" class="form-control">
                    </div>

                    <button class="btn btn-success mt-5">Save</button>


                </form>

            </div>
        </div>
    </div>
</x-app-layout>