# Dokumentasi Sistem Perpustakaan

## Bahan Presentasi Kuliah

---

## 📋 RINGKASAN PROYEK

**Nama Proyek:** Sistem Manajemen Buku Perpustakaan  
**Framework:** Laravel 12  
**PHP:** 8.2.12  
**Styling:** Tailwind CSS  
**Auth:** Manual Auth  
**Database:** MySQL (perpustakaan_db)

---

## 🎯 TUJUAN PEMBELAJARAN

1. **Memahami MVC Pattern:** Controller, Model, View
2. **Implementasi CRUD:** Create, Read, Update, Delete
3. **Relasi Database:** One-to-Many (Kategori - Buku, Buku - Peminjaman)
4. **Session Management:** Login/Logout manual
5. **Middleware:** Proteksi route tanpa login
6. **File Upload:** Upload cover buku
7. **Transaksi Data:** Logika stok berkurang/bertambah

---

## 🗄️ STRUKTUR DATABASE

### 1. Tabel Users (Default Laravel)

-   id, name, email, password, timestamps
-   Digunakan untuk Admin

### 2. Tabel Categories

-   id, name, timestamps
-   Kategori buku (Fiksi, Non-Fiksi, dll)

### 3. Tabel Books

-   id, category_id, title, author, publisher, year, stock, cover, timestamps
-   Data buku dengan cover dan stok

### 4. Tabel Loans

-   id, book_id, borrower_name, loan_date, return_date, status, timestamps
-   Riwayat peminjaman

### Relasi Database:

```
Category (1) → (Many) Books
Book (1) → (Many) Loans
```

---

## 🔐 ALUR OTENTIKASI (LOGIN MANUAL)

### 1. Konsep Session

**Apa itu Session?**

-   Session adalah cara menyimpan data user di server
-   Seperti "tiket" yang diberikan saat login
-   Tiket ini dibawa di setiap request untuk mengidentifikasi user
-   Saat logout, tiket dicabut (session dihapus)

**Kenapa butuh Session?**

-   Agar user tidak perlu login berulang kali
-   Untuk menyimpan state "sudah login" atau "belum login"
-   Untuk mengakses data user yang sedang aktif

### 2. Alur Login

```
1. User isi form (email & password)
2. Submit ke AuthController@login
3. Auth::attempt() cek ke database
   - Jika benar: Session dibuat → Redirect Dashboard
   - Jika salah: Redirect Login dengan error
4. Middleware 'auth' mengecek session di setiap route
```

### 3. Alur Logout

```
1. User klik tombol Logout
2. Auth::logout() - Hapus session
3. Regenerasi token untuk keamanan
4. Redirect ke halaman login
```

---

## 🛡️ MIDDLEWARE SEBAGAI "SATPAM"

**Apa itu Middleware?**

-   Middleware adalah "penjaga gerbang"
-   Memeriksa apakah user memiliki izin sebelum mengakses route
-   Seperti satpam yang memeriksa ID kartu sebelum masuk gedung

**Cara Kerja Middleware 'auth':**

```
Request → Middleware 'auth' (Cek Session)
         ↓
         Session ada? → IZINKAN akses → Controller
         ↓
         Session kosong? → TOLAK → Redirect Login
```

**Contoh Penggunaan:**

```php
Route::middleware(['auth'])->group(function () {
    // Route di sini HANYA bisa diakses setelah login
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('books', BookController::class);
});
```

---

## 📚 FITUR SISTEM

### 1. Manajemen Kategori (CRUD)

-   **Create:** Tambah kategori baru
-   **Read:** Lihat daftar semua kategori
-   **Update:** Edit nama kategori
-   **Delete:** Hapus kategori
-   Validasi input sederhana

### 2. Manajemen Buku (CRUD + Upload)

-   **Create:** Tambah buku dengan cover
-   **Read:** Lihat daftar buku dengan preview cover
-   **Update:** Edit data buku + ganti cover
-   **Delete:** Hapus buku
-   **Fitur Khusus:**
    -   Upload cover buku ke storage
    -   Dropdown kategori (relasi)
    -   Menampilkan stok saat ini
    -   Link storage untuk akses gambar

### 3. Manajemen Peminjaman (Transaksi)

