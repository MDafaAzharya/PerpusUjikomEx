@extends('layouts.app')

@section('css-content')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endsection

@section('content')
<div class="container">
    <h3 class="home-title text-center fw-bold">Library</h3>
    <div class="row mt-3">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                @foreach ($carousel as $item)
                <div class="carousel-item active">
                        <img src="{{ asset('storage/cover/' . $item->cover) }}" class="d-block w-full img-carousel" alt="{{$item->cover}}">
                </div>
                 @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="row mt-5 px-3 px-md-0">
        <h4 class="fw-semibold text-md-start text-center category-title">Browse By Category</h4>
        <div class="d-md-flex justify-content-between">
            <div class="justify-content-md-start text-center mt-1">
                <a href="{{route('home')}}" class="btn-category me-2 @if($kategori == null) active @endif">All</a>
                @foreach ($kategorilist as $item)
                <a href="{{route('home',['kategori' => $item->id])}}" class="btn-category mx-md-2 mx-3 @if($item->id == $kategori) active @endif
                ">{{ $item->kategori }}</a>
                @endforeach
            </div>
            <div class="mt-3 mt-md-0">
                <form action="{{route('home')}}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control search-input" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2" value="{{ request('query') }}" name="query">
                    <div class="input-group-append">
                        <button class="btn search-button" type="submit">Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row ms-3 my-3 gap-4">
        @foreach ($buku as $item)
        <div class="card col-md-3 col-12 p-0 border-0" style="width: 12rem;">
            <a href="{{ route('buku-detail', ['id' => $item->id]) }}" class="book-view">
            <img src="{{ asset('storage/cover/' . $item->cover) }}" class="card-img-top" alt="...">
            <div class="card-body justify-content-center d-flex mt-2 p-0">
                <p class="card-text fw-semibold">{{$item -> judul_buku}}</p>
            </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('js-content')
<script>
    $('.carousel').carousel({
        interval: 2000 // Mengatur interval pindah slide (dalam milidetik), contoh disini setiap 3 detik
    });
</script>
@endsection
