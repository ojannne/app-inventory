@extends('adminlte::page')

@section('title', 'Edit Aset - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Edit Aset</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('aset.index') }}">Aset</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Aset</h3>
            </div>
            <form action="{{ route('aset.update', $aset->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_aset">Kode Aset <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_aset') is-invalid @enderror"
                                    id="kode_aset" name="kode_aset" value="{{ old('kode_aset', $aset->kode_aset) }}"
                                    placeholder="Masukkan kode aset" required>
                                @error('kode_aset')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_aset">Nama Aset <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_aset') is-invalid @enderror"
                                    id="nama_aset" name="nama_aset" value="{{ old('nama_aset', $aset->nama_aset) }}"
                                    placeholder="Masukkan nama aset" required>
                                @error('nama_aset')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kategori_id">Kategori <span class="text-danger">*</span></label>
                                <select class="form-control @error('kategori_id') is-invalid @enderror"
                                    id="kategori_id" name="kategori_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        {{ old('kategori_id', $aset->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                    id="deskripsi" name="deskripsi" rows="3"
                                    placeholder="Masukkan deskripsi aset">{{ old('deskripsi', $aset->deskripsi) }}</textarea>
                                @error('deskripsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    id="lokasi" name="lokasi" value="{{ old('lokasi', $aset->lokasi) }}"
                                    placeholder="Masukkan lokasi aset">
                                @error('lokasi')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pembelian">Tanggal Pembelian</label>
                                <input type="date" class="form-control @error('tanggal_pembelian') is-invalid @enderror"
                                    id="tanggal_pembelian" name="tanggal_pembelian"
                                    value="{{ old('tanggal_pembelian', $aset->tanggal_pembelian) }}">
                                @error('tanggal_pembelian')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga (Rp)</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                    id="harga" name="harga" value="{{ old('harga', $aset->harga) }}"
                                    placeholder="Masukkan harga aset">
                                @error('harga')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kondisi">Kondisi <span class="text-danger">*</span></label>
                                <select class="form-control @error('kondisi') is-invalid @enderror"
                                    id="kondisi" name="kondisi" required>
                                    <option value="">Pilih Kondisi</option>
                                    <option value="Baik" {{ old('kondisi', $aset->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="Rusak Ringan" {{ old('kondisi', $aset->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                    <option value="Rusak Berat" {{ old('kondisi', $aset->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                </select>
                                @error('kondisi')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Tersedia" {{ old('status', $aset->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="Dipinjam" {{ old('status', $aset->status) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                    <option value="Maintenance" {{ old('status', $aset->status) == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar Aset</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('gambar') is-invalid @enderror"
                                            id="gambar" name="gambar" accept="image/*">
                                        <label class="custom-file-label" for="gambar">Pilih file</label>
                                    </div>
                                </div>
                                @error('gambar')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.</small>

                                @if($aset->gambar)
                                <div class="mt-2">
                                    <p><strong>Gambar Saat Ini:</strong></p>
                                    <img src="{{ asset('storage/' . $aset->gambar) }}"
                                        alt="Gambar {{ $aset->nama_aset }}"
                                        class="img-thumbnail"
                                        style="max-height: 150px;">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('aset.show', $aset->id) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                    <a href="{{ route('aset.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.3.4/bs-custom-file-input.min.css">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.3.4/bs-custom-file-input.min.js"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script>
@stop