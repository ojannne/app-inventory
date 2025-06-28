@extends('adminlte::page')

@section('title', 'Laporan Maintenance - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Laporan Maintenance</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan</a></li>
            <li class="breadcrumb-item active">Maintenance</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Semua Maintenance</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="maintenance-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aset</th>
                        <th>Kategori</th>
                        <th>Jenis Maintenance</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Biaya</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maintenances as $index => $maintenance)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $maintenance->aset->nama_aset }}</td>
                        <td>{{ $maintenance->aset->kategori->nama_kategori }}</td>
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
                        <td>{{ $maintenance->keterangan ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Statistik Maintenance -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistik Status Maintenance</h3>
            </div>
            <div class="card-body">
                @php
                $totalMaintenance = count($maintenances);
                $selesai = $maintenances->where('status', 'Selesai')->count();
                $dalamProses = $maintenances->where('status', 'Dalam Proses')->count();
                $pending = $maintenances->where('status', 'Pending')->count();
                @endphp

                <div class="progress-group">
                    <span class="progress-text">Selesai</span>
                    <span class="float-right"><b>{{ $selesai }}</b>/{{ $totalMaintenance }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: {{ $totalMaintenance > 0 ? ($selesai / $totalMaintenance) * 100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    <span class="progress-text">Dalam Proses</span>
                    <span class="float-right"><b>{{ $dalamProses }}</b>/{{ $totalMaintenance }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-warning" style="width: {{ $totalMaintenance > 0 ? ($dalamProses / $totalMaintenance) * 100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    <span class="progress-text">Pending</span>
                    <span class="float-right"><b>{{ $pending }}</b>/{{ $totalMaintenance }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-secondary" style="width: {{ $totalMaintenance > 0 ? ($pending / $totalMaintenance) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Total Biaya Maintenance</h3>
            </div>
            <div class="card-body">
                @php
                $totalBiaya = $maintenances->sum('biaya');
                $biayaSelesai = $maintenances->where('status', 'Selesai')->sum('biaya');
                $biayaProses = $maintenances->where('status', 'Dalam Proses')->sum('biaya');
                @endphp

                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Biaya</span>
                        <span class="info-box-number">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Biaya Selesai</span>
                        <span class="info-box-number">Rp {{ number_format($biayaSelesai, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Biaya Dalam Proses</span>
                        <span class="info-box-number">Rp {{ number_format($biayaProses, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
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
        $('#maintenance-table').DataTable({
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