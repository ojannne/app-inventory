# 🕌 Inventory Pesantren

Sistem manajemen inventaris untuk pesantren yang dibangun dengan Laravel 10 dan AdminLTE.

## 🚀 Fitur Utama

- **Dashboard** - Statistik aset, kategori, dan maintenance
- **Manajemen Kategori** - CRUD kategori aset
- **Manajemen Aset** - CRUD aset dengan foto
- **Maintenance** - Tracking maintenance aset
- **Autentikasi** - Login, register, dan reset password
- **Responsive Design** - Menggunakan AdminLTE

## 📋 Kategori Aset

1. **Aset Bangunan** - Masjid, asrama, kelas, dapur
2. **Peralatan** - Meja, kursi, alat ibadah
3. **Buku & Kitab** - Perpustakaan pesantren
4. **Kendaraan** - Mobil, motor operasional
5. **Elektronik** - Komputer, printer, sound system
6. **Pakaian & Seragam** - Seragam santri, jubah

## 🛠️ Instalasi

### Prerequisites
- PHP 8.1+
- Composer
- MySQL/MariaDB
- XAMPP/WAMP/LAMP

### Langkah Instalasi

1. **Clone repository**
```bash
git clone <repository-url>
cd laravel-inventory
```

2. **Install dependencies**
```bash
composer install
```

3. **Copy environment file**
```bash
cp .env.example .env
```

4. **Generate application key**
```bash
php artisan key:generate
```

5. **Configure database di .env**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_laravel3
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run migrations dan seeder**
```bash
php artisan migrate:fresh --seed
```

7. **Create storage link**
```bash
php artisan storage:link
```

8. **Start server**
```bash
php artisan serve
```

## 👤 Akun Default

Setelah menjalankan seeder, tersedia akun default:

### Admin
- **Email:** admin@pesantren.com
- **Password:** admin123

### Petugas
- **Email:** petugas@pesantren.com
- **Password:** petugas123

### Ustadz
- **Email:** ustadz@pesantren.com
- **Password:** ustadz123

## 📁 Struktur Database

### Tabel Users
- id, name, email, password, email_verified_at, created_at, updated_at

### Tabel Kategori
- id, nama_kategori, deskripsi, kode_kategori, status, created_at, updated_at

### Tabel Aset
- id, kode_aset, nama_aset, kategori_id, lokasi, kondisi, tanggal_pembelian, harga_beli, supplier, deskripsi, foto, status, user_id, created_at, updated_at

### Tabel Maintenance
- id, aset_id, jenis_maintenance, tanggal_maintenance, deskripsi, biaya, teknisi, status, catatan, user_id, created_at, updated_at

## 🎨 Tema & UI

Menggunakan AdminLTE 3 dengan tema pesantren:
- Icon masjid untuk branding
- Warna biru sebagai primary color
- Responsive design untuk mobile dan desktop

## 🔧 Pengembangan

### Menambah Kategori Baru
1. Buka menu "Kategori Aset"
2. Klik "Tambah Kategori"
3. Isi form dan simpan

### Menambah Aset Baru
1. Buka menu "Aset" (sesuai kategori)
2. Klik "Tambah Aset"
3. Upload foto (opsional)
4. Isi semua field dan simpan

### Maintenance Aset
1. Buka menu "Maintenance"
2. Klik "Tambah Maintenance"
3. Pilih aset dan isi detail maintenance

## 📊 Dashboard

Dashboard menampilkan:
- Total aset, kategori, dan maintenance
- Status aset (tersedia, maintenance, rusak, dipinjam)
- Aset terbaru
- Maintenance terbaru
- Total nilai aset

## 🔒 Keamanan

- Autentikasi Laravel
- Validasi input
- CSRF protection
- File upload validation
- Password hashing

## 📝 License

MIT License

## 👨‍💻 Developer

Dibuat dengan ❤️ untuk pesantren Indonesia

---

**Catatan:** Pastikan folder `storage/app/public/aset` memiliki permission write untuk upload foto aset.
