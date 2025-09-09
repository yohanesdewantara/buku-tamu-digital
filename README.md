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
