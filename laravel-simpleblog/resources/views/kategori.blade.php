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
                Add Kategori
            </button>

            {{-- Modal add Kategori --}}
            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Add Kategori</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" class="form-control">
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
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                     @foreach ($kategori as $uu)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $uu['nama_kategori'] }}</td>
                        <td>
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#default{{ $uu['id'] }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <div class="">
                                <form action="{{ route('kategori.destroy',$uu['id']) }}" method="post" >
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('yakin hapus user?')" ><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
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
                        <form action="{{ route('kategori.update',$uu['id']) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" value="{{ $uu['nama_kategori'] }}" class="form-control">
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
