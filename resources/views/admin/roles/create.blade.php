<x-admin-master>
    @section('content')
        <h1>Edit</h1>

        <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" name="name" id="name" class="form-control" />
            </div>

            <div class="form-group">
                <label for="title">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" />
            </div>


            <input type="submit" value="Save" class="btn btn-primary" />

        </form>
    @endsection

</x-admin-master>
