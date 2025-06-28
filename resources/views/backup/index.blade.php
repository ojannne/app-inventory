@extends('adminlte::page')

@section('title', 'Backup Data - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Backup Data</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Backup Data</li>
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

@if(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('error') }}
</div>
@endif

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Buat Backup Baru</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Backup database akan menyimpan semua data dalam format SQL yang dapat dipulihkan kembali.
                </p>
                <form action="{{ route('backup.create') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-download"></i> Buat Backup
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pulihkan Database</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Upload file backup SQL untuk memulihkan database ke kondisi sebelumnya.
                </p>
                <form action="{{ route('backup.restore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="backup_file">Pilih File Backup</label>
                        <input type="file" class="form-control-file @error('backup_file') is-invalid @enderror"
                            id="backup_file" name="backup_file" accept=".sql" required>
                        @error('backup_file')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning btn-block"
                        onclick="return confirm('PERHATIAN: Proses ini akan menimpa semua data yang ada. Apakah Anda yakin ingin melanjutkan?')">
                        <i class="fas fa-upload"></i> Pulihkan Database
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Backup</h3>
            </div>
            <div class="card-body">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-database"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Backup</span>
                        <span class="info-box-number">{{ count($backups) }}</span>
                    </div>
                </div>

                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Backup Terakhir</span>
                        <span class="info-box-number">
                            @if(count($backups) > 0)
                            {{ $backups[0]['created_at'] }}
                            @else
                            Belum ada
                            @endif
                        </span>
                    </div>
                </div>

                <div class="alert alert-warning">
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
                    <ul class="mb-0">
                        <li>Backup secara berkala untuk keamanan data</li>
                        <li>Simpan file backup di lokasi yang aman</li>
                        <li>Test restore di lingkungan development terlebih dahulu</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar File Backup</h3>
            </div>
            <div class="card-body">
                @if(count($backups) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="backup-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama File</th>
                                <th>Ukuran</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($backups as $index => $backup)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <i class="fas fa-file-archive text-primary"></i>
                                    {{ $backup['filename'] }}
                                </td>
                                <td>{{ $backup['size'] }}</td>
                                <td>{{ $backup['created_at'] }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('backup.download', $backup['filename']) }}"
                                            class="btn btn-success btn-sm" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <form action="{{ route('backup.delete', $backup['filename']) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus file backup ini?')"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center text-muted">
                    <i class="fas fa-database fa-3x mb-3"></i>
                    <h5>Belum Ada File Backup</h5>
                    <p>Buat backup pertama untuk melindungi data Anda.</p>
                </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Backup</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    @if(count($backups) > 0)
                    @foreach($backups as $backup)
                    <div>
                        <i class="fas fa-database bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i> {{ $backup['created_at'] }}
                            </span>
                            <h3 class="timeline-header">
                                <a href="#">{{ $backup['filename'] }}</a>
                            </h3>
                            <div class="timeline-body">
                                <p>Ukuran file: {{ $backup['size'] }}</p>
                                <p>Status: <span class="badge badge-success">Berhasil</span></p>
                            </div>
                            <div class="timeline-footer">
                                <a href="{{ route('backup.download', $backup['filename']) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-history fa-2x mb-2"></i>
                        <p>Belum ada riwayat backup</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
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

@section('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#backup-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            },
            "responsive": true,
            "autoWidth": false,
            "order": [
                [3, "desc"]
            ]
        });
    });
</script>
@stop