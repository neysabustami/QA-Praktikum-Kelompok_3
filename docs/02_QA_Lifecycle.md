<!-- Converted from 02_QA_Lifecycle.docx; review formatting and image references before submission. -->

# QA Lifecycle & Feedback Loop (P02)

Gambarkan secara ringkas alur SDLC atau proses perubahan aplikasi.

SDLC merupakan singkatan dari Software Development Life Cycle, yaitu tahapan-tahapan yang dilalui dalam proses pembuatan sebuah aplikasi.

![Gambar dari dokumen asli](assets/02_QA_Lifecycle_image.png)

| Tahapan SDLC | Penerapan pada aplikasi |
| --- | --- |
| Analisis kebutuhan (requirement analysis) | Mengidentifikasi permasalahan, pengguna sistem (Admin, Tim Penilai, Kepala Sekolah, dan Guru), serta kebutuhan fitur seperti pengelolaan data guru, kriteria, bobot, penilaian, dan perangkingan menggunakan metode SAW. |
| Perancangan sistem (system design) | Merancang antarmuka, basis data, hak akses pengguna, serta alur perhitungan SAW berdasarkan kriteria dan bobot yang telah ditentukan. |
| Implementasi (implementation) | Membangun aplikasi berdasarkan rancangan, meliputi pembuatan basis data, fitur pengelolaan data, penginputan nilai, dan penerapan metode SAW. |
| Pengujian (testing) | Menguji seluruh fitur aplikasi, termasuk login, pengelolaan data, validasi nilai, perhitungan SAW, hasil perangkingan, dan hak akses pengguna. |
| Perbaikan dan rilis (fixing and release) | Memperbaiki kesalahan berdasarkan hasil pengujian dan melakukan pengujian ulang sebelum aplikasi dirilis. |
| Monitoring dan pemeliharaan (monitoring and maintanance) | Memantau kinerja aplikasi, mengidentifikasi kendala, serta melakukan perbaikan dan pemeliharaan agar sistem tetap berjalan dengan baik. |

Analisis Kebutuhan → Perancangan Sistem → Implementasi → Pengujian → Perbaikan dan Rilis → Monitoring dan Pemeliharaan.

Apabila ditemukan kesalahan pada tahap pengujian maupun monitoring, proses dapat kembali ke tahap perbaikan atau tahap pengembangan yang diperlukan. Dengan demikian, pengembangan aplikasi tidak hanya berfokus pada penyelesaian fitur, tetapi juga memperhatikan kualitas sistem pada setiap tahapannya.

Tentukan sedikitnya dua aktivitas shift-left, misalnya review requirement dan unit testing.

Shift-left merupakan pendekatan dalam pengujian perangkat lunak yang menekankan pentingnya kegiatan penjaminan kualitas sejak tahap awal pengembangan. Pendekatan ini dilakukan agar kesalahan dapat ditemukan lebih cepat sebelum menimbulkan permasalahan yang lebih besar pada tahap berikutnya.

Pada pengembangan Sistem Pendukung Keputusan Pemilihan Guru Berprestasi Menggunakan Metode SAW, penerapan shift-left dilakukan melalui beberapa kegiatan berikut.

| Aktivitas | Tujuan | Penerapan |
| --- | --- | --- |
| Requirement review | Mencegah kesalahan kebutuhan sebelum pemrograman dimulai. | Memeriksa fitur, hak akses pengguna, rentang nilai berdasarkan indicator penilaian (C1-C6), dan total bobot kriteria 100%. |
| Design review | Menghindari kesalahan rancangan yang dapat memengaruhi hasil perangkingan. | Memeriksa bobot kriteria, jenis benefit dan cost, rumus normalisasi, serta perhitungan nilai preferensi. |
| Unit testing | Menemukan kesalahan kode sejak awal pengembangan. | Menguji fungsi normalisasi dan perhitungan nilai preferensi SAW dengan membandingkan hasil program dan perhitungan manual. |

