@extends('adminlte::page')

@section('title', 'Profil Saya - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Profil Saya</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profil Saya</li>
        </ol>
    </div>
</div>
@stop

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Profil</h3>
            </div>
            <div class="card-body text-center">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <i class="fas fa-user-circle fa-4x text-primary"></i>
                    </div>
                    <div class="info ml-3">
                        <h5 class="mb-0">{{ $user->name }}</h5>
                        <p class="text-muted mb-0">{{ $user->email }}</p>
                        <span class="badge badge-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'petugas' ? 'primary' : 'success') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>

                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bergabung Sejak</span>
                        <span class="info-box-number">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>

                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Login Terakhir</span>
                        <span class="info-box-number">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>

                @if($user->email_verified_at)
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> Email terverifikasi
                </div>
                @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> Email belum terverifikasi
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Profil</h3>
            </div>
            <form action="{{ route('user.update-profile') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr>
                    <h5>Ubah Password</h5>
                    <p class="text-muted">Kosongkan jika tidak ingin mengubah password</p>

                    <div class="form-group">
                        <label for="current_password">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                            id="current_password" name="current_password">
                        @error('current_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                            id="new_password" name="new_password">
                        @error('new_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control"
                            id="new_password_confirmation" name="new_password_confirmation">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Aktivitas Terbaru</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div>
                        <i class="fas fa-user bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i> {{ $user->created_at->format('d/m/Y H:i') }}
                            </span>
                            <h3 class="timeline-header">
                                <a href="#">Akun Dibuat</a>
                            </h3>
                            <div class="timeline-body">
                                <p>Akun pengguna berhasil dibuat dengan role {{ ucfirst($user->role) }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <i class="fas fa-edit bg-green"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i> {{ $user->updated_at->format('d/m/Y H:i') }}
                            </span>
                            <h3 class="timeline-header">
                                <a href="#">Profil Diperbarui</a>
                            </h3>
                            <div class="timeline-body">
                                <p>Informasi profil terakhir diperbarui</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .info-box {
        margin-bottom: 1rem;
    }

    .timeline {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .timeline>div {
        position: relative;
        margin-bottom: 30px;
    }

    .timeline>div:before,
    .timeline>div:after {
        content: " ";
        display: table;
    }

    .timeline>div:after {
        clear: both;
    }

    .timeline>div>.timeline-item {
        margin-left: 50px;
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        border-radius: 0.25rem;
        background-color: #fff;
        color: #495057;
        margin-left: 50px;
        margin-top: 0;
        min-height: 60px;
    }

    .timeline>div>i {
        width: 30px;
        height: 30px;
        font-size: 15px;
        line-height: 30px;
        position: absolute;
        color: #fff;
        background: #6c757d;
        border-radius: 50%;
        text-align: center;
        left: 18px;
        top: 0;
    }

    .timeline>div>.timeline-item>.timeline-header {
        color: #495057;
        font-size: 16px;
        line-height: 1.1;
        margin: 0;
        padding: 10px;
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }

    .timeline>div>.timeline-item>.timeline-body,
    .timeline>div>.timeline-item>.timeline-footer {
        padding: 10px;
    }

    .timeline>div>.timeline-item>.timeline-header>a {
        font-weight: 600;
        color: #495057;
    }

    .timeline>div>.timeline-item>.timeline-header>.time {
        color: #999;
        font-size: 13px;
    }
</style>
@stop