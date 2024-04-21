@extends('layouts.app')

@section('css-content')
    <link rel="stylesheet" href="{{ asset('assets/css/user/member.css') }}">
@endsection

@section('content')
    <div class="container mt-md-4 col-md-7">
        <h4 class="fw-bold text-center title-member mb-3">Daftar Member</h4>
        <form action="{{route('member-store')}}">
        @csrf
            <div class="mb-3 mx-auto">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama">
            </div>
            <div class="mb-3 mx-auto">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="mb-3 mx-auto">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3 mx-auto">
                <label class="form-label">No Telepon</label>
                <input type="text" class="form-control" name="no_telepon">
            </div>
            <div class="mb-3 mx-auto">
                <label class="form-label">Alamat Rumah</label>
                <input type="text" class="form-control" name="alamat">
            </div>
            <input type="hidden" value="{{$user_id}}" name="user_id">
            @if ( auth()->user()->status == 'member')
                <button class="btn btn-submit ms-auto px-4 d-flex" disabled>Anda Sudah Daftar Member</button>
            @else
            <button class="btn btn-submit ms-auto px-4 d-flex "> Daftar </button>
            @endif
        </form>
    </div>
@endsection