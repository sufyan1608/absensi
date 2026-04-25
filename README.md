📌 APLIKASI ABSENSI KARYAWAN
👤 Identitas
Nama : Sufyan Nazar Prabowo
NIM : 220102025
🔐 Akun Login
👨‍💼 Admin
Username : admin@gmail.com
Password : admin123
👷 Karyawan
Username : karyawan@gmail.com
Password : karyawan
🚀 Fitur Aplikasi
🔹 Fitur Admin
Login sebagai admin
Mengelola data karyawan (tambah, edit, hapus)
Melihat data absensi karyawan
Melihat laporan kehadiran
Mengelola data jabatan / divisi (jika tersedia)
Monitoring aktivitas absensi
🔹 Fitur Karyawan
Login sebagai karyawan
Melakukan absensi (masuk & pulang)
Melihat riwayat absensi pribadi
Mengupdate profil (jika tersedia)
🔄 Alur Sistem
1. Login
User masuk menggunakan email & password
Sistem memverifikasi data akun
Jika benar → masuk ke dashboard sesuai role
2. Admin Flow
Admin login
Masuk ke dashboard admin
Mengelola data karyawan
Melihat data absensi semua karyawan
Generate / melihat laporan
3. Karyawan Flow
Karyawan login
Masuk ke dashboard karyawan
Melakukan absensi:
Absen masuk
Absen pulang
Data tersimpan ke database
Karyawan bisa melihat riwayat absensi
4. Sistem Absensi
Waktu absensi dicatat otomatis oleh sistem
Data tersimpan ke database
Bisa digunakan untuk laporan kehadiran
⚙️ Teknologi yang Digunakan
Laravel (Backend)
Blade Template (Frontend)
MySQL (Database)
Node.js (Asset Management - jika digunakan)
📂 Cara Menjalankan Project

Install dependency

composer install
npm install

Copy file environment

cp .env.example .env

Generate key

php artisan key:generate
Setting database di file .env
Import database (jika ada file .sql)

Jalankan server

php artisan serve

Jalankan asset (jika pakai)

npm run dev
📌 Catatan
Pastikan database sudah sesuai konfigurasi
Folder storage dan bootstrap/cache memiliki permission
🎯 Tujuan Aplikasi

Aplikasi ini dibuat untuk mempermudah proses absensi karyawan secara digital, sehingga lebih efisien, akurat, dan mudah dipantau oleh admin.
