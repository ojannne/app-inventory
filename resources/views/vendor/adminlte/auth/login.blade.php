@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    body.login-page,
    body.register-page,
    body.password-reset-page {
        /* Ganti dengan warna atau gambar yang Anda inginkan */
        background: url("https://webpetik.petikjombang.com/static/images/2.jpg") no-repeat center center fixed;
        background-size: cover;
        /* Atau gunakan warna gradasi */
        /* background: linear-gradient(135deg, #4f8cff 0%, #e0e7ff 100%); */
    }

    body.login-page {
        background: url('/images/bg-login.jpg') no-repeat center center fixed;
    }

    body.register-page {
        background: url('/images/bg-login.jpg') no-repeat center center fixed;
    }

    body.password-reset-page {
        background: url('/images/bg-login.jpg') no-repeat center center fixed;
    }

    .login-logo a,
    .register-logo a,
    .password-reset-logo a {
        color: #fff !important;
        font-weight: 900;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7), 0 1px 0 #222;
        opacity: 1 !important;
        filter: none !important;
    }
</style>
@parent
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
@php( $login_url = $login_url ? route($login_url) : '' )
@php( $register_url = $register_url ? route($register_url) : '' )
@php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
@php( $login_url = $login_url ? url($login_url) : '' )
@php( $register_url = $register_url ? url($register_url) : '' )
@php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body')
<form action="{{ $login_url }}" method="post">
    @csrf

    {{-- Email field --}}
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    {{-- Password field --}}
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
            id="login_password" placeholder="{{ __('adminlte::adminlte.password') }}">
        <div class="input-group-append">
            <span class="input-group-text" onclick="togglePassword('login_password', this)"><i class="fas fa-eye"></i></span>
        </div>
    </div>
    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

    {{-- Login field --}}
    <div class="row">
        <div class="col-7">
            <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">
                    {{ __('adminlte::adminlte.remember_me') }}
                </label>
            </div>
        </div>
        <div class="col-5">
            <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                <span class="fas fa-sign-in-alt"></span>
                {{ __('adminlte::adminlte.sign_in') }}
            </button>
        </div>
    </div>
</form>
@stop

@section('auth_footer')
{{-- Password reset link --}}
@if($password_reset_url)
<p class="my-0">
    <a href="{{ $password_reset_url }}">
        {{ __('adminlte::adminlte.i_forgot_my_password') }}
    </a>
</p>
@endif
{{-- Register link --}}
@if($register_url)
<p class="my-0">
    <a href="{{ $register_url }}">
        {{ __('adminlte::adminlte.register_a_new_membership') }}
    </a>
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