-   **Pinjam Buku:**
    -   Input nama peminjam (manual string)
    -   Pilih buku dari dropdown (hanya buku dengan stok > 0)
    -   Stok buku BERKURANG otomatis
-   **Kembalikan Buku:**
    -   Input tanggal pengembalian
    -   Stok buku BERTAMBAH otomatis
    -   Status berubah menjadi "Dikembalikan"
-   **Riwayat:** Lihat semua peminjaman dengan status

---

## 💡 LOGIKA TRANSAKSI STOK

### Saat Meminjam:

```php
// Cek ketersediaan
if ($book->stock <= 0) {
    return back()->with('error', 'Stok buku tidak tersedia!');
}

// Kurangi stok
$book->decrement('stock');

// Catat peminjaman
Loan::create([
    'book_id' => $request->book_id,
    'borrower_name' => $request->borrower_name,
    'loan_date' => $request->loan_date,
    'status' => 'dipinjam',
]);
```

### Saat Mengembalikan:

```php
// Tambah stok
$loan->book->increment('stock');

// Update status
$loan->update([
    'return_date' => $request->return_date,
    'status' => 'dikembalikan',
]);
```

---

## 🎨 UI/UX SISTEM

### 1. Responsive Design

-   **Desktop Menu:** Navigasi horizontal
-   **Mobile Menu:** Hamburger menu (toggle)
-   Grid system untuk layout yang fleksibel

### 2. Flash Messages

-   Notifikasi sukses (hijau): "Data berhasil disimpan!"
-   Notifikasi error (merah): "Terjadi kesalahan!"
-   Muncul otomatis setelah aksi CRUD

### 3. Styling

-   Menggunakan Tailwind CSS
-   Warna: Biru (navbar), Hijau (sukses), Merah (error), Kuning (warning)
-   Clean & modern interface

---

## ❓ PERTANYAAN UMUM & JAWABAN

### 1. Kenapa Pakai Login Manual?

**Jawaban:**

-   Untuk memahami konsep dasar otentikasi
-   Manual Auth memberikan fleksibilitas lebih besar
-   Bisa custom logika sesuai kebutuhan
-   Cocok untuk sistem yang sederhana
-   Paham cara kerja session di balik layar

**Kelebihan:**

-   Kontrol penuh atas proses login
-   Tidak ada fitur tambahan yang tidak dipakai
-   Lebih ringan

### 2. Keamanan Dasar apa yang diterapkan?

**Jawaban:**

-   **CSRF Protection:** Token di setiap form untuk mencegah Cross-Site Request Forgery
-   **Password Hashing:** Password di-hash otomatis oleh Laravel (Bcrypt)
-   **Session Management:** Session dihapus saat logout
-   **Input Validation:** Validasi data sebelum masuk database
-   **SQL Injection Prevention:** Menggunakan Eloquent ORM (parameter binding otomatis)

### 3. Kenapa menggunakan Middleware?

**Jawaban:**

-   Reusability: Satu middleware bisa dipakai di banyak route
-   Separation of Concerns: Logika otentikasi terpisah dari controller
-   Security Layer: Lapisan keamanan tambahan sebelum mengakses data
-   Code Clean: Tidak perlu cek login di setiap controller

### 4. Apa itu Route::resource()?

**Jawaban:**

-   Shortcut untuk membuat 7 route CRUD sekaligus:
    1. index (GET) - Tampilkan semua data
    2. create (GET) - Form tambah data
    3. store (POST) - Simpan data baru
    4. show (GET) - Detail satu data
    5. edit (GET) - Form edit data
    6. update (PUT/PATCH) - Update data
    7. destroy (DELETE) - Hapus data
-   Mengikuti standar RESTful API
-   Hemat waktu dan konsisten

### 5. Bagaimana cara relasi di Laravel?

**Jawaban:**

-   Menggunakan Eloquent Relationships
-   One-to-Many: `hasMany()` dan `belongsTo()`
-   Contoh:

    ```php
    // Di Model Category
    public function books() {
        return $this->hasMany(Book::class);
    }

    // Di Model Book
    public function category() {
        return $this->belongsTo(Category::class);
    }
    ```

-   Bisa akses relasi dengan: `$book->category->name`

---

## 🚀 CARA MENJALANKAN PROYEK

