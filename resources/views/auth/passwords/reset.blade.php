@extends('adminlte::auth.passwords.reset')
@section('title','Reset Password - Inventory Pesantren')

@section('auth_header', 'Inventory Pesantren')
@section('auth_body')
<p class="login-box-msg">Reset Password</p>

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

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            placeholder="Email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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

    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
            placeholder="Password Baru" required autocomplete="new-password">
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

    <div class="input-group mb-3">
        <input type="password" name="password_confirmation" class="form-control"
            placeholder="Konfirmasi Password Baru" required autocomplete="new-password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        </div>
    </div>
</form>

<p class="mt-3 mb-1">
    <a href="{{ route('login') }}">Kembali ke Login</a>
</p>
@stop