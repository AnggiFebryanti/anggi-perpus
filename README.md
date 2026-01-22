# 📚 Sistem Manajemen Buku Perpustakaan

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-4.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-6.0-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

---

## 📖 Deskripsi Singkat

**Sistem Manajemen Buku Perpustakaan** adalah Sistem Manajemen Perpustakaan berbasis web yang dibangun dengan Laravel 12 dan Tailwind CSS 4. Aplikasi ini dirancang untuk membantu perpustakaan dalam mengelola koleksi buku, kategori, dan sistem peminjaman dengan cara yang efisien dan terorganisir.

Aplikasi ini menyelesaikan masalah umum dalam manajemen perpustakaan tradisional seperti:

- Kesulitan dalam melacak status peminjaman buku
- Manajemen stok buku yang tidak akurat
- Kurangnya sistem kategorisasi yang baik
- Kebutuhan antarmuka yang intuitif untuk admin perpustakaan

---

## 🛠 Tech Stack

### Backend

- **Laravel 12.x** - Framework PHP modern untuk backend
- **PHP 8.2+** - Bahasa pemrograman backend
- **MySQL/MariaDB** - Database default (mendukung SQLite juga)
- **Laravel Tinker** - Console interaktif untuk debugging

### Frontend

- **Tailwind CSS 4.x** - Framework CSS utility-first
- **Vite 6.x** - Build tool dan development server yang cepat
- **Axios** - HTTP client untuk request API
- **Blade Templates** - Template engine bawaan Laravel

### Tools & Development

- **Composer** - Dependency manager untuk PHP
- **npm** - Dependency manager untuk JavaScript
- **PHPUnit** - Framework testing
- **FakerPHP** - Generator data dummy untuk testing
- **Concurrently** - Menjalankan multiple command secara bersamaan

---

## ✨ Fitur Utama

✅ **Sistem Autentikasi**

- Login dan Logout yang aman
- Proteksi route dengan middleware
- Session management yang terintegrasi

✅ **Dashboard Manajemen**

- Ringkasan statistik perpustakaan
- Navigasi yang intuitif
- Akses cepat ke semua fitur

✅ **Manajemen Kategori**

- CRUD (Create, Read, Update, Delete) kategori buku
- Organisasi buku yang terstruktur
- Validasi data yang robust

✅ **Manajemen Buku**

- CRUD buku lengkap
- Upload cover buku
- Informasi detail: judul, penulis, penerbit, tahun, stok
- Relasi dengan kategori
- Manajemen stok otomatis

✅ **Sistem Peminjaman**

- Pencatatan peminjaman buku
- Tracking status: Dipinjam / Dikembalikan
- Informasi peminjam dan tanggal
- Riwayat peminjaman

✅ **Validasi & Keamanan**

- Validasi input di sisi server
- Proteksi CSRF
- SQL Injection protection
- XSS protection

---

## 📋 Prasyarat (Prerequisites)

Sebelum menjalankan aplikasi ini, pastikan komputer Anda sudah terinstall:

