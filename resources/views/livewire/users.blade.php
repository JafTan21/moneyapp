<div>
    <div class="col-md-4">
        <div class="form-group">
            <p>Search:</p>
            <input wire:model.debounce.1000ms="search" type="text" class="form-control">
        </div>
    </div>


    <table class="table mt-3">
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Email</td>
                <td>Role</td>
                <td>Permissions</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)

            <tr>
                <td>
                    {{ $user->id }}
                </td>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->roles?->first()?->name }}
                </td>
                <td>
                    @if ($editId == $user->id)
                    @forelse ($permissions as $permission)
                    <li>
                        <input type="checkbox" value="{{ $permission->name }}" wire:model="checkedPermissions">
                        {{ $permission->name }}
                    </li>
                    @empty
                    @endforelse
                    <a wire:click="save({{ $user->id }})" class="btn btn-success btn-sm">Save</a>
                    @else
                    <ol>
                        @forelse ($user->permissions as $permission)
                        <li>{{ $permission->name }}</li>
                        @empty
                        @endforelse
                    </ol>
                    <a wire:click="edit({{ $user->id }})" class="text-info">Edit</a>
                    @endif

                </td>

                <td>
                    <form class="d-inline" action="{{ route('delete_user') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="text-danger">
                            Delete
                        </button>
                    </form> |
                    <form class="d-inline" action="{{ route('login_to_user') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="text-info">
                            Login
                        </button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>

    </table>
    {{ $users->links() }}
</div>