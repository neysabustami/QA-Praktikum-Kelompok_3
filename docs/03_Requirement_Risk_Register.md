<!-- Converted from 03_Requirement_Risk_Register(1).docx; review formatting and image references before submission. -->

# Requirement Review & Risk Analysis (P03)

Dokumentasikan minimal lima requirement dan perbaiki bagian yang ambigu agar testable.

| ID | Requirement yang disarankan | Cara memeriksanya |
| --- | --- | --- |
| REQ – 01 | Sistem harus mengautentikasi pengguna berdasarkan akun yang terdaftar dan mengarahkan pengguna sesuai perannya | Login menggunakan akun uji untuk tiap peran yang tersedia |
| REQ – 02 | Admin harus dapat mengelola data guru sesuai fungsi yang tersedia | Tambah atau ubah data guru, lalu periksa daftar hasilnya |
| REQ – 03 | Admin harus dapat mengelola akun pengguna sesuai fungsi yang tersedia | Periksa penambahan atau perubahan akun yang diizinkan |
| REQ – 04 | Admin harus dapat mengelola kriteria, bobot, serta jenis kriteria yang digunakan dalam perhitungan | Periksa konfigurasi kriteria dan bobot actual |
| REQ – 05 | Penilai harus dapat menyimpan penilaian guru menggunakan pilihan yang tersedia untuk setiap kriteria | Simpan penilaian, buka kembali, lalu cocokkan nilai atau pilihan yang tersimpan |
| REQ – 06 | Sistem harus menghitung nilai preferensi menggunakan aturan konversi, jenis kriteria, bobot, dan rumus SAW yang diterapkan | Bandingkan hasil aplikasi dengan perhitungan manual independent |
| REQ – 07 | Sistem harus menampilkan ranking berdasarkan nilai preferensi sesuai urutan yang ditetapkan | Bandingkan nilai preferensi dan urutan ranking |
| REQ – 08 | Sistem harus membatasi akses fitur dan data sesuai peran pengguna | Uji menu dan halaman yang boleh maupun tidak boleh diakses |
| REQ – 09 | Alur pengesahan harus mengikuti kondisi dan kewenangan yang ditetapkan dalam aplikasi | Periksa status penilaian serta tindakan pengesahan yang diizinkan |

Susun sedikitnya empat acceptance criteria yang observable (dapat menggunakan Given–When–Then).

| ID | Requirement terkait | Acceptance criteria (given – when – then) |
| --- | --- | --- |
| AC – 01 | REQ – 01 – login dan hak akses awal | Given: Pengguna berada pada halaman login dan memiliki akun terdaftar yang aktif. <br><br>When: Pengguna memasukkan username dan password yang benar, kemudian menekan tombol login. <br><br>Then: Sistem mengarahkan pengguna ke dashboard sesuai dengan perannya |
| AC – 02 | REQ – 02 – penyimpanan penilaian | Given: Penilai telah login, data guru tersedia, dan form penilaian dapat diakses. <br><br>When: Penilai mengisi seluruh kriteria wajib menggunakan pilihan yang tersedia, kemudian menekan tombol simpan. Then: Sistem menyimpan penilaian dan menampilkan kembali data yang sama ketika penilaian tersebut dibuka kembali. |
| AC – 03 | REQ – 03 – pengelolaan data user | Given: Admin telah login dan berada pada halaman pengelolaan user. <br><br>When: Admin mengisi seluruh kolom wajib dengan data yang valid, kemudian menekan tombol simpan. <br><br>Then: Sistem menyimpan data user dan menampilkan data tersebut pada daftar user. |
| AC – 04 | REQ – 04 – pengelolaan kriteria dan bobot | Given: Admin telah login dan berada pada halaman pengelolaan kriteria. <br><br>When: Admin menambahkan atau mengubah data kriteria, jenis benefit/cost, dan bobot sesuai ketentuan aplikasi. <br><br>Then: Sistem menyimpan perubahan dan menampilkan data terbaru pada daftar kriteria |
| AC – 05 | REQ – 05 – pengisian penilaian berdasarkan pilihan | Given: Penilai telah login, data guru tersedia, dan pilihan penilaian untuk setiap kriteria telah ditetapkan. <br><br>When: Penilai memilih guru dan menentukan pilihan pada setiap kriteria wajib, kemudian menyimpan penilaian. <br><br>Then: Sistem menyimpan penilaian untuk guru yang dipilih dan menampilkan kembali pilihan yang sama ketika data dibuka kembali. |
| AC – 06 | REQ – 06 – perhitungan metode SAW | Given: Data penilaian yang diperlukan, bobot, jenis kriteria, dan aturan konversi skor telah tersedia. <br><br>When: Proses perhitungan SAW dijalankan menggunakan data tersebut. <br><br>Then: Sistem menghasilkan nilai preferensi setiap guru yang sesuai dengan perhitungan manual menggunakan data, bobot, dan aturan konversi yang sama |
| AC – 07 | REQ – 07 – hasil perankingan | Given: Sistem telah menghasilkan nilai preferensi SAW untuk guru yang memenuhi ketentuan penilaian. <br><br>When: Pengguna yang memiliki hak akses membuka halaman hasil perangkingan. <br><br>Then: Sistem menampilkan nama guru, nilai preferensi, dan peringkat dalam urutan nilai preferensi tertinggi ke terendah. |
| AC – 08 | REQ – 08 – pembatasan has akses | Given: Pengguna telah login menggunakan akun dengan peran tertentu. <br><br>When: Pengguna mencoba membuka halaman atau menjalankan fitur yang tersedia dalam sistem. <br><br>Then: Sistem mengizinkan akses ke fitur yang sesuai dengan hak akses peran tersebut dan menolak akses ke fitur yang tidak diizinkan |

Identifikasi minimal lima risiko kualitas, beri skor likelihood dan impact skala 1–5.

Likelihood – seberapa mungkin masalah terjadi?

![Gambar dari dokumen asli](assets/03_Requirement_Risk_Register_image.png)

Impact – seberapa besar dampaknya?

![Gambar dari dokumen asli](assets/03_Requirement_Risk_Register_image.png)

Rumus menghitung skor Risiko

Gunakan rumus :

![Gambar dari dokumen asli](assets/03_Requirement_Risk_Register_image.png)

Risiko: perhitungan SAW tidak sesuai rumus.

Likelihood = 3, artinya masalah mungkin terjadi.

Impact = 5, artinya dampaknya sangat besar terhadap hasil pemeringkatan.

Maka :

![Gambar dari dokumen asli](assets/03_Requirement_Risk_Register_image.png)

Skor risikonya Adalah 15.

Contoh ini bukan berarti bug perhitungan pasti ada pada aplikasi kamu. Angka tersebut merupakan penilaian awal yang harus ditinjau berdasarkan implementasi dan bukti yang tersedia.

Table resiko kualitas

| ID | Resiko | likelihood | impact | Skor |
| --- | --- | --- | --- | --- |
| R – 01 | Penilaian tidak tersimpan dengan benar | 3 | 5 | 15 |
| R – 02 | Rumus atau normalisasi SAW menghasilkan nilai keliru | 3 | 5 | 15 |
| R – 03 | Urutan ranking tidak sesuai nilai preferensi | 3 | 5 | 15 |
| R – 04 | Penilaian kosong atau tidak valid diproses secara keliru | 3 | 4 | 12 |
| R – 05 | Perubahan nilai tidak tercermin pada hasil terbaru | 3 | 4 | 12 |
| R – 06 | Hak akses tidak sesuai peran pengguna | 2 | 5 | 10 |

Tentukan tiga risiko prioritas serta alasan pemilihan dan residual risk.

R – 01 – penyimpanan penilaian

Mengapa prioritas : Jika nilai tidak tersimpan, sistem dapat kehilangan data yang dibutuhkan untuk perhitungan.

Pengujian yang direncanakan : menyimpan penilaian valid, membuka kembali data, dan membandingkan nilai yang tersimpan.

R – 02 – kesalahan perhitungan SAW

Mengapa prioritas : Perhitungan yang salah dapat menghasilkan nilai preferensi yang keliru.

Pengujian yang direncanakan : menghitung normalisasi dan nilai preferensi secara independen, kemudian membandingkannya dengan hasil aplikasi.

R – 03 – rangking tidak sesuai

Mengapa prioritas : Tujuan utama SPK adalah membantu menghasilkan pemeringkatan. Urutan yang salah dapat membuat hasil seleksi tidak sesuai dengan perhitungan.

Pengujian yang direncanakan : membandingkan urutan ranking dengan urutan nilai preferensi dari hasil hitung acuan.
