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
                Add Content
            </button>

            {{-- Modal add Kategori --}}
            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Add Content</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('content.store') }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Judul</label>
                                    <input type="text" name="judul" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="id_kategori" id="" class="form-control">
                                        @foreach ($kategori as $kk)
                                        <option value="{{ $kk['id'] }}">{{ $kk['nama_kategori'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control">
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
            <table id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Keterangan</th>
                        <th>Image</th>
                        <th>Kategori</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach ($content as $cc)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $cc['judul'] }}</td>
                        <td>{{ $cc['keterangan'] }}</td>
                        <td> <img src="{{ asset('storage/' . $cc['image']) }}" alt="" class="" width="150px" height="150px" > </td>
                        <td>
                            @foreach ($kategori as $kk)
                            <?php if($kk['id'] == $cc['id_kategori']){echo $kk['nama_kategori'];} ?>
                            @endforeach
                        </td>
                        <td>{{ $cc['created_at'] }}</td>
                        <td>
                            <div>
                                <form action="{{ route('content.destroy',$cc['id']) }}" method="post" >
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('yakin hapus content?')" class="btn btn-danger mb-2" ><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#default{{ $cc['id'] }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>
                    <div class="modal fade text-left" id="default{{ $cc['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel1">Update Content</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('content.update',$cc['id']) }}" method="POST" enctype="multipart/form-data" >
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Judul</label>
                                            <input type="text" name="judul" value="{{ $cc['judul'] }}" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" id="" cols="30" rows="10">{{ $cc['keterangan'] }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kategori</label>
                                            <select name="id_kategori" id="" class="form-control">
                                                @foreach ($kategori as $kk)
                                                <option <?php if($kk['id'] == $cc['id_kategori']){echo 'selected';} ?>
                                                value="{{ $kk['id'] }}">{{ $kk['nama_kategori'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" class="form-control">
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
                    @endforeach

                </tbody>
            </table>
        </div>
        {{-- end card-bodu --}}
    </div>
@endsection