- **PHP** >= 8.2
    - Download: [https://www.php.net/downloads](https://www.php.net/downloads)
- **Composer** >= 2.x
    - Download: [https://getcomposer.org/download/](https://getcomposer.org/download/)
- **Node.js** >= 18.x
    - Download: [https://nodejs.org/](https://nodejs.org/)
- **npm** (terinstall bersama Node.js)
- **Database**
    - MySQL/MariaDB >= 8.0 (default)
    - Atau SQLite (opsional)
- **Git** (untuk clone repository)
    - Download: [https://git-scm.com/downloads](https://git-scm.com/downloads)

**Rekomendasi**:

- **Laragon** (untuk Windows) - Environment development all-in-one
- **VS Code** - Code editor dengan ekstensi PHP dan Laravel

---

## 🚀 Cara Instalasi

Ikuti langkah-langkah berikut untuk menginstal aplikasi di komputer lokal Anda:

### 1. Clone Repository

Buka terminal dan jalankan perintah:

```bash
git clone https://github.com/AnggiFebryanti/anggi-perpus.git
cd anggi-perpus
```

### 2. Install PHP Dependencies

Install semua dependensi backend dengan Composer:

```bash
composer install
```

### 3. Install Node.js Dependencies

Install semua dependensi frontend dengan npm:

```bash
npm install
```

### 4. Setup Environment

Copy file `.env.example` ke `.env`:

```bash
copy .env.example .env
```

_Catatan: Jika menggunakan Linux/Mac, gunakan `cp` instead of `copy`_

### 5. Generate Application Key

Generate unique application key untuk Laravel:

```bash
php artisan key:generate
```

### 6. Setup Database

#### Opsi A: MySQL/MariaDB (Default - Disarankan)

Buat database baru di MySQL/MariaDB:

```sql
CREATE DATABASE anggi_perpus;
```

Kemudian update file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=anggi_perpus
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### Opsi B: SQLite (Opsi Alternatif)

Buat file database SQLite kosong:

```bash
# Windows
type nul > database/database.sqlite

# Linux/Mac
touch database/database.sqlite
```

Pastikan di file `.env` konfigurasi database menggunakan SQLite:

```env
DB_CONNECTION=sqlite
```

### 7. Migrasi & Seeding Database

Jalankan migrasi untuk membuat tabel dan seeder untuk data awal:

```bash
php artisan migrate --seed
```

Perintah ini akan:

- Membuat semua tabel yang diperlukan
- Mengisi database dengan data awal (admin, kategori, buku, dan peminjaman contoh)

---

## ▶️ Cara Menjalankan Aplikasi

### Opsi 1: Menjalankan Server Terpisah

**Terminal 1 - Laravel Server:**

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://localhost:8000**

**Terminal 2 - Vite Development Server:**

```bash
npm run dev
```

Vite akan berjalan untuk compile assets secara real-time.

### Opsi 2: Menjalankan Semua Sekaligus

Gunakan perintah `composer dev` untuk menjalankan server Laravel, queue, logs, dan Vite secara bersamaan:

```bash
composer dev
```

### Login ke Aplikasi

Buka browser dan akses: **http://localhost:8000/login**

Gunakan kredensial default untuk login:

```
Email: admin@perpus.com
Password: password
```

---

## 🗄️ Struktur Database

Aplikasi ini memiliki 4 tabel utama:

| Tabel          | Deskripsi              | Kolom Utama                                                   |
| -------------- | ---------------------- | ------------------------------------------------------------- |
| **users**      | Data pengguna aplikasi | id, name, email, password                                     |
| **categories** | Kategori buku          | id, name                                                      |
| **books**      | Data buku lengkap      | id, category_id, title, author, publisher, year, stock, cover |
| **loans**      | Transaksi peminjaman   | id, book_id, borrower_name, loan_date, return_date, status    |

**Relasi:**

- `books` → `categories` (Many-to-One)
- `loans` → `books` (Many-to-One)
- `loans` → `users` (Many-to-One, jika ada sistem user untuk peminjam)

---

## 📸 Screenshot

### Login

![Dashboard](public/login.png)

### Dashboard

![Dashboard](public/dashboard.png)

### Manajemen Buku

![Manajemen Buku](public/buku.png)

### Sistem Peminjaman

![Sistem Peminjaman](public/peminjaman.png)

---

## 📝 Catatan Tambahan

### Mengubah Database ke SQLite

Jika ingin menggunakan SQLite daripada MySQL, lakukan perubahan berikut:

1. Edit file `.env`:

```env
DB_CONNECTION=sqlite
```

2. Buat file database SQLite kosong:

```bash
# Windows
type nul > database/database.sqlite

# Linux/Mac
touch database/database.sqlite
```

3. Jalankan migrasi ulang:

```bash
php artisan migrate:fresh --seed
```

### Mode Debugging

Untuk mengaktifkan mode debugging (menampilkan error detail):

```env
APP_DEBUG=true
```

Untuk produksi, set ke `false`:

```env
APP_DEBUG=false
```

### Menghapus Semua Data & Reset

Jika ingin menghapus semua data dan mengembalikan ke keadaan awal:

```bash
php artisan migrate:fresh --seed
```

---

## 📄 Lisensi

Project ini dilisensikan di bawah MIT License - lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

---

## 👨‍💻 Developer

Dikembangkan dengan ❤️ oleh **Anggi Febryanti**
