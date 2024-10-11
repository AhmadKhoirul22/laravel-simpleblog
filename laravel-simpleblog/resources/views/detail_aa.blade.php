@extends('layout2.template')
@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-3"></div>
            <div class="col-3">
                <img src="{{ asset('storage/'.$content->image) }}" alt="" width="250px" height="250px" >
            </div>
            <div class="col-6">
                <h2>{{ $content->judul }}</h2>
                <p>{{ $content->keterangan }}</p>
                <p>{{ $content->created_at }}</p>
                <p>
                    @foreach ($kategori as $kk)
                    <?php if($kk['id'] == $content->id_kategori){
                    echo $kk['nama_kategori'];
                    } ?>
                    @endforeach
                </p>
            </div>
    </div>
</div>
@endsection
