<x-admin-master>
    @section('content')
        <h1>Edit Role: {{ $permission->name }}</h1>

        <form action="{{ route('permissions.update', $permission) }}" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Permission Definition</legend>
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}" />
                </div>

                <div class="form-group">
                    <label for="title">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ $permission->slug }}" />
                </div>

                <input type="submit" value="Submit" class="btn btn-primary" />

            </fieldset>
        </form>
    @endsection

</x-admin-master>
