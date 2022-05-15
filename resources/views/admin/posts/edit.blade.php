<x-admin-master>
    @section('content')
        <h1>Edit</h1>

        <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" />
            </div>

            <div class="form-group">
                <div><img src="{{ $post->post_image }}" height="100px" alt=""></div>
                <label for="file">File</label>
                <input type="file" name="post_image" id="post_image" class="form-control-file" accept=".jpg,.png" />
            </div>

            <div class="form-group">
                <textarea name="body" id="body" cols="30" rows="10" class='form-control'>{{ $post->body }}</textarea>
            </div>

            <input type="submit" value="Submit" class="btn btn-primary" />

        </form>
    @endsection

</x-admin-master>