### 1. Setup Database

```bash
# Buat database MySQL: perpustakaan_db
# Update .env:
DB_DATABASE=perpustakaan_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 2. Jalankan Migrations

```bash
php artisan migrate
```

### 3. Jalankan Seeder

```bash
php artisan db:seed --class=UserSeeder
```

### 4. Setup Storage Link

```bash
php artisan storage:link
```

### 5. Jalankan Development Server

```bash
php artisan serve
```

### 6. Akses Aplikasi

-   URL: http://localhost:8000
-   Login: admin@perpus.com
-   Password: password

---

## 📁 STRUKTUR FOLDER

```
app/
├── Http/
│   └── Controllers/
│       ├── AuthController.php       (Login/Logout)
│       ├── DashboardController.php (Halaman dashboard)
│       ├── CategoryController.php   (CRUD Kategori)
│       ├── BookController.php      (CRUD Buku + Upload)
│       └── LoanController.php      (Transaksi Peminjaman)
├── Models/
│   ├── User.php                  (Model User)
│   ├── Category.php              (Model Kategori)
│   ├── Book.php                 (Model Buku)
│   └── Loan.php                 (Model Peminjaman)

database/
├── migrations/
│   ├── create_users_table.php
│   ├── create_categories_table.php
│   ├── create_books_table.php
│   └── create_loans_table.php
└── seeders/
    └── UserSeeder.php            (Data Admin)

resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php        (Layout utama)
│   ├── auth/
│   │   └── login.blade.php     (Halaman login)
│   ├── dashboard.blade.php       (Dashboard)
│   ├── categories/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── books/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   └── loans/
│       ├── index.blade.php
│       ├── create.blade.php
│       └── edit.blade.php

routes/
└── web.php                      (Routing)
```

---

## 🎓 TIPS PRESENTASI

### 1. Mulai dengan Gambaran Besar

-   Jelaskan apa itu sistem perpustakaan
-   Sebutkan fitur-fitur utama
-   Tunjukkan UI aplikasi secara live

### 2. Jelaskan Konsep Teknis

-   MVC Pattern
-   Database & Relasi
-   Auth & Session
-   Middleware
-   CRUD Operations

### 3. Tunjukkan Kode

-   Pilih bagian kode yang penting
-   Jelaskan logika transaksi stok
-   Tunjukkan relasi antar model

### 4. Demo Fitur

-   Login admin
-   Tambah kategori
-   Tambah buku (dengan upload cover)
-   Proses peminjaman
-   Proses pengembalian

### 5. Jawab Pertanyaan dengan Percaya Diri

-   Jangan panik jika ditanya hal teknis
-   Jelaskan dengan bahasa sederhana
-   Gunakan analogi jika perlu (contoh: Satpam untuk middleware)

---

## ✅ CHECKLIST SEBELUM PRESENTASI

-   [ ] Project sudah running tanpa error
-   [ ] Database sudah di-setup
-   [ ] Admin sudah dibuat via seeder
-   [ ] Storage link sudah dibuat
-   [ ] Semua fitur sudah ditest:
    -   [ ] Login/Logout
    -   [ ] CRUD Kategori
    -   [ ] CRUD Buku
    -   [ ] Peminjaman
    -   [ ] Pengembalian
-   [ ] Siap dengan pertanyaan dosen
-   [ ] Backup project di-drive/cloud

---

## 🎉 SELESAI!

Selamat! Anda sudah berhasil membangun sistem perpustakaan dengan Laravel.

**Apa yang telah dipelajari:**

-   ✅ MVC Pattern
-   ✅ Database & Migrations
-   ✅ Relasi antar tabel
-   ✅ Authentication Manual
-   ✅ Session Management
-   ✅ Middleware
-   ✅ CRUD Operations
-   ✅ File Upload
-   ✅ Transaksi Data
-   ✅ Tailwind CSS
-   ✅ Responsive Design

**Langkah Selanjutnya:**

-   Tambahkan fitur pencarian buku
-   Tambahkan export laporan peminjaman
-   Implementasi multi-role (Admin & Member)
-   Tambahkan sistem denda (keterlambatan)
-   Tambahkan notifikasi email

Good luck dengan presentasinya! 🚀
