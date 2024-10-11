@extends('layout2.template')
@section('content')
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>This is Content</h1>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @foreach ($content as $cc)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="{{ asset('storage/' . $cc['image']) }}" class="img-thumbnail rounded-top" height="300px" width="300px" alt="">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"></div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>{{ $cc['judul'] }}</h4>
                                            <p>{{ $cc['keterangan'] }}</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">
                                                    @foreach ($kategori as $kk)
                                                    <?php if($kk['id'] == $cc['id_kategori']){
                                                        echo $kk['nama_kategori'];
                                                    } ?>
                                                    @endforeach
                                                </p>
                                                <a href="{{ route('detail_konten',$cc['id']) }}" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="bi bi-detail me-2"></i>Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
