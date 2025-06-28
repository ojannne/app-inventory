@extends('adminlte::auth.auth-page')
@section('title','Verifikasi Email - Inventory Pesantren')

@section('auth_header', 'Inventory Pesantren')
@section('auth_body')
<p class="login-box-msg">Verifikasi Email</p>

@if (session('resent'))
<div class="alert alert-success" role="alert">
    <i class="fas fa-check-circle mr-2"></i>
    Link verifikasi baru telah dikirim ke email Anda.
</div>
@endif

<p class="login-box-msg">
    Sebelum melanjutkan, silakan periksa email Anda untuk link verifikasi.
    Jika Anda tidak menerima email tersebut,
</p>

<form method="POST" action="{{ route('verification.resend') }}">
    @csrf
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">
                Kirim Ulang Link Verifikasi
            </button>
        </div>
    </div>
</form>

<p class="mt-3 mb-1">
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
</p>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
@stop