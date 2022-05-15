<x-admin-master>
    @section('content')
        <h1>Create</h1>

        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" />
            </div>

            <div class="form-group">
                <label for="file">File</label>
                <input type="file" name="post_image" id="post_image" class="form-control-file" accept=".jpg,.png" />
            </div>

            <div class="form-group">
                <textarea name="body" id="body" cols="30" rows="10" class='form-control'></textarea>
            </div>

            <input type="submit" value="Submit" class="btn btn-primary" />

        </form>
    @endsection

</x-admin-master>
