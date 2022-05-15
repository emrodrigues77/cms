<x-admin-master>
    @section('content')
        <h1>Users</h1>

        @if (Session::has('user-deleted-message'))
            <div class="alert alert-danger">{{ session('user-deleted-message') }}</div>
        @elseif (Session::has('user-created-message'))
            <div class="alert alert-info">{{ session('user-created-message') }}</div>
        @elseif (Session::has('user-updated-message'))
            <div class="alert alert-info">{{ session('user-updated-message') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Avatar</th>
                                <th>E-mail</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><a href="{{ route('user.profile.show', $user) }}">{{ $user->username }}</a></td>
                                    <td>{{ $user->name }}</td>
                                    <td><img height="50" src="{{ $user->avatar }}" height='40' /></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>

                                    <td>
                                        @can('view', $user)
                                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
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
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('js/datatables.js') }}"></script>
    @endsection

</x-admin-master>
