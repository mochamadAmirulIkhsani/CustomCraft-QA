# Unit Testing Documentation - CustomCraft Laravel CRUD

## Overview

Unit testing untuk modul Login, Registrasi, dan Portfolio telah berhasil dibuat menggunakan **PEST PHP Testing Framework**.

## 📁 File Structure

```
tests/
├── Unit/
│   ├── LoginTest.php           # 10 test cases untuk modul Login
│   ├── RegistrationTest.php    # 15 test cases untuk modul Registrasi
│   └── PortfolioTest.php       # 23 test cases untuk modul Portfolio
└── Pest.php                    # Konfigurasi PEST
```

## 🚀 Cara Menjalankan Test

### Menjalankan Semua Unit Test

```bash
./vendor/bin/pest tests/Unit/
```

### Menjalankan Test Spesifik

**Login Test:**

```bash
./vendor/bin/pest tests/Unit/LoginTest.php
```

**Registration Test:**

```bash
./vendor/bin/pest tests/Unit/RegistrationTest.php
```

**Portfolio Test:**

```bash
./vendor/bin/pest tests/Unit/PortfolioTest.php
```

### Menjalankan Test dengan Coverage

```bash
./vendor/bin/pest --coverage
```

## 📋 Test Coverage

### 1. Login Unit Tests (10 Tests)

-   ✅ Validasi kredensial user dengan password yang benar
-   ✅ Validasi kredensial gagal dengan password yang salah
-   ✅ Email user disimpan dengan benar
-   ✅ Role user disimpan dengan benar
-   ✅ Admin dapat login dengan role admin
-   ✅ Password di-hash saat disimpan
-   ✅ Model User memiliki fillable fields yang required
-   ✅ Password dan remember_token disembunyikan
-   ✅ Multiple users dapat memiliki kredensial berbeda
-   ✅ Email user harus unik

### 2. Registration Unit Tests (15 Tests)

-   ✅ User baru dapat dibuat dengan data valid
-   ✅ Email disimpan dalam format yang benar
-   ✅ Password otomatis di-hash
-   ✅ User memiliki default role
-   ✅ Multiple users dapat didaftarkan
-   ✅ Nama user disimpan dengan benar
-   ✅ Email harus unik di database
-   ✅ Validasi fillable fields model User
-   ✅ Password field disembunyikan dari array
-   ✅ Remember_token disembunyikan dari array
-   ✅ User memiliki timestamp fields
-   ✅ User dapat memiliki role admin
-   ✅ Password hashing konsisten
-   ✅ Validasi format email
-   ✅ User ID auto-generated

### 3. Portfolio Unit Tests (23 Tests)

-   ✅ Portfolio dapat dibuat dengan data valid
-   ✅ Slug auto-generated dari name
-   ✅ Portfolio belongs to Product
-   ✅ Portfolio dapat diset sebagai active
-   ✅ Portfolio dapat diset sebagai inactive
-   ✅ Portfolio memiliki fillable fields yang benar
-   ✅ is_active di-cast ke boolean
-   ✅ Portfolio menggunakan slug sebagai route key
-   ✅ Multiple portfolios dapat dibuat
-   ✅ Portfolio dapat diupdate
-   ✅ Portfolio dapat dihapus
-   ✅ Portfolio dapat difilter by active status
-   ✅ Description portfolio disimpan dengan benar
-   ✅ Image path disimpan
-   ✅ Portfolio memiliki timestamps
-   ✅ Portfolio ID auto-generated
-   ✅ Name portfolio required saat create
-   ✅ Slug portfolio unique saat generated
-   ✅ Portfolio dapat load product relationship
-   ✅ Active portfolios dapat diambil
-   ✅ Slug menangani special characters
-   ✅ Portfolio dapat ditemukan by slug
-   ✅ Portfolio memiliki image validation rules

## 📦 Dependencies

### Packages Installed

-   `pestphp/pest` v3.8.4
-   `pestphp/pest-plugin` v3.0.0
-   `pestphp/pest-plugin-arch` v3.1.1
-   `pestphp/pest-plugin-mutate` v3.0.5

### Laravel Features Used

-   `RefreshDatabase` trait untuk clean database setiap test
-   Model Factories untuk data testing
-   Laravel's Hash facade untuk password hashing

## 📝 Factory Files

### PortfolioFactory.php

Factory baru telah dibuat untuk model Portfolio dengan fitur:

-   Auto-generate data portfolio
-   State methods: `active()`, `inactive()`
-   Method `forProduct()` untuk assign product tertentu

## ⚙️ Configuration

### Pest.php

```php
pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature', 'Unit');
```

RefreshDatabase diaktifkan untuk memastikan database bersih setiap menjalankan test.

## 🎯 Best Practices

1. **Gunakan Describe Blocks**: Semua test menggunakan `describe()` untuk grouping yang lebih baik
2. **BeforeEach Hooks**: Setup data yang diperlukan sebelum setiap test
3. **Descriptive Test Names**: Nama test yang jelas dan deskriptif
4. **Expect Syntax**: Menggunakan PEST's expect syntax untuk assertion yang lebih readable
5. **Factory Usage**: Memanfaatkan factories untuk generate test data

## 📊 Test Results

```
Tests:    70 passed (153 assertions)
Duration: ~2.5s
```

### Breakdown:

-   **LoginTest**: 10 tests passed (18 assertions)
-   **RegistrationTest**: 15 tests passed (38 assertions)
-   **PortfolioTest**: 23 tests passed (46 assertions)

## 🔧 Troubleshooting

### Jika test gagal karena database:

```bash
php artisan migrate:fresh
./vendor/bin/pest tests/Unit/
```

### Jika ada error Permission:

```bash
php artisan cache:clear
php artisan config:clear
composer dump-autoload
```

## 📚 Additional Resources

-   [PEST Documentation](https://pestphp.com/)
-   [Laravel Testing Documentation](https://laravel.com/docs/testing)
-   [PEST Expectations](https://pestphp.com/docs/expectations)

## 👨‍💻 Author

Created for CustomCraft-Laravel_CRUD project using PEST PHP Testing Framework.

---

**Note**: Pastikan untuk menjalankan test secara regular untuk memastikan kode tetap stabil saat melakukan perubahan.
