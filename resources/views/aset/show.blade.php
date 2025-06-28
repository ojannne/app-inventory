@extends('adminlte::page')

@section('title', 'Detail Aset - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Detail Aset</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('aset.index') }}">Aset</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Informasi Aset</h3>
                <div class="card-tools">
                    <a href="{{ route('aset.edit', $aset->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('aset.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Kode Aset</strong></td>
                                <td width="60%">
                                    <span class="badge badge-info">{{ $aset->kode_aset }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nama Aset</strong></td>
                                <td>{{ $aset->nama_aset }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kategori</strong></td>
                                <td>
                                    <span class="badge badge-secondary">{{ $aset->kategori->nama_kategori }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi</strong></td>
                                <td>{{ $aset->deskripsi ?: 'Tidak ada deskripsi' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi</strong></td>
                                <td>{{ $aset->lokasi ?: 'Tidak ditentukan' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Tanggal Pembelian</strong></td>
                                <td width="60%">
                                    {{ $aset->tanggal_pembelian ? \Carbon\Carbon::parse($aset->tanggal_pembelian)->format('d/m/Y') : 'Tidak diketahui' }}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Harga</strong></td>
                                <td>
                                    {{ $aset->harga ? 'Rp ' . number_format($aset->harga, 0, ',', '.') : 'Tidak diketahui' }}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Kondisi</strong></td>
                                <td>
                                    @if($aset->kondisi == 'Baik')
                                    <span class="badge badge-success">{{ $aset->kondisi }}</span>
                                    @elseif($aset->kondisi == 'Rusak Ringan')
                                    <span class="badge badge-warning">{{ $aset->kondisi }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ $aset->kondisi }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>
                                    @if($aset->status == 'Tersedia')
                                    <span class="badge badge-success">{{ $aset->status }}</span>
                                    @elseif($aset->status == 'Dipinjam')
                                    <span class="badge badge-info">{{ $aset->status }}</span>
                                    @else
                                    <span class="badge badge-secondary">{{ $aset->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Dibuat</strong></td>
                                <td>{{ $aset->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Diupdate</strong></td>
                                <td>{{ $aset->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Maintenance -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">Riwayat Maintenance</h3>
                <div class="card-tools">
                    <a href="{{ route('maintenance.create', ['aset_id' => $aset->id]) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-plus"></i> Tambah Maintenance
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($aset->maintenances->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aset->maintenances as $maintenance)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($maintenance->tanggal_maintenance)->format('d/m/Y') }}</td>
                                <td>{{ $maintenance->jenis_maintenance }}</td>
                                <td>{{ Str::limit($maintenance->deskripsi, 50) }}</td>
                                <td>
                                    @if($maintenance->status == 'Selesai')
                                    <span class="badge badge-success">{{ $maintenance->status }}</span>
                                    @elseif($maintenance->status == 'Dalam Proses')
                                    <span class="badge badge-warning">{{ $maintenance->status }}</span>
                                    @else
                                    <span class="badge badge-secondary">{{ $maintenance->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $maintenance->biaya ? 'Rp ' . number_format($maintenance->biaya, 0, ',', '.') : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted text-center">Belum ada riwayat maintenance untuk aset ini.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Gambar Aset -->
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title">Gambar Aset</h3>
            </div>
            <div class="card-body text-center">
                @if($aset->gambar)
                <img src="{{ asset('storage/' . $aset->gambar) }}"
                    alt="Gambar {{ $aset->nama_aset }}"
                    class="img-fluid rounded"
                    style="max-height: 300px;">
                @else
                <div class="text-muted">
                    <i class="fas fa-image fa-5x mb-3"></i>
                    <p>Tidak ada gambar</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Statistik Aset -->
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title">Statistik</h3>
            </div>
            <div class="card-body">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-tools"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Maintenance</span>
                        <span class="info-box-number">{{ $aset->maintenances->count() }}</span>
                    </div>
                </div>

                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Maintenance Selesai</span>
                        <span class="info-box-number">{{ $aset->maintenances->where('status', 'Selesai')->count() }}</span>
                    </div>
                </div>

                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Dalam Proses</span>
                        <span class="info-box-number">{{ $aset->maintenances->where('status', 'Dalam Proses')->count() }}</span>
                    </div>
                </div>
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