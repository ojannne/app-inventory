@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
@php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
@php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
@stack('css')
@yield('css')
<style>
    body.login-page,
    body.register-page,
    body.password-reset-page {
        background: url("https://webpetik.petikjombang.com/static/images/2.jpg") no-repeat center center fixed;
        background-size: cover;
        position: relative;
    }

    body.login-page::before,
    body.register-page::before,
    body.password-reset-page::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.45);
        /* Opacity 45% hitam */
        z-index: 0;
        pointer-events: none;
    }

    .login-box,
    .register-box,
    .password-reset-box {
        position: relative;
        z-index: 1;
    }

    .login-logo,
    .register-logo,
    .password-reset-logo {
        color: #fff !important;
        font-weight: 900;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7), 0 1px 0 #222;
        opacity: 1 !important;
        filter: none !important;
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

    .card {
        border-radius: 18px !important;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18) !important;
        background: rgba(255, 255, 255, 0.92) !important;
        border: none !important;
    }

    .card-header,
    .card-footer {
        background: transparent !important;
        border: none !important;
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #222;
        letter-spacing: 1px;
    }

    .form-control {
        border-radius: 12px !important;
        font-size: 1.08rem;
        padding: 0.75rem 1rem;
        border: 1.5px solid #e0e7ef;
        background: #f8fafc;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        border-color: #4f8cff;
        background: #fff;
        box-shadow: 0 0 0 2px #4f8cff22;
    }

    .input-group-text {
        border-radius: 12px !important;
        background: #f0f4fa;
        border: 1.5px solid #e0e7ef;
        color: #4f8cff;
        font-size: 1.1rem;
    }

    .btn-primary,
    .btn-block {
        border-radius: 12px !important;
        font-weight: 700;
        font-size: 1.08rem;
        padding: 0.7rem 0;
        box-shadow: 0 2px 8px 0 rgba(31, 38, 135, 0.10);
        transition: background 0.2s, box-shadow 0.2s;
    }

    .btn-primary:hover,
    .btn-block:hover {
        background: #2563eb !important;
        box-shadow: 0 4px 16px 0 rgba(31, 38, 135, 0.18);
    }

    .alert {
        border-radius: 10px;
        font-size: 1rem;
    }

    .icheck-primary label {
        font-size: 1.05rem;
    }

    .login-box,
    .register-box,
    .password-reset-box {
        margin-top: 3.5vh;
    }

    @media (max-width: 600px) {

        .login-box,
        .register-box,
        .password-reset-box {
            width: 98vw !important;
            margin: 1vw auto;
        }

        .card {
            padding: 0.5rem;
        }
    }
</style>
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

@section('body')
<div class="{{ $auth_type ?? 'login' }}-box">

    {{-- Logo --}}
    <div class="{{ $auth_type ?? 'login' }}-logo">
        <a href="{{ $dashboard_url }}">

            {{-- Logo Image --}}
            @if (config('adminlte.auth_logo.enabled', false))
            <img src="{{ asset(config('adminlte.auth_logo.img.path')) }}"
                alt="{{ config('adminlte.auth_logo.img.alt') }}"
                @if (config('adminlte.auth_logo.img.class', null))
                class="{{ config('adminlte.auth_logo.img.class') }}"
                @endif
                @if (config('adminlte.auth_logo.img.width', null))
                width="{{ config('adminlte.auth_logo.img.width') }}"
                @endif
                @if (config('adminlte.auth_logo.img.height', null))
                height="{{ config('adminlte.auth_logo.img.height') }}"
                @endif>
            @else
            <img src="{{ asset(config('adminlte.logo_img')) }}"
                alt="{{ config('adminlte.logo_img_alt') }}" height="50">
            @endif

            {{-- Logo Label --}}
            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}

        </a>
    </div>

    {{-- Card Box --}}
    <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">

        {{-- Card Header --}}
        @hasSection('auth_header')
        <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
            <h3 class="card-title float-none text-center">
                @yield('auth_header')
            </h3>
        </div>
        @endif

        {{-- Card Body --}}
        <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
            @yield('auth_body')
        </div>

        {{-- Card Footer --}}
        @hasSection('auth_footer')
        <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
            @yield('auth_footer')
        </div>
        @endif

    </div>

</div>
@stop

@section('adminlte_js')
@stack('js')
@yield('js')
@stop