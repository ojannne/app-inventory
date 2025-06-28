@extends('adminlte::page')

@section('title', 'Detail Pengguna - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Detail Pengguna</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Pengguna</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Foto Profil</h3>
            </div>
            <div class="card-body text-center">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <i class="fas fa-user-circle fa-5x text-primary"></i>
                    </div>
                    <div class="info ml-3">
                        <h5 class="mb-0">{{ $user->name }}</h5>
                        <p class="text-muted mb-0">{{ $user->email }}</p>
                        <span class="badge badge-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'petugas' ? 'primary' : 'success') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistik</h3>
            </div>
            <div class="card-body">
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
                        <span class="info-box-text">Update Terakhir</span>
                        <span class="info-box-number">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>

                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-user-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Role</span>
                        <span class="info-box-number">{{ ucfirst($user->role) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Pengguna</h3>
                <div class="card-tools">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5><i class="fas fa-user text-primary"></i> Nama Lengkap</h5>
                        <p class="text-muted">{{ $user->name }}</p>

                        <h5><i class="fas fa-envelope text-info"></i> Email</h5>
                        <p class="text-muted">{{ $user->email }}</p>

                        <h5><i class="fas fa-user-tag text-warning"></i> Role</h5>
                        <p class="text-muted">
                            @if($user->role == 'admin')
                            <span class="badge badge-danger">{{ ucfirst($user->role) }}</span>
                            @elseif($user->role == 'petugas')
                            <span class="badge badge-primary">{{ ucfirst($user->role) }}</span>
                            @else
                            <span class="badge badge-success">{{ ucfirst($user->role) }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-calendar text-success"></i> Tanggal Bergabung</h5>
                        <p class="text-muted">{{ $user->created_at->format('d/m/Y H:i') }}</p>

                        <h5><i class="fas fa-clock text-info"></i> Update Terakhir</h5>
                        <p class="text-muted">{{ $user->updated_at->format('d/m/Y H:i') }}</p>

                        <h5><i class="fas fa-check-circle text-success"></i> Status Email</h5>
                        <p class="text-muted">
                            @if($user->email_verified_at)
                            <span class="badge badge-success">Terverifikasi</span>
                            @else
                            <span class="badge badge-warning">Belum Verifikasi</span>
                            @endif
                        </p>
                    </div>
                </div>

                <hr>

                <h5><i class="fas fa-info-circle text-info"></i> Deskripsi Role</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-danger">
                            <div class="card-body text-center">
                                <i class="fas fa-user-shield fa-2x text-white mb-2"></i>
                                <h6 class="text-white">Admin</h6>
                                <small class="text-white-50">Akses Penuh</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-user-cog fa-2x text-white mb-2"></i>
                                <h6 class="text-white">Petugas</h6>
                                <small class="text-white-50">Akses Terbatas</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success">
                            <div class="card-body text-center">
                                <i class="fas fa-user fa-2x text-white mb-2"></i>
                                <h6 class="text-white">Ustadz</h6>
                                <small class="text-white-50">Akses Dasar</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Aktivitas</h3>
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