@extends('adminlte::auth.passwords.confirm')
@section('title','Konfirmasi Password - Inventory Pesantren')

@section('auth_header', 'Inventory Pesantren')
@section('auth_body')
<p class="login-box-msg">Konfirmasi Password</p>

<p class="login-box-msg">Ini adalah area yang aman dari aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan.</p>

@if ($errors->any())
<div class="alert alert-danger">
    <i class="fas fa-exclamation-triangle mr-2"></i>
    <strong>Konfirmasi password gagal!</strong>
    <ul class="mt-2 mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
            placeholder="Password" required autocomplete="current-password" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Konfirmasi Password</button>
        </div>
    </div>
</form>

@if (Route::has('password.request'))
<p class="mt-3 mb-1">
    <a href="{{ route('password.request') }}">Lupa password?</a>
</p>
@endif
@stop