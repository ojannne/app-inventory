@extends('adminlte::page')
@section('title','Detail Kategori')
@section('content_header')
<h1>Detail Kategori Aset</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Nama Kategori</dt>
            <dd class="col-sm-9">{{ $kategori->nama_kategori }}</dd>
            <dt class="col-sm-3">Kode Kategori</dt>
            <dd class="col-sm-9">{{ $kategori->kode_kategori }}</dd>
            <dt class="col-sm-3">Status</dt>
            <dd class="col-sm-9">
                @if($kategori->status == 'aktif')
                <span class="badge badge-success">Aktif</span>
                @else
                <span class="badge badge-secondary">Nonaktif</span>
                @endif
            </dd>
            <dt class="col-sm-3">Deskripsi</dt>
            <dd class="col-sm-9">{{ $kategori->deskripsi }}</dd>
            <dt class="col-sm-3">Waktu Input</dt>
            <dd class="col-sm-9">{{ $kategori->created_at->format('d/m/Y H:i') }}</dd>
            <dt class="col-sm-3">Update Terakhir</dt>
            <dd class="col-sm-9">{{ $kategori->updated_at->format('d/m/Y H:i') }}</dd>
        </dl>
        <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@stop