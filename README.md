# Laravel 10
This is a clean and minimal **Laravel 10** starter project.  
It contains no additional packages, scaffolding, or customizations — perfect for starting fresh Laravel projects.


### 🚀 Features
- ✅ Auth ( Login & Register )
- ✅ Auth Role ( Admin & User )
- ✅ Auth View ( Component, Layout, Page )
- ✅ Laravel Fortify 

### 1. Clone the repository
```javascript
git clone https://github.com/BimaFdilana/project-app-web-laravel.git
cd your-project-name
```

### 2. Install dependencies
```javascript
composer install
```

### 3. Copy .env file and set your environment
```javascript
cp .env.example .env
```

### 5. Run migrations & Start the development server
```javascript
php artisan migrate
php artisan serve
```
---

### 🎯 Role-Based Access Control (RBAC) Sederhana di Laravel Fortify
Aplikasi ini menggunakan sistem role sederhana untuk membatasi akses user ke halaman, route, dan fitur tertentu berdasarkan peran (role).

## 🖼️ Penggunaan Role di Blade View

```javascript

{{-- Tampilkan menu khusus admin --}}
@if (auth()->user()->role === 'admin')
    <a href="/admin">Admin Panel</a>
@endif

{{-- Tampilkan menu kasir --}}
@if (auth()->user()->role === 'kasir')
    <a href="/kasir">Transaksi</a>
@endif

```

## 🧩 Penggunaan Role di Controller

```javascript

public function index()
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    // logic admin
    return view('admin.dashboard');
}

```


## 🧭 Penggunaan Role di Route

```javascript

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn () => view('admin.dashboard'));
});

Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir', fn () => view('kasir.dashboard'));
});

```

**Start editing** the left panel to see your markdown come to life! 🚀
