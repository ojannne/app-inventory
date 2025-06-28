@extends('adminlte::page')

@section('title', 'Daftar Maintenance - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Daftar Maintenance</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Maintenance</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Maintenance Aset</h3>
                <div class="card-tools">
                    <a href="{{ route('maintenance.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Maintenance
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {{ session('error') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="maintenance-table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Aset</th>
                                <th width="15%">Tanggal</th>
                                <th width="15%">Jenis</th>
                                <th width="20%">Deskripsi</th>
                                <th width="10%">Status</th>
                                <th width="10%">Biaya</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($maintenances as $index => $maintenance)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $maintenance->aset->nama_aset }}</strong><br>
                                    <small class="text-muted">{{ $maintenance->aset->kode_aset }}</small>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($maintenance->tanggal_maintenance)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $maintenance->jenis_maintenance }}</span>
                                </td>
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
                                <td>
                                    @if($maintenance->biaya)
                                    <span class="text-success">Rp {{ number_format($maintenance->biaya, 0, ',', '.') }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('maintenance.show', $maintenance->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('maintenance.edit', $maintenance->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('maintenance.destroy', $maintenance->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus maintenance ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data maintenance</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Maintenance -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $maintenances->count() }}</h3>
                <p>Total Maintenance</p>
            </div>
            <div class="icon">
                <i class="fas fa-tools"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $maintenances->where('status', 'Selesai')->count() }}</h3>
                <p>Maintenance Selesai</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $maintenances->where('status', 'Dalam Proses')->count() }}</h3>
                <p>Dalam Proses</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Rp {{ number_format($maintenances->sum('biaya'), 0, ',', '.') }}</h3>
                <p>Total Biaya</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#maintenance-table').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            }
        });
    });
</script>
@stop