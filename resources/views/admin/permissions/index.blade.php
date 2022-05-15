<x-admin-master>
    @section('content')
        <h1>Permissions</h1>

        @if (Session::has('permission-deleted-message'))
            <div class="alert alert-danger">{{ session('permission-deleted-message') }}</div>
        @elseif (Session::has('permission-created-message'))
            <div class="alert alert-info">{{ session('permission-created-message') }}</div>
        @elseif (Session::has('permission-updated-message'))
            <div class="alert alert-info">{{ session('permission-updated-message') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Permissions</h6>
                <form action="{{ route('permissions.create') }}" method="get">
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
                                <th>Roles</th>
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
                                <th>Roles</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td><a
                                            href="{{ route('permissions.edit', $permission) }}">{{ $permission->name }}</a>
                                    </td>
                                    <td>{{ $permission->slug }}</td>
                                    <td>{{ $permission->roles_count }}</td>
                                    <td>{{ $permission->created_at }}</td>
                                    <td>{{ $permission->updated_at }}</td>
                                    <td></td>
                                    <td>
                                        @can('delete', $permission)
                                            @if ($permission->roles_count == 0)
                                                <form action="{{ route('permissions.destroy', $permission->id) }}"
                                                    method="post">
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
