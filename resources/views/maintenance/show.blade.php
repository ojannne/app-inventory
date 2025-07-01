@extends('adminlte::page')

@section('title', 'Detail Maintenance - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Detail Maintenance</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('maintenance.index') }}">Maintenance</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">Informasi Maintenance</h3>
                <div class="card-tools">
                    <a href="{{ route('maintenance.edit', $maintenance->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('maintenance.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Aset</strong></td>
                                <td width="60%">
                                    <strong>{{ $maintenance->aset->nama_aset }}</strong><br>
                                    <small class="text-muted">{{ $maintenance->aset->kode_aset }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Kategori Aset</strong></td>
                                <td>
                                    <span class="badge badge-secondary">{{ $maintenance->aset->kategori->nama_kategori }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Maintenance</strong></td>
                                <td>{{ \Carbon\Carbon::parse($maintenance->tanggal_maintenance)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Maintenance</strong></td>
                                <td>
                                    <span class="badge badge-info">{{ $maintenance->jenis_maintenance }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>
                                    @if($maintenance->status == 'Selesai')
                                    <span class="badge badge-success">{{ $maintenance->status }}</span>
                                    @elseif($maintenance->status == 'Dalam Proses')
                                    <span class="badge badge-warning">{{ $maintenance->status }}</span>
                                    @else
                                    <span class="badge badge-secondary">{{ $maintenance->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Biaya</strong></td>
                                <td width="60%">
                                    @if($maintenance->biaya)
                                    <span class="text-success font-weight-bold">Rp {{ number_format($maintenance->biaya, 0, ',', '.') }}</span>
                                    @else
                                    <span class="text-muted">Tidak ada biaya</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Teknisi</strong></td>
                                <td>{{ $maintenance->teknisi ?: 'Tidak ditentukan' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Dibuat</strong></td>
                                <td>{{ $maintenance->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Diupdate</strong></td>
                                <td>{{ $maintenance->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><strong>Deskripsi Maintenance:</strong></label>
                            <div class="border rounded p-3 bg-light">
                                {{ $maintenance->deskripsi }}
                            </div>
                        </div>
                    </div>
                </div>

                @if($maintenance->catatan)
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><strong>Catatan:</strong></label>
                            <div class="border rounded p-3 bg-light">
                                {{ $maintenance->catatan }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <p><strong>Diinput oleh:</strong> {{ $maintenance->creator ? $maintenance->creator->name : '-' }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Informasi Aset -->
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title">Informasi Aset</h3>
            </div>
            <div class="card-body">
                <div class="info-box bg-primary">
                    <span class="info-box-icon"><i class="fas fa-box"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Nama Aset</span>
                        <span class="info-box-number">{{ $maintenance->aset->nama_aset }}</span>
                    </div>
                </div>

                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Kode Aset</span>
                        <span class="info-box-number">{{ $maintenance->aset->kode_aset }}</span>
                    </div>
                </div>

                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-layer-group"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Kategori</span>
                        <span class="info-box-number">{{ $maintenance->aset->kategori->nama_kategori }}</span>
                    </div>
                </div>

                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-info-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Kondisi</span>
                        <span class="info-box-number">{{ $maintenance->aset->kondisi }}</span>
                    </div>
                </div>

                <div class="info-box bg-secondary">
                    <span class="info-box-icon"><i class="fas fa-check-double"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Status Aset</span>
                        <span class="info-box-number">{{ $maintenance->aset->status }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title">Aksi Cepat</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('aset.show', $maintenance->aset->id) }}" class="btn btn-info btn-block mb-2">
                    <i class="fas fa-eye"></i> Lihat Detail Aset
                </a>
                <a href="{{ route('maintenance.create', ['aset_id' => $maintenance->aset->id]) }}" class="btn btn-success btn-block mb-2">
                    <i class="fas fa-plus"></i> Tambah Maintenance Baru
                </a>
                <a href="{{ route('aset.edit', $maintenance->aset->id) }}" class="btn btn-warning btn-block">
                    <i class="fas fa-edit"></i> Edit Aset
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .table-borderless td {
        border: none;
        padding: 0.5rem 0;
    }
</style>
@stop