# QA-Praktikum-Kelompok_3
SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN GURU BERPRESTASI MENGGUNAKAN METODE SAW

A. Identitas Kelompok

Kelompok 3

Anggota kelompok:

Neysa Rizqi Putri Bustami (23076072)

Ratu Intan Muliani (23076076)

Sultan Rafif Sidik (23076079)

Zharif Pratama (23076081)

B. Informasi Aplikasi

| Keterangan | Informasi |
| --- | --- |
| Nama Aplikasi | Sistem Pendukung Keputusan Pemilihan Guru Berprestasi |
| Jenis Aplikasi | Aplikasi Berbasis Web |
| Metode | Simple Additive Weighting (SAW) |
| Versi Aplikasi | 1.0 |
| Status | Testing |
| Bahasa Pemrograman | PHP Native |
| Database | db_spk_final |
| DBMS | MariaDB/MySQL |
| Web Server | Apache |
| Environment | XAMPP |
| Platform | Web Browser |
| Alamat Pengujian | localhost |

C. Deskripsi dan Tujuan Aplikasi

Sistem Pendukung Keputusan Pemilihan Guru Berprestasi merupakan aplikasi berbasis web yang dikembangkan untuk membantu proses pemilihan guru berprestasi berdasarkan kriteria dan bobot penilaian yang telah ditentukan.

Aplikasi ini menggunakan metode Simple Additive Weighting (SAW), yaitu metode pengambilan keputusan dengan melakukan normalisasi nilai berdasarkan jenis kriteria, kemudian mengalikan nilai normalisasi dengan bobot masing-masing kriteria untuk memperoleh nilai akhir dan menentukan peringkat alternatif.

Tujuan pengembangan aplikasi:

Membantu proses pemilihan guru berprestasi secara lebih terstruktur.

Mempermudah pengelolaan data guru, kriteria, bobot, dan penilaian.

Melakukan perhitungan nilai menggunakan metode SAW.

Menghasilkan nilai akhir dan peringkat guru berdasarkan hasil perhitungan.

Meningkatkan ketepatan dan transparansi proses pengambilan keputusan.

D. Cara Menjalankan Aplikasi

Aplikasi dijalankan menggunakan environment lokal XAMPP dengan PHP Native dan database MySQL/MariaDB.

Persiapan

Perangkat dan aplikasi yang dibutuhkan:

XAMPP.

Web Browser (Google Chrome atau browser lainnya).

Source code aplikasi.

File database atau SQL untuk kebutuhan instalasi database.

Langkah Menjalankan Aplikasi

Instal dan buka XAMPP.

Aktifkan Apache dan MySQL melalui XAMPP Control Panel.

Salin folder source code aplikasi ke dalam direktori htdocs.

Buka phpMyAdmin melalui http://localhost/phpmyadmin.

Buat database sesuai dengan nama database yang digunakan aplikasi.

Import file database .sql ke database yang telah dibuat.

Sesuaikan konfigurasi koneksi database pada file konfigurasi aplikasi, meliputi hostname, username, password, dan nama database.

Buka browser dan akses alamat aplikasi melalui:

Login SPK Guru

Login menggunakan akun pengujian sesuai dengan peran pengguna yang tersedia.

Catatan: Nama folder aplikasi, nama database, dan konfigurasi koneksi harus disesuaikan dengan source code yang digunakan.

E. Cara Memeriksa dan Melakukan Pengujian

Pengujian dilakukan menggunakan metode Black Box Testing, yaitu pengujian yang berfokus pada fungsi aplikasi berdasarkan input dan output tanpa memeriksa kode program secara langsung.

Pengujian mencakup beberapa bagian berikut:

| No. | Bagian yang Diuji | Aspek Pengujian |
| --- | --- | --- |
| 1 | Login | Validasi username, password, dan hak akses pengguna |
| 2 | Data Guru | Penambahan, pengubahan, penghapusan, dan validasi data guru |
| 3 | Data Kriteria | Pengelolaan kriteria dan bobot penilaian |
| 4 | Penilaian | Input dan validasi nilai guru |
| 5 | Perhitungan SAW | Normalisasi dan perhitungan nilai akhir |
| 6 | Hasil Perangkingan | Kesesuaian nilai akhir dan urutan peringkat |

