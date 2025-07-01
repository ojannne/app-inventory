@extends('adminlte::page')

@section('title', 'Tambah Maintenance - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Tambah Maintenance Baru</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('maintenance.index') }}">Maintenance</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Maintenance</h3>
            </div>
            <form action="{{ route('maintenance.store') }}" method="POST">
                @csrf
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
                                        {{ old('aset_id', request('aset_id')) == $aset->id ? 'selected' : '' }}>
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
                                    value="{{ old('tanggal_maintenance', date('Y-m-d')) }}" required>
                                @error('tanggal_maintenance')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jenis_maintenance">Jenis Maintenance <span class="text-danger">*</span></label>
                                <select class="form-control @error('jenis_maintenance') is-invalid @enderror"
                                    id="jenis_maintenance" name="jenis_maintenance" required>
                                    <option value="">Pilih Jenis Maintenance</option>
                                    <option value="preventif" {{ old('jenis_maintenance') == 'preventif' ? 'selected' : '' }}>Preventif</option>
                                    <option value="korektif" {{ old('jenis_maintenance') == 'korektif' ? 'selected' : '' }}>Korektif</option>
                                    <option value="emergency" {{ old('jenis_maintenance') == 'emergency' ? 'selected' : '' }}>Emergency</option>
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
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
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
                                    placeholder="Masukkan deskripsi maintenance" required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="biaya">Biaya (Rp)</label>
                                <input type="number" class="form-control @error('biaya') is-invalid @enderror"
                                    id="biaya" name="biaya" value="{{ old('biaya') }}"
                                    placeholder="Masukkan biaya maintenance">
                                @error('biaya')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="teknisi">Teknisi</label>
                                <input type="text" class="form-control @error('teknisi') is-invalid @enderror"
                                    id="teknisi" name="teknisi" value="{{ old('teknisi') }}"
                                    placeholder="Masukkan nama teknisi">
                                @error('teknisi')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror"
                                    id="catatan" name="catatan" rows="3"
                                    placeholder="Masukkan catatan tambahan">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        var asetId = "{{ request('aset_id') }}";
        if (asetId) {
            $('#aset_id').val(asetId);
        }
    });
</script>
@stop