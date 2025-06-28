@extends('adminlte::auth.passwords.email')
@section('title','Reset Password - Inventory Pesantren')

@section('auth_header', 'Inventory Pesantren')
@section('auth_body')
<p class="login-box-msg">Masukkan email untuk reset password</p>

@if (session('status'))
<div class="alert alert-success" role="alert">
    <i class="fas fa-check-circle mr-2"></i>
    {{ session('status') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <i class="fas fa-exclamation-triangle mr-2"></i>
    <strong>Reset password gagal!</strong>
    <ul class="mt-2 mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Kirim Link Reset Password</button>
        </div>
    </div>
</form>

<p class="mt-3 mb-1">
    <a href="{{ route('login') }}">Kembali ke Login</a>
</p>

<p class="mb-0">
    <a href="{{ route('register') }}" class="text-center">Daftar akun baru</a>
</p>
@stop