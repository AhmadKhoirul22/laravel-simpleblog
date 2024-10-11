@extends('layout.template')
@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Menampilkan notifikasi sukses --}}
            @if(session('notifikasi'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('notifikasi') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <button type="button" class="btn btn-outline-primary block mb-3" data-bs-toggle="modal" data-bs-target="#default">
                Add User
            </button>

            {{-- Modal add user --}}
            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Add User</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    {{-- @error('name') --}}
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    {{-- @error('username') --}}

                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control">
                                </div>
                                <div class="mb-3">
                                    {{-- @error('email') --}}

                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    {{-- @error('password') --}}

                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Submit</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End modal add user --}}
            <table class="table" id="table1" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                     @foreach ($user as $uu)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $uu['name'] }}</td>
                        <td>{{ $uu['username'] }}</td>
                        <td>{{ $uu['email'] }}</td>
                        <td>
                            <?php if(Auth::id() != $uu['id']){ ?>
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#default{{ $uu['id'] }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <div class="">
                                <form action="{{ route('user.destroy',$uu['id']) }}" method="post" >
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('yakin hapus user?')" ><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                            <?php } ?>
                        </td>
                    </tr>
                    {{-- Modal add user --}}
            <div class="modal fade text-left" id="default{{ $uu['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Update User</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('user.update',$uu['id']) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" value="{{ $uu['name'] }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" value="{{ $uu['username'] }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ $uu['email'] }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" value="{{ $uu['password'] }}" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Submit</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End modal add user --}}
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
