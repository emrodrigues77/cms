<x-admin-master>
    @section('content')
        <h1>Roles</h1>

        @if (Session::has('role-deleted-message'))
            <div class="alert alert-danger">{{ session('role-deleted-message') }}</div>
        @elseif (Session::has('role-created-message'))
            <div class="alert alert-info">{{ session('role-created-message') }}</div>
        @elseif (Session::has('role-updated-message'))
            <div class="alert alert-info">{{ session('role-updated-message') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Roles</h6>
                <form action="{{ route('roles.create') }}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary">Add New</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Users</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Users</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td><a href="{{ route('roles.edit', $role) }}">{{ $role->name }}</a></td>
                                    <td>{{ $role->slug }}</td>
                                    <td>{{ $role->users_count }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>{{ $role->updated_at }}</td>
                                    <td></td>
                                    <td>
                                        @can('delete', $role)
                                            @if ($role->users_count == 0)
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @endif
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
