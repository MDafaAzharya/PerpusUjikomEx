@extends('layouts.app')

@section('css-content')
    <link rel="stylesheet" href="{{ asset('assets/css/user/detail-buku.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('content')
    <div class="container my-3">
        <div class="row mx-md-5">
            <div class="justify-content-md-start d-md-flex">
                <div class="img-cont">
                    <img src="{{ asset('storage/cover/' . $buku->cover) }}" alt="" srcset="" class="cover-book">
                </div>
                <div class="ket-buku ms-md-3 mt-3 ">
                    <h3 class="fw-bold title-book">{{$buku->judul_buku}}</h3>
                    <h5 class="fw-semibold">{{ $buku->change_kategori->kategori }}</h5>
                    <div class="reading">
                        <a href="{{ route('buku-pdf', ['id' => $buku->id]) }}" class="btn-reading px-5 py-2 fw-semibold ">Start Reading</a>
                        @if ($bookmark)
                            <button class="btn-bookmark px-3 py-2 fw-bold ms-2 btn-remove" data-id="{{ $buku->id }}">Remove from Bookmark</button>
                        @else
                            <a href="{{ route('bookmark-store', ['id' => $buku->id]) }}" class="btn-bookmark px-3 py-2 fw-bold ms-2" >Add to Bookmark</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-md-5">
            <hr class="line border border-2 rounded-bg opacity-100 rounded-5 mt-md-4">
            <h4 class="fw-semibold pt-3 sinopsis-title"> Sinopsis </h4>
            <hr class="line border border-2 rounded-bg opacity-100 rounded-5 m-0 p-0 col-1">
            <p class="text">{!! $buku->deskripsi !!}</p>
        </div>
        <div class="komentar mx-md-5">
            <div>
                <h4 class="fw-semibold pt-3 sinopsis-title"> Komentar </h4>
                <hr class="line border border-2 rounded-bg opacity-100 rounded-5 m-0 p-0 col-1">
            </div>
            <div class="my-3">
                <form action="{{route('komentar-store')}}">
                <div class="input-group mb-3">
                        <input type="hidden" value="{{$buku->id}}" name="id_buku">
                        <input type="hidden" value="{{$user}}" name="id_user">
                        <input type="text" class="form-control search-input " name="komentar" placeholder="Your Comment" aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn komentar-button py-2" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            @if ($komentar->count() > 0)
            @foreach ($komentar as $item)
                <div class="text-komentar mt-3 mb-2">
                    <p class="fw-semibold fs-5 m-0 p-0"> {{ $item->change_user->name }} </p>
                    <p class="fw-normal">{{ $item->komentar }}</p>
                </div>
            @endforeach
            @else
                <div class="text-komentar mt-3 mb-2">
                    <p class="fw-semibold fs-5 m-0 p-0"> Belum ada komentar </p>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js-content')
<script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        $(document).delegate('.btn-remove', 'click', function() {
            const id = $(this).data('id');
            Swal.fire({
                title: "Hapus Data ?",
                text: "Apakah anda yakin akan remove buku ?",
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus',
                icon: 'question'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('bookmark-destroy') }}" + id,
                        type: 'get',
                        data: {
                            _token: `{{ csrf_token() }}`,
                            id
                        },
                        success: function(resp) {
                            return Swal.fire('Berhasil !', 'Data berhasil dihapus', 'success')
                                .then(() => location.reload());
                        },
                        error: function(err) {
                            const errorResp = JSON.parse(err.responseText);
                            return Swal.fire('Gagal !',
                                `Data gagal dihapus: ${errorResp.message}`, 'error');
                        }
                    })
                }
            })
        })
    </script>
@endsection