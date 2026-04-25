# 📌 Aplikasi Absensi Karyawan

Aplikasi berbasis web yang digunakan untuk mengelola data kehadiran karyawan secara digital.

---

## 👤 Identitas

| Keterangan | Detail                   |
| ---------- | ------------------------ |
| Nama       | **Sufyan Nazar Prabowo** |
| NIM        | **220102025**            |

---

## 🔐 Akun Login

### 👨‍💼 Admin

* **Email**: `admin@gmail.com`
* **Password**: `admin123`

### 👷 Karyawan

* **Email**: `karyawan@gmail.com`
* **Password**: `karyawan`

---

## 🚀 Fitur Aplikasi

### 🔹 Admin

* Login sebagai admin
* Kelola data karyawan (tambah, edit, hapus)
* Melihat seluruh data absensi
* Monitoring kehadiran karyawan
* Laporan absensi

### 🔹 Karyawan

* Login sebagai karyawan
* Absen masuk & pulang
* Melihat riwayat absensi
* Update profil (opsional)

---

## 🔄 Alur Sistem

### 1. Login

1. User memasukkan email & password
2. Sistem memverifikasi akun
3. User diarahkan ke dashboard sesuai role

---

### 2. Alur Admin

1. Login sebagai admin
2. Masuk ke dashboard admin
3. Mengelola data karyawan
4. Melihat dan memonitor absensi
5. Mengakses laporan kehadiran

---

### 3. Alur Karyawan

1. Login sebagai karyawan
2. Masuk ke dashboard
3. Melakukan:

   * Absen masuk
   * Absen pulang
4. Data tersimpan ke database
5. Melihat riwayat absensi

---

## ⚙️ Teknologi

* Laravel
* MySQL
* Blade Template
* Node.js (optional untuk asset)

---

## 📂 Cara Menjalankan

```bash
# Install dependency
composer install
npm install

# Copy file env
cp .env.example .env

# Generate key
php artisan key:generate

# Jalankan server
php artisan serve

# Jalankan asset
npm run dev
```

---

## 📌 Catatan

* Pastikan konfigurasi database di file `.env` sudah benar
* Import database jika tersedia file `.sql`
* Pastikan folder `storage` dan `bootstrap/cache` memiliki izin akses

---

## 🎯 Tujuan

Aplikasi ini dibuat untuk mempermudah pengelolaan absensi karyawan agar lebih:

* Efisien
* Akurat
* Mudah dipantau

---
