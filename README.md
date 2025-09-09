# 📘 Buku Tamu Digital (Laravel 10)

Aplikasi Buku Tamu Digital dengan autentikasi (Laravel Breeze), manajemen tamu (CRUD), filter & pencarian, laporan (export Excel/PDF), dashboard statistik (Chart.js), upload foto, dan tanda tangan digital.

## ✨ Fitur Utama
- **Manajemen Tamu (CRUD)**: tambah, lihat, edit, hapus
- **Filter & Pencarian**: nama, instansi, tanggal, kategori (Umum/Mitra/VIP/Internal)
- **Laporan**: ringkasan harian/mingguan/bulanan, **Export Excel/CSV** (Laravel Excel) & **Export PDF** (DOMPDF)
- **Dashboard Statistik**: grafik kunjungan 30 hari, top instansi, tamu terbaru
- **Upload Foto & TTD**: foto tamu, tanda tangan digital (signature pad)
- **Role**: Admin (full akses), Resepsionis (input & lihat)

## 🧰 Tech Stack
- PHP 8.1+, **Laravel 10**
- MySQL
- **Laravel Breeze** (Blade) – Auth
- **Maatwebsite/Laravel-Excel**, **barryvdh/laravel-dompdf**
- Tailwind CSS, Chart.js
- Storage publik (symlink) untuk foto/TTD

---

## 🚀 Quick Start

> **Prasyarat:** PHP 8.1+, Composer, Node.js, MySQL, phpMyAdmin (opsional)

```bash
# clone
git clone https://github.com/yohanesdewantara/buku-tamu-digital.git
cd buku-tamu-digital

# env
cp .env.example .env

# install deps
composer install
npm install
npm run build

# laravel app key + storage link
php artisan key:generate
php artisan storage:link
````

### Opsi A — Import Database Backup (direkomendasikan untuk lihat data langsung)

* Buka **phpMyAdmin** → buat DB `buku_tamu_digital` (jika belum)
* Tab **Import** → pilih file SQL di: `database/backups/buku_tamu_digital_YYYY-MM-DD.sql` → **Go**

**CLI (alternatif):**

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS buku_tamu_digital"
mysql -u root -p buku_tamu_digital < database/backups/buku_tamu_digital_YYYY-MM-DD.sql
```

### Opsi B — Migrate & Seed (tanpa backup)

```bash
php artisan migrate --seed
# (opsional) isi dummy data 50 entri:
php artisan db:seed --class=GuestDummySeeder
```

### Jalankan Aplikasi

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000`

**Akun default (dari seeder):**

* Admin: `admin@bukutamu.com` / `password`
* Resepsionis: `resepsionis@bukutamu.com` / `password`

---

## 🗺️ Navigasi Menu

* **Admin**

  * Dashboard (statistik, grafik, top instansi, tamu terbaru)
  * Data Tamu (CRUD + cari/filter)
  * Laporan (filter + export Excel/PDF)
  * Manajemen User (Tambah/Edit/Hapus user & role)

* **Resepsionis**

  * Dashboard ringkas (ringkasan hari ini, input saya)
  * Data Tamu (Tambah, Lihat, Cari/Filter)

---

## ✍️ Tanda Tangan Digital (TTD)

* Di form, tulis tanda tangan pada kanvas → **klik “Simpan TTD”** agar terkirim.
* TTD ditampilkan otomatis di halaman detail (mendukung format file & data base64 untuk data lama).

---

## ⚙️ Konfigurasi Penting

* **.env** (jangan di-commit, gunakan `.env.example` sebagai acuan)

  * `APP_URL=http://127.0.0.1:8000`
  * `DB_*` sesuaikan dengan MySQL lokal
  * (opsional) `FILESYSTEM_DISK=public` jika ingin default ke disk publik

* **Storage**

```bash
php artisan storage:link
```

* **Faker (opsional)**

  * Locale Indonesia: di `config/app.php` set `'faker_locale' => 'id_ID'`

```bash
php artisan optimize:clear
```

---

## 📦 Export / Import Data

* **Export Excel**: Menu **Laporan** → **Export Excel** (mengikuti filter aktif)
* **Export PDF**: Menu **Laporan** → **Export PDF**

---

## 🆘 Troubleshooting

* **Login gagal: “These credentials do not match our records.”**

  * Pastikan seeder jalan:

    ```bash
    php artisan migrate:fresh --seed
    ```
  * Cek user admin di DB (`admin@bukutamu.com` / `password`)

* **Gambar/TTD tidak muncul**

  * Jalankan `php artisan storage:link`
  * Pastikan `APP_URL` benar → `php artisan config:clear`
  * Pastikan saat input TTD **klik “Simpan TTD”**

* **Grafik kosong**

  * Pastikan ada data `visit_date` dalam 30 hari terakhir (pakai seeder dummy jika perlu)

* **Error migrasi kolom (skema lama)**

  * Gunakan:

    ```bash
    php artisan migrate:fresh --seed
    ```

---

## 🧪 Dummy Data Cepat (50 entri)

```bash
php artisan db:seed --class=GuestDummySeeder
```

---

## 🔐 Best Practice

* Ganti password default setelah pertama kali login.
* `.env` jangan di-commit.
* Untuk produksi, gunakan migrasi & seeder khusus (tanpa data sensitif).

---

## 📄 Lisensi

Bebas digunakan untuk kebutuhan internal/pendidikan. Tambahkan lisensi pilihan Anda bila diperlukan.

---

## 👤 Kredit

Dikembangkan menggunakan Laravel 10, Breeze, Laravel Excel, DOMPDF, Tailwind, Chart.js.
Admin default: `admin@bukutamu.com` / `password`

````


