@extends('adminlte::page')

@section('title', 'Profil Pesantren - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Profil Pesantren</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profil Pesantren</li>
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
                <h3 class="card-title">Logo Pesantren</h3>
            </div>
            <div class="card-body text-center">
                @if($pesantren && $pesantren->logo)
                <img src="{{ asset('storage/' . $pesantren->logo) }}"
                    alt="Logo Pesantren" class="img-fluid" style="max-height: 200px;">
                @else
                <div class="text-muted">
                    <i class="fas fa-mosque fa-5x"></i>
                    <p class="mt-2">Logo belum diupload</p>
                </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistik Pesantren</h3>
            </div>
            <div class="card-body">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Santri</span>
                        <span class="info-box-number">{{ $pesantren->jumlah_santri ?? 'Belum diisi' }}</span>
                    </div>
                </div>

                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-user-tie"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Ustadz</span>
                        <span class="info-box-number">{{ $pesantren->jumlah_ustadz ?? 'Belum diisi' }}</span>
                    </div>
                </div>

                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tahun Berdiri</span>
                        <span class="info-box-number">{{ $pesantren->tahun_berdiri ?? 'Belum diisi' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Pesantren</h3>
                <div class="card-tools">
                    <a href="{{ route('pesantren.edit') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit Profil
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($pesantren)
                <div class="row">
                    <div class="col-md-6">
                        <h5><i class="fas fa-mosque text-primary"></i> Nama Pesantren</h5>
                        <p class="text-muted">{{ $pesantren->nama_pesantren }}</p>

                        <h5><i class="fas fa-map-marker-alt text-danger"></i> Alamat</h5>
                        <p class="text-muted">{{ $pesantren->alamat }}</p>

                        <h5><i class="fas fa-phone text-success"></i> Telepon</h5>
                        <p class="text-muted">{{ $pesantren->telepon ?? 'Belum diisi' }}</p>

                        <h5><i class="fas fa-envelope text-info"></i> Email</h5>
                        <p class="text-muted">{{ $pesantren->email ?? 'Belum diisi' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-globe text-warning"></i> Website</h5>
                        <p class="text-muted">
                            @if($pesantren->website)
                            <a href="{{ $pesantren->website }}" target="_blank">{{ $pesantren->website }}</a>
                            @else
                            Belum diisi
                            @endif
                        </p>

                        <h5><i class="fas fa-calendar text-secondary"></i> Tahun Berdiri</h5>
                        <p class="text-muted">{{ $pesantren->tahun_berdiri ?? 'Belum diisi' }}</p>

                        <h5><i class="fas fa-users text-primary"></i> Jumlah Santri</h5>
                        <p class="text-muted">{{ $pesantren->jumlah_santri ?? 'Belum diisi' }} orang</p>

                        <h5><i class="fas fa-user-tie text-success"></i> Jumlah Ustadz</h5>
                        <p class="text-muted">{{ $pesantren->jumlah_ustadz ?? 'Belum diisi' }} orang</p>
                    </div>
                </div>

                @if($pesantren->deskripsi)
                <hr>
                <h5><i class="fas fa-info-circle text-info"></i> Deskripsi</h5>
                <p class="text-muted">{{ $pesantren->deskripsi }}</p>
                @endif

                @if($pesantren->visi)
                <hr>
                <h5><i class="fas fa-eye text-primary"></i> Visi</h5>
                <p class="text-muted">{{ $pesantren->visi }}</p>
                @endif

                @if($pesantren->misi)
                <hr>
                <h5><i class="fas fa-bullseye text-success"></i> Misi</h5>
                <p class="text-muted">{{ $pesantren->misi }}</p>
                @endif
                @else
                <div class="text-center text-muted">
                    <i class="fas fa-mosque fa-3x mb-3"></i>
                    <h5>Profil Pesantren Belum Diisi</h5>
                    <p>Silakan lengkapi informasi profil pesantren terlebih dahulu.</p>
                    <a href="{{ route('pesantren.edit') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Profil
                    </a>
                </div>
                @endif
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

    .card-body h5 {
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }

    .card-body h5:first-child {
        margin-top: 0;
    }
</style>
@stop