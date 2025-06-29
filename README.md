# 📂 Website Pengarsipan Polbeng — Politeknik Negeri Bengkalis
Repositori ini merupakan implementasi **Website Pengarsipan** berbasis web yang dikembangkan sebagai Proyek oleh **mahasiswa Politeknik Negeri Bengkalis**. Sistem ini ditujukan untuk mendukung proses pengarsipan dokumen secara digital, serta memudahkan admin dalam mengelola dan memverifikasi data yang diarsipkan

---

## ✨ Fitur Utama
1. 🔐 **Otentikasi Dua Peran (Role)**
   Sistem memiliki dua peran pengguna:
   - User — Mengunggah dan mengelola dokumen/arsip pribadi.
   - Admin — Mengelola seluruh arsip, pengguna, dan sistem.

2. 📥 **Login yang Mudah**
   Pengguna dapat login menggunakan kombinasi email dan password yang sudah terdaftar.

3. 🛡️ **Keamanan dengan Laravel Fortify**
   Sistem keamanan login dibangun dengan Laravel Fortify untuk otentikasi yang aman dan fleksibel.

4. ⚙️ **Sistem Pengarsipan yang Efisien**
   Pengguna dapat mengunggah, mengkategorikan, dan mencari arsip dengan alur yang intuitif.

5. 🔔 **Notifikasi Real-Time**
   Admin dan pengguna akan mendapatkan notifikasi secara langsung jika ada pembaruan penting atau perubahan status pada arsip yang relevan.
---

## 🚀 Cara Clone & Menjalankan Project

Berikut adalah langkah-langkah untuk menjalankan aplikasi secara lokal:

### 1. Clone Repository

```bash
git clone -b Pengarsipan-Polbeng https://github.com/BimaFdilana/project-app-web-laravel.git
cd project-app-web-laravel
```

### 2. Install Dependency

```bash
composer install
npm install
```

### 3. Konfigurasi .Env

```bash
cp .env.example .env
```
lalu sesuaikan .env dengan database yang akan digunakan
```bash
APP_NAME=LabApp
APP_URL=http://localhost:8000

DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your_id
PUSHER_APP_KEY=your_key
PUSHER_APP_SECRET=your_secret
```

### 4. Generate Key

```bash
php artisan key:generate
```

### 5. Migrate Database

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### 6. Run Development Server

```bash
php artisan serve
```

### 7. Akses Aplikasi

Buka browser dan akses aplikasi di `http://localhost:8000`.


# 👥 Akun Default (Untuk Pengujian)

## Mahasiswa
NIM: 1234567890
Email: budi@pinlab.com
Password: password12345

## Kepala Labor
NIM: 0000000001
Email: admin@pinlab.com
Password: password12345


