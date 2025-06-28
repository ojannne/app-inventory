@extends('adminlte::page')

@section('title', 'Laporan - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Dashboard Laporan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Laporan</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<!-- Statistik Umum -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalAset }}</h3>
                <p>Total Aset</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a href="{{ route('laporan.aset') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalKategori }}</h3>
                <p>Total Kategori</p>
            </div>
            <div class="icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <a href="{{ route('laporan.kategori') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalMaintenance }}</h3>
                <p>Total Maintenance</p>
            </div>
            <div class="icon">
                <i class="fas fa-tools"></i>
            </div>
            <a href="{{ route('laporan.maintenance') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Rp {{ number_format($totalNilaiAset, 0, ',', '.') }}</h3>
                <p>Total Nilai Aset</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Statistik Kondisi Aset -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistik Kondisi Aset</h3>
            </div>
            <div class="card-body">
                <div class="progress-group">
                    <span class="progress-text">Kondisi Baik</span>
                    <span class="float-right"><b>{{ $kondisiBaik }}</b>/{{ $totalAset }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: {{ $totalAset > 0 ? ($kondisiBaik / $totalAset) * 100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    <span class="progress-text">Rusak Ringan</span>
                    <span class="float-right"><b>{{ $kondisiRusakRingan }}</b>/{{ $totalAset }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-warning" style="width: {{ $totalAset > 0 ? ($kondisiRusakRingan / $totalAset) * 100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    <span class="progress-text">Rusak Berat</span>
                    <span class="float-right"><b>{{ $kondisiRusakBerat }}</b>/{{ $totalAset }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-danger" style="width: {{ $totalAset > 0 ? ($kondisiRusakBerat / $totalAset) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Status Aset -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistik Status Aset</h3>
            </div>
            <div class="card-body">
                <div class="progress-group">
                    <span class="progress-text">Tersedia</span>
                    <span class="float-right"><b>{{ $statusTersedia }}</b>/{{ $totalAset }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: {{ $totalAset > 0 ? ($statusTersedia / $totalAset) * 100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    <span class="progress-text">Dipinjam</span>
                    <span class="float-right"><b>{{ $statusDipinjam }}</b>/{{ $totalAset }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: {{ $totalAset > 0 ? ($statusDipinjam / $totalAset) * 100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    <span class="progress-text">Maintenance</span>
                    <span class="float-right"><b>{{ $statusMaintenance }}</b>/{{ $totalAset }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-warning" style="width: {{ $totalAset > 0 ? ($statusMaintenance / $totalAset) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Aset Per Kategori -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Aset Per Kategori</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Jumlah Aset</th>
                                <th>Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asetPerKategori as $kategori)
                            <tr>
                                <td>{{ $kategori->nama_kategori }}</td>
                                <td>{{ $kategori->asets_count }}</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{ $totalAset > 0 ? ($kategori->asets_count / $totalAset) * 100 : 0 }}%">
                                            {{ $totalAset > 0 ? round(($kategori->asets_count / $totalAset) * 100, 1) : 0 }}%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Aset</th>
                                <th>Kategori</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asetTerbaru as $aset)
                            <tr>
                                <td>{{ $aset->nama_aset }}</td>
                                <td>{{ $aset->kategori->nama_kategori }}</td>
                                <td>
                                    @if($aset->status == 'Tersedia')
                                    <span class="badge badge-success">{{ $aset->status }}</span>
                                    @elseif($aset->status == 'Dipinjam')
                                    <span class="badge badge-info">{{ $aset->status }}</span>
                                    @else
                                    <span class="badge badge-warning">{{ $aset->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Maintenance Terbaru -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Maintenance Terbaru</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Aset</th>
                                <th>Jenis</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($maintenanceTerbaru as $maintenance)
                            <tr>
                                <td>{{ $maintenance->aset->nama_aset }}</td>
                                <td>{{ $maintenance->jenis_maintenance }}</td>
                                <td>{{ \Carbon\Carbon::parse($maintenance->tanggal_maintenance)->format('d/m/Y') }}</td>
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
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .progress-group {
        margin-bottom: 1rem;
    }

    .progress-text {
        font-weight: bold;
    }
</style>
@stop