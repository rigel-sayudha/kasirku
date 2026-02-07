# Kasirku

A simple PHP-based point-of-sale (POS) / cashier system.

## Deskripsi

`Kasirku` adalah aplikasi kasir berbasis PHP (CodeIgniter style) untuk kebutuhan manajemen barang, transaksi, pelanggan, dan laporan. Project ini berisi frontend admin panel dan modul kasir, integrasi pembayaran (Midtrans/veritrans), serta file SQL contoh untuk membuat database.

## Fitur utama

- Manajemen barang, kategori, supplier
- Modul kasir dan transaksi
- Laporan penjualan
- Integrasi Midtrans / Veritrans

## Persyaratan

- PHP 7.2+ (disarankan sesuai environment XAMPP yang digunakan)
- MySQL / MariaDB
- Composer (jika ingin memperbarui dependensi)
- Webserver (XAMPP, WAMP, atau built-in PHP server)

## Instalasi (lokal)

1. Clone repository:

   git clone https://github.com/rigel-sayudha/kasirku.git
   cd kasirku

2. Tempatkan project ke folder webserver (contoh XAMPP):
   - Salin folder ke `C:\xampp\htdocs\kasirku` atau path webroot serupa.

3. Buat database dan import SQL:
   - Buat database baru lewat phpMyAdmin atau CLI, mis. `kasirku_db`.
   - Import file `kasirku.sql` yang ada di root repository.

4. Konfigurasi koneksi database dan base URL:
   - Buka file konfigurasi: `application/config/database.php` dan sesuaikan `hostname`, `username`, `password`, dan `database`.
   - Buka `application/config/config.php` dan sesuaikan `base_url` (mis. `http://localhost/kasirku/`).

5. Install dependensi (opsional):
   - Composer: jika Anda ingin memperbarui atau menginstal library PHP, jalankan `composer install` di root project.
   - Node/npm: ada `package.json` dan `server.js` untuk utilitas tertentu — tidak penting untuk menjalankan aplikasi PHP utama.

## Menjalankan aplikasi

- Jika menggunakan XAMPP: mulai Apache dan MySQL, lalu akses `http://localhost/kasirku/`.
- Jika ingin menggunakan built-in PHP server (untuk pengujian), jalankan di folder project:

  php -S localhost:8000

  lalu buka `http://localhost:8000/` (sesuaikan routing jika menggunakan framework).

## Catatan konfigurasi tambahan

- Integrasi pembayaran: cek file `application/libraries/Midtrans.php`, `application/libraries/Veritrans.php` dan konfigurasi API key bila diperlukan.
- Upload dan permission: pastikan folder `assets/upload/` dan folder cache/logs memiliki permission untuk ditulis oleh webserver.

## Troubleshooting

- Jika halaman blank: aktifkan error reporting di `index.php` atau cek log di folder `application/logs/`.
- Koneksi DB gagal: periksa kembali kredensial di `application/config/database.php` dan pastikan database sudah diimport.

## Contributing

- Perbaikan atau fitur baru: buat branch, lakukan perubahan, dan buat pull request ke repository upstream jika Anda ingin berkontribusi.

## Lisensi

- Periksa file `license.txt` untuk informasi lisensi proyek.

## Kontak

- Untuk pertanyaan terkait repository ini, buka halaman GitHub: https://github.com/rigel-sayudha/kasirku
