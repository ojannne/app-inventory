@extends('adminlte::page')
@section('title','Dashboard - Inventory Pesantren')

@section('content_header')
<h1>Dashboard Inventory Pesantren</h1>
@stop

@section('content')
<div class="row">
    <!-- Total Aset -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format($totalAset) }}</h3>
                <p>Total Aset</p>
            </div>
            <div class="icon">
                <i class="fas fa-boxes"></i>
            </div>
            <a href="{{ route('aset.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Kategori -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format($totalKategori) }}</h3>
                <p>Kategori Aset</p>
            </div>
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
            <a href="{{ route('kategori.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Maintenance -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format($totalMaintenance) }}</h3>
                <p>Maintenance</p>
            </div>
            <div class="icon">
                <i class="fas fa-wrench"></i>
            </div>
            <a href="{{ route('maintenance.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Nilai Aset -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Rp {{ number_format($totalNilaiAset, 0, ',', '.') }}</h3>
                <p>Total Nilai Aset</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <a href="{{ route('aset.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Status Aset -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Status Aset</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fas fa-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tersedia</span>
                                <span class="info-box-number">{{ $asetTersedia }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fas fa-tools"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Maintenance</span>
                                <span class="info-box-number">{{ $asetMaintenance }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="fas fa-times"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Rusak</span>
                                <span class="info-box-number">{{ $asetRusak }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fas fa-handshake"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Dipinjam</span>
                                <span class="info-box-number">{{ $asetDipinjam }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aset Terbaru -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Aset Terbaru</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAsets as $aset)
                            <tr>
                                <td>{{ $aset->kode_aset }}</td>
                                <td>{{ $aset->nama_aset }}</td>
                                <td>{{ $aset->kategori->nama_kategori }}</td>
                                <td>
                                    @if($aset->status == 'tersedia')
                                    <span class="badge badge-success">Tersedia</span>
                                    @elseif($aset->status == 'maintenance')
                                    <span class="badge badge-warning">Maintenance</span>
                                    @elseif($aset->status == 'rusak')
                                    <span class="badge badge-danger">Rusak</span>
                                    @else
                                    <span class="badge badge-info">Dipinjam</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada aset</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Maintenance Terbaru -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Maintenance Terbaru</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Aset</th>
                                <th>Jenis</th>
                                <th>Tanggal</th>
                                <th>Teknisi</th>
                                <th>Biaya</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentMaintenance as $maintenance)
                            <tr>
                                <td>{{ $maintenance->aset->nama_aset }}</td>
                                <td>{{ ucfirst($maintenance->jenis_maintenance) }}</td>
                                <td>{{ $maintenance->tanggal_maintenance->format('d/m/Y') }}</td>
                                <td>{{ $maintenance->teknisi }}</td>
                                <td>Rp {{ number_format($maintenance->biaya, 0, ',', '.') }}</td>
                                <td>
                                    @if($maintenance->status == 'pending')
                                    <span class="badge badge-secondary">Pending</span>
                                    @elseif($maintenance->status == 'proses')
                                    <span class="badge badge-warning">Proses</span>
                                    @elseif($maintenance->status == 'selesai')
                                    <span class="badge badge-success">Selesai</span>
                                    @else
                                    <span class="badge badge-danger">Dibatalkan</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada maintenance</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Dashboard Inventory Pesantren Loaded!');
</script>
@stop