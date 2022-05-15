<x-admin-master>
    @section('content')
        <h1>User Profile: {{ $user->name }}</h1>

        <div class="row">
            <div class="col-sm-6">

                <form action="{{ route('user.profile.update', $user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <img height="50" class="img-profile rounded-circle mb-4" src="{{ asset($user->avatar) }}">
                    </div>

                    <div class="form-group">
                        <input type="file" id="avatar" name="avatar" />
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username"
                            class="form-control @error('username') is-invalid @enderror" value="{{ $user->username }}" />

                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ $user->name }}" />

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            value="{{ $user->email }}" />

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" />

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" />
                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary" />

                </form>

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->slug }}</td>
                                            <td>
                                                @if (!$user->userHasRole($role->name))
                                                    <form action="{{ route('user.role.attach', $user) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                        <button class="btn btn-primary">Attach</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->userHasRole($role->name))
                                                    <form action="{{ route('user.role.detach', $user) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                        <button class="btn btn-danger">Detach</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
