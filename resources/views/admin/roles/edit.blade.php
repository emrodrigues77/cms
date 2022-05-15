<x-admin-master>
    @section('content')
        <h1>Edit Role: {{ $role->name }}</h1>

        <form action="{{ route('roles.update', $role) }}" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Role Definition</legend>
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" />
                </div>

                <div class="form-group">
                    <label for="title">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ $role->slug }}" />
                </div>

                <input type="submit" value="Submit" class="btn btn-primary" />

            </fieldset>
        </form>
        <hr />
        <fieldset>
            <legend>Permissions</legend>

            @foreach ($permissions as $permission)
                @if (!$role->permissions->contains($permission))
                    <form action="{{ route('role.permission.attach', $role) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                        <button class="btn btn-primary">Attach</button> {{ $permission->name }}
                    </form>
                @else
                    <form action="{{ route('role.permission.detach', $role) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                        <button class="btn btn-danger">Detach</button> {{ $permission->name }}
                    </form>
                @endif
                <br />
            @endforeach



        </fieldset>
    @endsection

</x-admin-master>