Tentukan sedikitnya satu sumber evidence shift-right, misalnya log atau metrik pada lingkungan latihan.

Shift-right merupakan pendekatan pengujian yang dilakukan dengan mengamati aplikasi ketika dijalankan untuk memastikan setiap fitur berfungsi dengan baik. Pada proyek Sistem Pendukung Keputusan Pemilihan Guru Berprestasi Menggunakan Metode SAW, pengujian dilakukan pada lingkungan lokal dengan mengamati proses pengelolaan data, penilaian, perhitungan SAW, dan hasil perangkingan.

Sumber evidence: shift-right

Sumber evidence yang digunakan dalam pengujian aplikasi meliputi :

| Sumber evidence | Informasi yang diamati | Dokumentasi |
| --- | --- | --- |
| Observasi aplikasi | Respons aplikasi ketika pengguna menjalankan fitur login, pengelolaan data guru, kriteria, penilaian, dan perangkingan | Catatan hasil pengamatan selama pengujian |
| Screenshot | Tampilan aplikasi ketika fitur dijalankan, termasuk pesan validasi dan pesan kesalahan. | Tangkapan layer hasil pengujian |
| Hasil perhitungan SAW | Hasil normalisasi dan nilai akhir yang dihasilkan aplikasi | Hasil perhitungan pada aplikasi |
| Perhitungan manual | Hasil perhitungan SAW secara manual sebagai pembanding hasil aplikasi. | Catatan atau table perhitungan manual |
| Pesan validasi dan kesalahan | Respons sistem ketika pengguna memasukkan data yang tidak sesuai atau menjalankan proses yang mengalami kegagalan. | Tangkapan layer pesan validasi atau kesalahan |

## Penerapan Shift-Right pada Aplikasi

Pengujian dilakukan dengan menjalankan fitur login, pengelolaan data guru, kriteria, input penilaian, dan perangkingan. Hasil perhitungan SAW dibandingkan dengan perhitungan manual untuk memastikan ketepatan normalisasi dan nilai preferensi. Pengujian juga dilakukan menggunakan data tidak valid untuk memeriksa respons sistem.

## Pemanfaatan Evidence

Evidence digunakan sebagai bukti kondisi aktual aplikasi untuk mengidentifikasi kesalahan dan mengevaluasi fungsi sistem. Apabila ditemukan masalah, QA mencatat hasil pengujian beserta bukti pendukung untuk disampaikan kepada pengembang agar dilakukan perbaikan. Dengan demikian, kualitas dan kesesuaian aplikasi terhadap kebutuhan dapat dievaluasi.

Rancang satu quality gate dan alur pemberian umpan balik kepada pengembang/pemilik aplikasi.

Quality gate merupakan tahapan pemeriksaan yang digunakan untuk menentukan apakah aplikasi telah memenuhi kriteria kualitas yang ditetapkan sebelum melanjutkan ke tahap berikutnya. Pemeriksaan ini dilakukan berdasarkan hasil pengujian, kesesuaian fungsi, serta bukti pendukung yang telah dikumpulkan.

Pada proyek ini, quality gate diterapkan setelah proses pengujian aplikasi. Beberapa kriteria yang digunakan sebagai dasar pemeriksaan adalah sebagai berikut.

| No. | Kriteria Pemeriksaan | Standar yang Diharapkan |
| --- | --- | --- |
| 1 | Fungsi login | Pengguna dapat masuk sesuai akun dan hak aksesnya. |
| 2 | Pengelolaan data guru | Data guru dapat disimpan dan data dengan NIP yang sama ditolak. |
| 3 | Penilaian tersimpan | Data penilaian tersimpan dan sapat ditampilkan Kembali |
| 4 | Pengelolaan bobot | Total bobot seluruh kriteria harus berjumlah 100%. |
| 5 | Penginputan nilai | Sistem hanya menerima nilai dalam rentang 0–100. |
| 6 | Perhitungan SAW | Hasil perhitungan aplikasi sesuai dengan perhitungan manual. |
| 7 | Hasil perangkingan | Sistem menampilkan urutan peringkat berdasarkan nilai preferensi tertinggi. |
| 8 | Hak akses pengguna | Setiap pengguna hanya dapat mengakses fitur sesuai kewenangannya. |
| 9 | Bukti pengujian | Hasil pengujian dan bukti pendukung tersedia serta terdokumentasi. |

