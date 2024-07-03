link Domain : https://uasweb2mrahmadani.000webhostapp.com/index.php
Username : 211011401955 
Password : 12345
link regist user : https://uasweb2mrahmadani.000webhostapp.com/register.php

# Aplikasi Web UEFA 2024

Aplikasi web ini dirancang untuk mengelola data turnamen UEFA 2024, termasuk data peringkat negara, grup, dan autentikasi pengguna.

## Fitur

### Login dan Autentikasi

**File**: `login.php`, `register.php`, `logout.php`

**Deskripsi**: 
- `login.php`: Mengelola proses login pengguna menggunakan metode POST. Memvalidasi kredensial pengguna dengan data yang tersimpan di basis data (`users` table).
- `register.php`: Memungkinkan pengguna baru untuk mendaftar dengan menyediakan NIM (ID pengguna) unik dan kata sandi.
- `logout.php`: Mengakhiri sesi pengguna dan mengarahkan kembali ke halaman login.

### Lihat Data

**File**: `view_data.php`

**Deskripsi**: 
- Menampilkan data turnamen untuk semua negara yang berpartisipasi dalam UEFA 2024.
- Mengambil data dari tabel `countries` dan melakukan join dengan tabel `groups` untuk menampilkan informasi grup.
- Memerlukan autentikasi pengguna (`$_SESSION['user_id']`) untuk mengaksesnya. Akan diarahkan ke `login.php` jika pengguna tidak terautentikasi.

### Input Data

**File**: `input_data.php`

**Deskripsi**: 
- Memungkinkan pengguna yang sudah terautentikasi untuk memasukkan/memperbarui hasil pertandingan untuk negara yang berpartisipasi.
- Menyediakan formulir dan validasi untuk memastikan entri data yang akurat.
- Hanya dapat diakses oleh pengguna yang sudah terautentikasi. Akan diarahkan ke `login.php` jika pengguna tidak terautentikasi.

### Generate PDF

**File**: `generate_pdf.php`

**Deskripsi**: 
- Menghasilkan laporan PDF dari peringkat turnamen (`countries` table).
- Menggunakan library `FPDF` untuk membuat dokumen PDF.
- Termasuk informasi berikut:
  - Nama turnamen: UEFA 2024
  - Tanggal dan waktu saat ini dengan format: `dd/bulan/tahun jam/menit/detik`
  - Identifier grup: "Data Group B"
  - Tabel peringkat negara termasuk kemenangan, seri, kekalahan, dan poin.

## Instruksi Instalasi

1. **Setup Basis Data**: Impor `uefa2024.sql` ke instance MariaDB Anda.
2. **Konfigurasi**: Perbarui `config.php` dengan kredensial basis data Anda.
3. **Server Web**: Deploy file-file ke direktori server web Anda (`htdocs` untuk XAMPP).

## Persyaratan

- PHP >= 8.0
- MariaDB atau MySQL
- Server Web (mis. Apache)
- Library FPDF untuk generasi PDF

## Penggunaan

1. Akses aplikasi web melalui browser Anda.
2. Login dengan kredensial yang valid atau daftar sebagai pengguna baru.
3. Navigasi ke halaman-halaman berbeda untuk melihat data, memasukkan hasil pertandingan, dan menghasilkan laporan PDF.

