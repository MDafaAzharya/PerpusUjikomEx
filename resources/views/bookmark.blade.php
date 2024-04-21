@extends('layouts.app')

@section('css-content')
    <link rel="stylesheet" href="{{ asset('assets/css/user/bookmark.css') }}">
@endsection

@section('content')
    <div class="container mt-3">
        <h3 class="fw-bold title-bookmark text-center"> Bookmark </h3>
        <div class="mt-4">
            <h5 class="fw-semibold ">Your Book</h5>
            <hr class="line border border-1 rounded-bg opacity-100 rounded-5 mt-0">
        </div>
        <div class="row ms-3 my-5 gap-4">
        @foreach ($buku as $item)
        <div class="card col-md-3 col-12 p-0 border-0" style="width: 12rem;">
            <a href="{{ route('buku-detail', ['id' => $item->buku->id]) }}" class="book-view">
            <img src="{{ asset('storage/cover/' . $item->buku->cover) }}" class="card-img-top" alt="...">
            <div class="card-body justify-content-center d-flex mt-2 p-0">
                <p class="card-text fw-semibold">{{$item ->buku->judul_buku}}</p>
            </div>
            </a>
        </div>
        @endforeach
    </div>
    </div>
@endsection