Berdasarkan hasil pemeriksaan, quality gate memiliki tiga kemungkinan keputusan, yaitu:

Pass (Lulus), diberikan apabila seluruh kriteria penting telah terpenuhi dan tidak terdapat kesalahan kritis yang belum diselesaikan. Aplikasi dapat melanjutkan ke tahap berikutnya.

Conditional Pass (Lulus dengan Syarat), diberikan apabila masih terdapat kekurangan yang bersifat minor dan dapat diterima sementara. Kekurangan tersebut harus dicatat, memiliki penanggung jawab, serta ditentukan batas waktu penyelesaiannya.

Fail (Tidak Lulus), diberikan apabila masih terdapat masalah penting yang dapat memengaruhi fungsi utama atau kualitas aplikasi. Aplikasi harus diperbaiki dan diuji kembali sebelum dinyatakan memenuhi kriteria.

Sebagai contoh, apabila hasil perhitungan SAW pada aplikasi tidak sesuai dengan perhitungan manual, maka aplikasi dinyatakan belum memenuhi quality gate. Pengembang perlu memperbaiki bagian perhitungan tersebut dan melakukan pengujian ulang sampai hasilnya sesuai.

Feedback loop merupakan proses penyampaian hasil pengujian kepada pengembang sebagai dasar untuk melakukan perbaikan terhadap kesalahan yang ditemukan. Proses ini dilakukan secara berulang agar setiap masalah dapat ditangani dan tidak terulang pada tahap berikutnya.

Pada proyek ini, feedback loop dimulai ketika penguji menjalankan aplikasi dan menemukan ketidaksesuaian antara hasil aktual dengan hasil yang diharapkan. Masalah tersebut kemudian dicatat dalam laporan defect yang memuat informasi mengenai fitur yang bermasalah, langkah untuk menemukan kesalahan, hasil yang diharapkan, hasil aktual, serta bukti pendukung.

Setelah laporan dibuat, masalah dianalisis dan ditentukan prioritas perbaikannya berdasarkan tingkat keparahan serta dampaknya terhadap sistem. Pengembang kemudian melakukan pemeriksaan terhadap bagian program yang bermasalah dan melaksanakan perbaikan.

Setelah perbaikan selesai, penguji melakukan retest untuk memastikan bahwa kesalahan sebelumnya telah berhasil diperbaiki. Selanjutnya, dilakukan regression testing untuk memastikan bahwa perbaikan tersebut tidak menyebabkan kesalahan pada fitur lain yang sebelumnya telah berjalan dengan baik.

Hasil pengujian ulang kemudian diperiksa kembali melalui quality gate. Apabila kriteria kualitas telah terpenuhi, aplikasi dapat melanjutkan ke tahap berikutnya. Namun, apabila masalah masih ditemukan, hasil pengujian akan dikembalikan kepada pengembang untuk dilakukan perbaikan lebih lanjut.

Sebagai contoh, ketika pengujian menemukan bahwa hasil perangkingan guru tidak sesuai dengan perhitungan manual, penguji membuat laporan defect dan menyampaikan bukti kepada pengembang. Pengembang kemudian memeriksa rumus perhitungan SAW, memperbaiki kesalahan yang ditemukan, dan meminta penguji melakukan pengujian ulang. Apabila hasil perhitungan telah sesuai, masalah dapat dinyatakan selesai setelah bukti retest dicatat.

Dengan adanya feedback loop, komunikasi antara penguji dan pengembang menjadi lebih terarah. Setiap kesalahan tidak hanya diketahui, tetapi juga memiliki proses penanganan yang jelas sampai dilakukan verifikasi ulang.
