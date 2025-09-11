# 📘 Buku Tamu Digital (Laravel 10) Untuk Tugas Pentest Nemo

Aplikasi Buku Tamu Digital dengan autentikasi (Laravel Breeze), manajemen tamu (CRUD), filter & pencarian, laporan (export Excel/PDF), dashboard statistik (Chart.js), upload foto, dan tanda tangan digital.

## ✨ Fitur Utama
- **Manajemen Tamu (CRUD)**: tambah, lihat, edit, hapus
- **Filter & Pencarian**: nama, instansi, tanggal, kategori (Umum/Mitra/VIP/Internal)
- **Laporan**: ringkasan harian/mingguan/bulanan, **Export Excel/CSV** (Laravel Excel) & **Export PDF** (DOMPDF)
- **Dashboard Statistik**: grafik kunjungan 30 hari, top instansi, tamu terbaru
- **Upload Foto & TTD**: foto tamu, tanda tangan digital (signature pad)
- **Role**: Admin (full akses), Resepsionis (input & lihat)

## 🔄 Alur Singkat Pemakaian
- Login sesuai role.
- **Resepsionis** → Data Tamu → Tambah Tamu (opsional: Simpan TTD sebelum simpan).
- **Admin** → pantau Dashboard, kelola tamu (CRUD), Laporan (Export Excel/PDF), dan Manajemen User (CRUD).

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
* **Login**
<img width="1901" height="879" alt="Screenshot 2025-09-12 024716" src="https://github.com/user-attachments/assets/cfaffe9d-226b-488d-8204-df8774302566" />


* **Admin**

  * Dashboard (statistik, grafik, top instansi, tamu terbaru)
<img width="1917" height="885" alt="Dashboard Admin" src="https://github.com/user-attachments/assets/b34f6ad2-1b3a-45b4-8f32-f5ea88b51643" />
<img width="1911" height="879" alt="Dashboard Admin (2)" src="https://github.com/user-attachments/assets/9ec4a987-13df-450a-9df8-aa31f7fb834d" />


  * Data Tamu (CRUD + cari/filter)
<img width="1919" height="884" alt="Screenshot 2025-09-11 182935" src="https://github.com/user-attachments/assets/c920d4b8-e81d-44fe-93a8-4dcafbbc0da1" />

  * Laporan (filter + export Excel/PDF)
<img width="1912" height="887" alt="Screenshot 2025-09-11 182942" src="https://github.com/user-attachments/assets/c5e57535-f5f5-4bb8-9e3c-1a591c14b077" />

  * Manajemen User (Tambah/Edit/Hapus user & role)
<img width="1912" height="887" alt="Screenshot 2025-09-11 182950" src="https://github.com/user-attachments/assets/30ad6f3f-a624-46c3-bede-b749037a726d" />
<img width="1914" height="885" alt="Screenshot 2025-09-11 183003" src="https://github.com/user-attachments/assets/a3538f98-eb00-4239-8c94-c387f786a6ca" />



* **Resepsionis**

  * Dashboard ringkas (ringkasan hari ini, input saya)
<img width="1916" height="896" alt="Dashboard User" src="https://github.com/user-attachments/assets/19bcf88a-de9f-4b5b-aea7-a0bbba65614c" />

  * Data Tamu (Tambah, Lihat, Cari/Filter)
<img width="1909" height="896" alt="Data tamu user" src="https://github.com/user-attachments/assets/9c9c2c90-2f3f-4414-ae4e-2f6f2bbbc087" />
<img width="1908" height="889" alt="Tambah Tamu" src="https://github.com/user-attachments/assets/ba17dd6b-796e-4e23-89fd-d4758ed23c23" />
<img width="1905" height="889" alt="Tambah Tamu (2)" src="https://github.com/user-attachments/assets/f1a8c41f-697e-4854-89bf-499aae6f3b1e" />




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

## 👤 Kredit

Dikembangkan menggunakan Laravel 10, Breeze, Laravel Excel, DOMPDF, Tailwind, Chart.js.
Admin default: `admin@bukutamu.com` / `password`
---




