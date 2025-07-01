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
            id="confirm_password" placeholder="Password" required autocomplete="current-password" autofocus>
        <div class="input-group-append">
            <span class="input-group-text" style="cursor:pointer;" onclick="togglePassword('confirm_password', this)"><i class="fas fa-eye"></i></span>
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

@section('js')
<script>
    function togglePassword(id, el) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
            el.querySelector('i').classList.remove('fa-eye');
            el.querySelector('i').classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            el.querySelector('i').classList.remove('fa-eye-slash');
            el.querySelector('i').classList.add('fa-eye');
        }
    }
</script>
@show

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@parent
@stop