Langkah Pemeriksaan Pengujian

Jalankan aplikasi melalui browser.

Lakukan login menggunakan akun dengan peran Admin, Kepala Sekolah, atau Penilai sesuai skenario pengujian.

Jalankan setiap test case berdasarkan dokumen pengujian yang telah disusun.

Masukkan data sesuai dengan kondisi pengujian.

Amati respons sistem setelah setiap tindakan dilakukan.

Bandingkan hasil aktual (Actual Result) dengan hasil yang diharapkan (Expected Result).

Catat status pengujian, yaitu Pass atau Fail.

Dokumentasikan hasil pengujian melalui screenshot sebagai bukti.

Dokumentasi pengujian dapat diperiksa melalui dokumen test case, hasil pengujian, screenshot, dan bukti perhitungan manual metode SAW.

F. Environment dan Izin Pengujian

Pengujian dilakukan pada lingkungan lokal dengan konfigurasi berikut:

| Komponen | Environment |
| --- | --- |
| Jenis Aplikasi | Web Application |
| Bahasa Pemrograman | PHP Native |
| Database | db_spk_final |
| Web Server | Apache |
| Local Server | XAMPP |
| Database Management | phpMyAdmin |
| Browser | Google Chrome (sesuaikan dengan browser aktual) |
| Alamat Aplikasi | localhost |

Hak Akses Pengujian

Pengujian dilakukan menggunakan beberapa peran pengguna yang tersedia dalam aplikasi:

Admin: Mengelola data dan konfigurasi sistem sesuai hak aksesnya.

Kepala Sekolah: Mengakses fungsi yang berkaitan dengan proses dan hasil pemilihan guru berprestasi sesuai hak aksesnya.

Penilai: Melakukan proses penilaian guru sesuai hak aksesnya.

Pengujian dilakukan pada lingkungan lokal menggunakan akun dan data uji yang telah disiapkan. Pengujian tidak menggunakan data produksi.

G. Ringkasan Hasil Pengujian

Pengujian aplikasi direncanakan untuk memastikan seluruh fungsi berjalan sesuai kebutuhan dan skenario pengujian yang telah ditentukan.

Aspek yang menjadi fokus evaluasi meliputi:

Keberhasilan proses autentikasi dan pembatasan hak akses.

Kesesuaian fungsi pengelolaan data guru dan kriteria.

Validasi input penilaian.

Ketepatan proses perhitungan menggunakan metode SAW.

Kesesuaian hasil akhir dan perangkingan guru.

Status hasil pengujian:

Versi aplikasi yang diuji adalah versi 1.0. Berdasarkan dokumen test case, terdapat 3 skenario pengujian dengan total 12 test case yang disiapkan.

Status setiap test case perlu diperbarui berdasarkan hasil pengujian aktual, dengan kategori:

Pass: Hasil aktual sesuai dengan hasil yang diharapkan.

Fail: Hasil aktual tidak sesuai dengan hasil yang diharapkan.

Not Tested: Pengujian belum dilakukan.

Ringkasan jumlah pengujian:

| Keterangan | Jumlah |
| --- | --- |
| Total Test Case | 17 |
| Pass | 10 |
| Fail | 1 |
| Not Tested | 6 |

H. Video Demonstrasi Aplikasi

Video demonstrasi berisi penjelasan dan penggunaan aplikasi, mulai dari proses login, pengelolaan data, proses penilaian, perhitungan metode SAW, hingga hasil perangkingan guru berprestasi.

Link YouTube:

[Masukkan tautan video YouTube di sini]

Kelompok 3

Sistem Pendukung Keputusan Pemilihan Guru Berprestasi Menggunakan Metode SAW.
