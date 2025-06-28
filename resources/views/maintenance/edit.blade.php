@extends('adminlte::page')

@section('title', 'Edit Maintenance - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Edit Maintenance</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('maintenance.index') }}">Maintenance</a></li>
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
                <h3 class="card-title">Form Edit Maintenance</h3>
            </div>
            <form action="{{ route('maintenance.update', $maintenance->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aset_id">Aset <span class="text-danger">*</span></label>
                                <select class="form-control @error('aset_id') is-invalid @enderror"
                                    id="aset_id" name="aset_id" required>
                                    <option value="">Pilih Aset</option>
                                    @foreach($asets as $aset)
                                    <option value="{{ $aset->id }}"
                                        {{ old('aset_id', $maintenance->aset_id) == $aset->id ? 'selected' : '' }}>
                                        {{ $aset->kode_aset }} - {{ $aset->nama_aset }}
                                        ({{ $aset->kategori->nama_kategori }})
                                    </option>
                                    @endforeach
                                </select>
                                @error('aset_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_maintenance">Tanggal Maintenance <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_maintenance') is-invalid @enderror"
                                    id="tanggal_maintenance" name="tanggal_maintenance"
                                    value="{{ old('tanggal_maintenance', $maintenance->tanggal_maintenance) }}" required>
                                @error('tanggal_maintenance')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jenis_maintenance">Jenis Maintenance <span class="text-danger">*</span></label>
                                <select class="form-control @error('jenis_maintenance') is-invalid @enderror"
                                    id="jenis_maintenance" name="jenis_maintenance" required>
                                    <option value="">Pilih Jenis Maintenance</option>
                                    <option value="Preventive" {{ old('jenis_maintenance', $maintenance->jenis_maintenance) == 'Preventive' ? 'selected' : '' }}>Preventive</option>
                                    <option value="Corrective" {{ old('jenis_maintenance', $maintenance->jenis_maintenance) == 'Corrective' ? 'selected' : '' }}>Corrective</option>
                                    <option value="Emergency" {{ old('jenis_maintenance', $maintenance->jenis_maintenance) == 'Emergency' ? 'selected' : '' }}>Emergency</option>
                                    <option value="Rutin" {{ old('jenis_maintenance', $maintenance->jenis_maintenance) == 'Rutin' ? 'selected' : '' }}>Rutin</option>
                                </select>
                                @error('jenis_maintenance')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Dimulai" {{ old('status', $maintenance->status) == 'Belum Dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                                    <option value="Dalam Proses" {{ old('status', $maintenance->status) == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                                    <option value="Selesai" {{ old('status', $maintenance->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                    id="deskripsi" name="deskripsi" rows="4"
                                    placeholder="Masukkan deskripsi maintenance" required>{{ old('deskripsi', $maintenance->deskripsi) }}</textarea>
                                @error('deskripsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="biaya">Biaya (Rp)</label>
                                <input type="number" class="form-control @error('biaya') is-invalid @enderror"
                                    id="biaya" name="biaya" value="{{ old('biaya', $maintenance->biaya) }}"
                                    placeholder="Masukkan biaya maintenance">
                                @error('biaya')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="teknisi">Teknisi</label>
                                <input type="text" class="form-control @error('teknisi') is-invalid @enderror"
                                    id="teknisi" name="teknisi" value="{{ old('teknisi', $maintenance->teknisi) }}"
                                    placeholder="Masukkan nama teknisi">
                                @error('teknisi')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror"
                                    id="catatan" name="catatan" rows="3"
                                    placeholder="Masukkan catatan tambahan">{{ old('catatan', $maintenance->catatan) }}</textarea>
                                @error('catatan')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('maintenance.show', $maintenance->id) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                    <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop