@extends('adminlte::page')

@section('title', 'Laporan Kategori - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Laporan Kategori</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan</a></li>
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Kategori dan Jumlah Aset</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="kategori-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Aset</th>
                        <th>Persentase</th>
                        <th>Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $totalAset = $kategoris->sum('asets_count');
                    $totalNilai = 0;
                    @endphp
                    @foreach($kategoris as $index => $kategori)
                    @php
                    $nilaiKategori = $kategori->asets->sum('harga');
                    $totalNilai += $nilaiKategori;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>{{ $kategori->deskripsi ?? '-' }}</td>
                        <td>
                            <span class="badge badge-primary">{{ $kategori->asets_count }}</span>
                        </td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ $totalAset > 0 ? ($kategori->asets_count / $totalAset) * 100 : 0 }}%">
                                    {{ $totalAset > 0 ? round(($kategori->asets_count / $totalAset) * 100, 1) : 0 }}%
                                </div>
                            </div>
                        </td>
                        <td>Rp {{ number_format($nilaiKategori, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Statistik Kategori -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Distribusi Aset per Kategori</h3>
            </div>
            <div class="card-body">
                @foreach($kategoris as $kategori)
                <div class="progress-group">
                    <span class="progress-text">{{ $kategori->nama_kategori }}</span>
                    <span class="float-right"><b>{{ $kategori->asets_count }}</b>/{{ $totalAset }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $totalAset > 0 ? ($kategori->asets_count / $totalAset) * 100 : 0 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ringkasan Nilai Aset</h3>
            </div>
            <div class="card-body">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-box"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Aset</span>
                        <span class="info-box-number">{{ $totalAset }}</span>
                    </div>
                </div>

                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-tags"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Kategori</span>
                        <span class="info-box-number">{{ count($kategoris) }}</span>
                    </div>
                </div>

                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Nilai Aset</span>
                        <span class="info-box-number">Rp {{ number_format($totalNilai, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="info-box bg-primary">
                    <span class="info-box-icon"><i class="fas fa-chart-pie"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Rata-rata per Kategori</span>
                        <span class="info-box-number">{{ count($kategoris) > 0 ? round($totalAset / count($kategoris), 1) : 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Aset per Kategori -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Aset per Kategori</h3>
    </div>
    <div class="card-body">
        @foreach($kategoris as $kategori)
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tag"></i> {{ $kategori->nama_kategori }}
                    <span class="badge badge-primary">{{ $kategori->asets_count }} aset</span>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if($kategori->asets_count > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Nama Aset</th>
                                <th>Kondisi</th>
                                <th>Status</th>
                                <th>Harga</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategori->asets as $aset)
                            <tr>
                                <td>{{ $aset->nama_aset }}</td>
                                <td>
                                    @if($aset->kondisi == 'Baik')
                                    <span class="badge badge-success">{{ $aset->kondisi }}</span>
                                    @elseif($aset->kondisi == 'Rusak Ringan')
                                    <span class="badge badge-warning">{{ $aset->kondisi }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ $aset->kondisi }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($aset->status == 'Tersedia')
                                    <span class="badge badge-success">{{ $aset->status }}</span>
                                    @elseif($aset->status == 'Dipinjam')
                                    <span class="badge badge-info">{{ $aset->status }}</span>
                                    @else
                                    <span class="badge badge-warning">{{ $aset->status }}</span>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($aset->harga, 0, ',', '.') }}</td>
                                <td>{{ $aset->lokasi ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center text-muted">
                    <i class="fas fa-box-open fa-2x mb-2"></i>
                    <p>Belum ada aset dalam kategori ini</p>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
<style>
    .progress-group {
        margin-bottom: 1rem;
    }

    .progress-text {
        font-weight: bold;
    }

    .info-box {
        margin-bottom: 1rem;
    }
</style>
@stop

@section('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kategori-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            },
            "responsive": true,
            "autoWidth": false,
            "dom": 'Bfrtip',
            "buttons": [{
                    extend: 'copy',
                    text: '<i class="fas fa-copy"></i> Copy',
                    className: 'btn btn-info btn-sm'
                },
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    className: 'btn btn-success btn-sm'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'btn btn-warning btn-sm'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: 'btn btn-danger btn-sm'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Print',
                    className: 'btn btn-secondary btn-sm'
                }
            ]
        });
    });
</script>
@stop