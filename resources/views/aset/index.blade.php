@extends('adminlte::page')

@section('title', 'Daftar Aset - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Daftar Aset</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Aset</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Aset Pesantren</h3>
                <div class="card-tools">
                    <a href="{{ route('aset.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Aset
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
                    <table class="table table-bordered table-striped" id="aset-table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Kode Aset</th>
                                <th width="20%">Nama Aset</th>
                                <th width="15%">Kategori</th>
                                <th width="10%">Kondisi</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($asets as $index => $aset)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $aset->kode_aset }}</span>
                                </td>
                                <td>
                                    <strong>{{ $aset->nama_aset }}</strong><br>
                                    <small class="text-muted">{{ Str::limit($aset->deskripsi, 50) }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">{{ $aset->kategori->nama_kategori }}</span>
                                </td>
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
                                    <span class="badge badge-secondary">{{ $aset->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('aset.show', $aset->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('aset.edit', $aset->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('aset.destroy', $aset->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aset ini?')">
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
                                <td colspan="7" class="text-center">Tidak ada data aset</td>
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
        $('#aset-table').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            }
        });
    });
</script>
@stop