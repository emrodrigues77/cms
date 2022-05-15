<x-admin-master>
    @section('content')
        <h1>All Posts</h1>

        @if (Session::has('post-deleted-message'))
            <div class="alert alert-danger">{{ session('post-deleted-message') }}</div>
        @elseif (Session::has('post-created-message'))
            <div class="alert alert-info">{{ session('post-created-message') }}</div>
        @elseif (Session::has('post-updated-message'))
            <div class="alert alert-info">{{ session('post-updated-message') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Posts</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>User</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>User</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td><a href="{{ route('post.edit', $post) }}">{{ $post->title }}</a></td>
                                    <td><img height="50" src="{{ $post->post_image }}" height='40' /></td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->updated_at }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        @can('view', $post)
                                            <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{ $posts->links() }}
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('js/datatables.js') }}"></script>
    @endsection

</x-admin-master>
