@extends('Dashboard.layouts.app')

@section('css-content')
    <link rel="stylesheet" href="{{ asset('assets/css/petugas/dashboard.css') }}">
@endsection

@section('content')
    <div class="my-3 px-5">
        <h3 class="fw-semibold title-page">Dashboard</h3>
        <hr class="line border border-2 rounded-bg opacity-100">
    </div>
    <div class="col-md-3 mx-5">
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title fs-semibold"><i class="fa-solid fa-book"></i> Data Buku</h5>
                <a href="{{ route('databuku-petugas') }}" class="card-link d-md-flex mt-3 justify-content-end">go to data buku <i class="fa-solid fa-arrow-right pt-1"></i></a>
            </div>
        </div>
    </div>
@endsection