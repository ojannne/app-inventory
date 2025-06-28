@extends('adminlte::page')
@section('title','Kategori Aset')
@section('content_header')
<h1>Kategori Aset</h1>
@stop
@section('content')
<div class="mb-3">
    <a href="{{ route('kategori.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kategori</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Kode</th>
                    <th>Status</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>{{ $kategori->kode_kategori }}</td>
                    <td>
                        @if($kategori->status == 'aktif')
                        <span class="badge badge-success">Aktif</span>
                        @else
                        <span class="badge badge-secondary">Nonaktif</span>
                        @endif
                    </td>
                    <td>{{ $kategori->deskripsi }}</td>
                    <td>
                        <a href="{{ route('kategori.show', $kategori) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada kategori</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop