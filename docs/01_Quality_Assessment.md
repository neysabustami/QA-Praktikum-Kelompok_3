<!-- Converted from 01_Quality_Assessment.docx; review formatting and image references before submission. -->

# Software Quality Assessment

## Deskripsi Aplikasi

Sistem Pendukung Keputusan Pemilihan Guru Berprestasi Menggunakan Metode Simple Additive Weighting (SAW) merupakan aplikasi berbasis web yang digunakan untuk membantu proses penilaian dan pemeringkatan guru berdasarkan sejumlah kriteria yang telah ditentukan.

Aplikasi ini mendukung pengelolaan data guru, kriteria penilaian, pengisian nilai, pengolahan nilai menggunakan metode SAW, dan penyajian hasil perangkingan. Pengguna sistem memiliki hak akses sesuai perannya.

## Tujuan Pengujian

Memastikan setiap pengguna dapat login sesuai akun dan hak aksesnya.

Memastikan pengelolaan data guru, data pengguna, dan kriteria berjalan dengan benar.

Memastikan data penilaian tersimpan sesuai nilai yang dimasukkan.

Memastikan validasi input penilaian berjalan sesuai ketentuan.

Memastikan perhitungan normalisasi dan nilai preferensi menggunakan metode SAW sesuai rumus.

Memastikan hasil perangkingan sesuai dengan nilai preferensi.

Memastikan laporan dapat ditampilkan atau dicetak apabila fitur tersebut tersedia.

## Atribut Kualitas

Functional suitability: fungsi aplikasi harus bekerja sesuai kebutuhan yang ditetapkan.

Reliability: aplikasi harus memproses dan menyimpan data dengan benar pada kondisi pengujian yang ditentukan.

Usability: halaman, formulir, informasi, dan pesan sistem harus dapat dipahami pengguna.

## QA dan QC

Quality Assurance (QA) berfokus pada perencanaan proses untuk menjaga kualitas, sedangkan Quality Control (QC) berfokus pada pemeriksaan hasil aplikasi untuk menemukan ketidaksesuaian.

Dalam praktikum ini, perencanaan pengujian dan penetapan kriteria termasuk kegiatan QA, sedangkan pelaksanaan test case dan pemeriksaan hasil termasuk kegiatan QC.

## Potensi Masalah dan Dampaknya

| ID masalah | Potensi masalah | Dampak |
| --- | --- | --- |
| QP – 01 | Nilai penilaian tidak tersimpan dengan benar. | Data untuk perhitungan SAW bisa tidak lengkap atau tidak sesuai. |
| QP – 02 | Konversi pilihan penilaian atau perhitungan SAW salah. | Nilai akhir dan peringkat guru bisa keliru. |
| QP – 03 | Peringkat tidak sesuai dengan nilai preferensi atau tidak diperbarui setelah nilai berubah. | Hasil pemilihan dapat menyesatkan pengguna. |
| QP – 04 | Penilaian yang belum lengkap atau pilihan yang tidak valid tetap diproses. | Hasil perhitungan dapat menggunakan data yang tidak semestinya. |
| QP – 05 | Pengguna dapat membuka fitur atau data di luar hak aksesnya. | Kerahasiaan dan integritas data berisiko terganggu. |

Potensi masalah kualitas yang telah diidentifikasi menjadi dasar penyusunan requirement dan risk register pada tahap berikutnya. Risiko yang berkaitan dengan penyimpanan penilaian, perhitungan SAW, hasil perangkingan, validasi data, dan pembatasan hak akses akan diprioritaskan dalam penyusunan strategi serta test case. Hasil pengujian akan digunakan untuk menilai apakah risiko tersebut terbukti terjadi, dapat dikendalikan, atau masih memerlukan pengujian lanjutan.

## Cost of Quality

Apabila kesalahan perhitungan tidak ditemukan sebelum hasil digunakan, sekolah dapat mengambil keputusan berdasarkan peringkat yang keliru. Konsekuensinya dapat berupa pemeriksaan ulang, koreksi data, pengulangan proses penilaian, dan berkurangnya kepercayaan terhadap hasil sistem.
