@extends('adminlte::auth.login')
@section('title','Login - Inventory Pesantren')

@section('auth_header', 'Inventory Pesantren')
@section('auth_body')
<p class="login-box-msg">Masuk untuk mengakses sistem</p>

@if ($errors->any())
<div class="alert alert-danger">
    <i class="fas fa-exclamation-triangle mr-2"></i>
    <strong>Login gagal!</strong>
    <ul class="mt-2 mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('login') }}">
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

    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
            placeholder="Password" required autocomplete="current-password">
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
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">
                    Ingat Saya
                </label>
            </div>
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </div>
    </div>
</form>

@if (Route::has('password.request'))
<p class="mb-1">
    <a href="{{ route('password.request') }}">Lupa password?</a>
</p>
@endif

<p class="mb-0">
    <a href="{{ route('register') }}" class="text-center">Daftar akun baru</a>
</p>
@stop