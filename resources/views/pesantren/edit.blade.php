@extends('adminlte::page')

@section('title', 'Edit Profil Pesantren - Inventory Pesantren')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Edit Profil Pesantren</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pesantren.index') }}">Profil Pesantren</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Profil Pesantren</h3>
            </div>
            <form action="{{ route('pesantren.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="nama_pesantren">Nama Pesantren <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_pesantren') is-invalid @enderror"
                            id="nama_pesantren" name="nama_pesantren"
                            value="{{ old('nama_pesantren', $pesantren->nama_pesantren ?? '') }}" required>
                        @error('nama_pesantren')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror"
                            id="alamat" name="alamat" rows="3" required>{{ old('alamat', $pesantren->alamat ?? '') }}</textarea>
                        @error('alamat')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                    id="telepon" name="telepon"
                                    value="{{ old('telepon', $pesantren->telepon ?? '') }}">
                                @error('telepon')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email"
                                    value="{{ old('email', $pesantren->email ?? '') }}">
                                @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="url" class="form-control @error('website') is-invalid @enderror"
                            id="website" name="website"
                            value="{{ old('website', $pesantren->website ?? '') }}"
                            placeholder="https://example.com">
                        @error('website')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                            id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $pesantren->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="visi">Visi</label>
                        <textarea class="form-control @error('visi') is-invalid @enderror"
                            id="visi" name="visi" rows="3">{{ old('visi', $pesantren->visi ?? '') }}</textarea>
                        @error('visi')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="misi">Misi</label>
                        <textarea class="form-control @error('misi') is-invalid @enderror"
                            id="misi" name="misi" rows="4">{{ old('misi', $pesantren->misi ?? '') }}</textarea>
                        @error('misi')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tahun_berdiri">Tahun Berdiri</label>
                                <input type="number" class="form-control @error('tahun_berdiri') is-invalid @enderror"
                                    id="tahun_berdiri" name="tahun_berdiri"
                                    value="{{ old('tahun_berdiri', $pesantren->tahun_berdiri ?? '') }}"
                                    min="1900" max="{{ date('Y') }}">
                                @error('tahun_berdiri')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jumlah_santri">Jumlah Santri</label>
                                <input type="number" class="form-control @error('jumlah_santri') is-invalid @enderror"
                                    id="jumlah_santri" name="jumlah_santri"
                                    value="{{ old('jumlah_santri', $pesantren->jumlah_santri ?? '') }}"
                                    min="0">
                                @error('jumlah_santri')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jumlah_ustadz">Jumlah Ustadz</label>
                                <input type="number" class="form-control @error('jumlah_ustadz') is-invalid @enderror"
                                    id="jumlah_ustadz" name="jumlah_ustadz"
                                    value="{{ old('jumlah_ustadz', $pesantren->jumlah_ustadz ?? '') }}"
                                    min="0">
                                @error('jumlah_ustadz')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="logo">Logo Pesantren</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('logo') is-invalid @enderror"
                                id="logo" name="logo" accept="image/*">
                            <label class="custom-file-label" for="logo">Pilih file logo...</label>
                        </div>
                        @error('logo')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">
                            Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.
                        </small>
                    </div>

                    @if($pesantren && $pesantren->logo)
                    <div class="form-group">
                        <label>Logo Saat Ini</label>
                        <div>
                            <img src="{{ asset('storage/' . $pesantren->logo) }}"
                                alt="Logo Pesantren" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('pesantren.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Panduan Pengisian</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Informasi Wajib</h5>
                    <ul class="mb-0">
                        <li>Nama Pesantren</li>
                        <li>Alamat Lengkap</li>
                    </ul>
                </div>

                <div class="alert alert-warning">
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Format Logo</h5>
                    <ul class="mb-0">
                        <li>Format: JPG, PNG, GIF</li>
                        <li>Ukuran maksimal: 2MB</li>
                        <li>Rasio aspek: 1:1 (persegi)</li>
                    </ul>
                </div>

                <div class="alert alert-success">
                    <h5><i class="icon fas fa-check"></i> Tips</h5>
                    <ul class="mb-0">
                        <li>Isi deskripsi yang informatif</li>
                        <li>Visi dan misi yang jelas</li>
                        <li>Data statistik yang akurat</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Preview Logo</h3>
            </div>
            <div class="card-body text-center">
                <div id="logo-preview" style="display: none;">
                    <img id="preview-image" src="" alt="Preview Logo" class="img-fluid" style="max-height: 200px;">
                </div>
                <div id="no-logo" class="text-muted">
                    <i class="fas fa-image fa-3x mb-2"></i>
                    <p>Logo akan ditampilkan di sini</p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .custom-file-label::after {
        content: "Browse";
    }
</style>
@stop

@section('js')
<script>
    // Preview logo
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('logo-preview');
        const previewImage = document.getElementById('preview-image');
        const noLogo = document.getElementById('no-logo');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                preview.style.display = 'block';
                noLogo.style.display = 'none';
            }
            reader.readAsDataURL(file);

            // Update file input label
            document.querySelector('.custom-file-label').textContent = file.name;
        } else {
            preview.style.display = 'none';
            noLogo.style.display = 'block';
            document.querySelector('.custom-file-label').textContent = 'Pilih file logo...';
        }
    });
</script>
@stop