@extends('adminlte::page')

@section('title', 'Manajemen Pengguna - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Manajemen Pengguna</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengguna</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Pengguna</h3>
        <div class="card-tools">
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Pengguna
            </a>
        </div>
    </div>
    <div class="card-body">
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

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="users-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width:40px">No</th>
                        <th class="text-center" style="width:60px">Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th class="text-center" style="width:90px">Role</th>
                        <th class="text-center" style="width:110px">Status</th>
                        <th class="text-center" style="width:150px">Tanggal Daftar</th>
                        <th class="text-center" style="width:110px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                        <td class="text-center align-middle">
                            @if($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Foto Profil" class="img-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                            <i class="fas fa-user-circle fa-2x text-primary"></i>
                            @endif
                        </td>
                        <td class="align-middle">{{ $user->name }}</td>
                        <td class="align-middle">{{ $user->email }}</td>
                        <td class="text-center align-middle">
                            @if($user->role == 'admin')
                            <span class="badge badge-danger">Admin</span>
                            @elseif($user->role == 'petugas')
                            <span class="badge badge-primary">Petugas</span>
                            @else
                            <span class="badge badge-success">Ustadz</span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @if($user->email_verified_at)
                            <span class="badge badge-success">Terverifikasi</span>
                            @else
                            <span class="badge badge-warning">Belum Verifikasi</span>
                            @endif
                        </td>
                        <td class="text-center align-middle">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center align-middle">
                            <div class="btn-group" role="group">
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<style>
    .img-circle {
        border-radius: 50%;
        border: 2px solid #e0e0e0;
        background: #fff;
    }

    .table td,
    .table th {
        vertical-align: middle !important;
    }
</style>
@stop

@section('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            },
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
@stop