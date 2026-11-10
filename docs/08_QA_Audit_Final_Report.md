TAHAP 8 — FINAL QA AUDIT & QUALITY DECISION (P08)

Nama Aplikasi: Sistem Pendukung Keputusan Pemilihan Guru Berprestasi Menggunakan Metode Simple Additive Weighting (SAW)

Pendahuluan

Tahap 8 merupakan tahap akhir dalam proses Quality Assurance (QA) yang bertujuan untuk melakukan audit terhadap hasil pengujian aplikasi Sistem Pendukung Keputusan Pemilihan Guru Berprestasi Menggunakan Metode Simple Additive Weighting (SAW).

Audit dilakukan dengan memeriksa kesesuaian antara requirement, risk, test case, hasil pengujian, status, dan evidence. Selain itu, dilakukan analisis test coverage untuk mengetahui sejauh mana kebutuhan aplikasi telah diuji serta mengidentifikasi bagian yang masih belum memiliki pengujian atau bukti yang memadai.

Pada tahap ini juga dilakukan evaluasi terhadap exit criteria, quality gate, dan residual risk. Hasil evaluasi tersebut digunakan untuk menentukan rekomendasi keputusan kualitas aplikasi, yaitu Go, Conditional Go, atau No-Go.

Audit Konsistensi Requirement, Risk, Test Case, Status, dan Evidence

Audit konsistensi dilakukan untuk memastikan bahwa setiap kebutuhan aplikasi telah memiliki pengujian yang sesuai serta didukung oleh hasil aktual dan bukti pengujian.

Audit Hasil Pengujian

pengujian dilakukan menggunakan empat teknik Black-Box Testing, yaitu Equivalence Partitioning, Boundary Value Analysis, Decision Table, dan State Transition.

| No | Teknik | ID Test Case | Fitur yang Diuji | Status | Evidence |
| --- | --- | --- | --- | --- | --- |
| 1 | EP-001 | TC-ADM-001 | Login Admin | Passed | EV-001 |
| 2 | EP-002 | TC-ADM-003 | Menambahkan data Guru | Passed | EV-002 |
| 3 | EP-003 | TC-TIM-004 | Validasi penilaian belum lengkap | Passed | EV-003 |
| 4 | BVA-001 | TC-TIM-002 | Kategori indikator terendah | Passed | EV-004 |
| 5 | BVA-002 | TC-TIM-003 | Kategori indikator tertinggi | Passed | EV-005 |
| 6 | BVA-003 | TC-ADM-002 | Batas maksimum panjang username | Failed | EV-006 |
| 7 | DT-001 | TC-ADM-001 | Kombinasi username dan password saat login Admin | Passed | EV-007 |
| 8 | ST-001 | TC-GUR-003 | Guru mengunggah dokumen baru | Passed | EV-008 |
| 9 | ST-002 | TC-ADM-006 | Admin memverifikasi dokumen Guru | Passed | EV-009 |
| 10 | ST-003 | TC-TIM-005 | Nama Guru muncul setelah dokumen diverifikasi | Passed | EV-0010 |
| 11 | ST-004 | TC-TIM-006 | Nama Guru tidak muncul selama dokumen berstatus Pending | Passed | EV-0011 |

Audit Konsistensi Requirement dan Risk

| No | Area Requirement | Test Case Terkait | Hasil Audit | Keterangan |
| --- | --- | --- | --- | --- |
| 1 | Login dan autentikasi Admin | TC-ADM-001 | Teruji | Login berhasil dan kombinasi username-password diuji. |
| 2 | Pengelolaan data Guru | TC-ADM-003 | Teruji | Data Guru berhasil disimpan dan ditampilkan. |
| 3 | Validasi panjang username | TC-ADM-002 | Belum terkonfirmasi | Status Failed dan masih memerlukan verifikasi melalui DEF-001. |
| 4 | Validasi kelengkapan penilaian | TC-TIM-004 | Teruji | Sistem menolak penilaian yang belum lengkap. |
| 5 | Batas kategori penilaian | TC-TIM-002 dan TC-TIM-003 | Teruji | Kategori terendah dan tertinggi berhasil diterima. |
| 6 | Proses upload dokumen Guru | TC-GUR-003 | Teruji | Status berubah dari Belum Upload menjadi Pending. |
| 7 | Proses verifikasi dokumen Admin | TC-ADM-006 | Teruji | Status berubah dari Pending menjadi Diverifikasi. |
| 8 | Penampilan Guru pada Tim Penilai | TC-TIM-005 dan TC-TIM-006 | Teruji | Nama Guru muncul setelah verifikasi dan tidak muncul ketika masih Pending. |
| 9 | Perhitungan SAW | TC-KEP-001 | Belum terkonfirmasi | Belum terdapat hasil eksekusi dalam |
| 10 | Perangkingan Guru | TC-KEP-002 | Belum terkonfirmasi | Belum terdapat hasil eksekusi dalam |
| 11 | Hak akses hasil penilaian Guru | TC-GUR-001 dan TC-GUR-002 | Belum terkonfirmasi | Belum terdapat hasil eksekusi dalam |

Hasil Audit Konsistensi

Berdasarkan hasil pemeriksaan, sebagian besar pengujian yang tercatat pada P06 telah memiliki actual result, status, dan evidence.

Namun, terdapat beberapa hal yang perlu diperhatikan:

TC-ADM-002 masih berstatus Failed. DEF-001 pada P07 masih berstatus Need Verification karena hasil aktual dan bukti pengujian belum sepenuhnya memastikan apakah validasi username berjalan sesuai ketentuan.

keterangan Actual Result menyatakan sistem menolak username yang melebihi batas maksimum, tetapi statusnya Failed. Hal ini masih memerlukan pencocokan dengan evidence EV-006.

Pengujian Decision Table baru mencatat satu test case, yaitu TCADM-001. Jumlah ini belum memenuhi ketentuan minimal tiga test case pada tugas praktikum.

Pengujian perhitungan SAW dan perangkingan belum tercatat sebagai hasil eksekusi pada P06.

Keterangan evidence perlu dipastikan sesuai dengan scenari pengujian. Khususnya EV-003 pada TC-TIM-004 harus benar-benar menunjukkan penolakan penilaian yang belum lengkap.

Dengan demikian, keterlacakan antara test case dan evidence sudah tersedia, tetapi masih terdapat kekurangan pada kelengkapan teknik pengujian dan beberapa bukti yang memerlukan verifikasi.

Analisis Test Coverage dan Identifikasi Blind Spot

Analisis Test Coverage

Test coverage digunakan untuk mengetahui sejauh mana pengujian telah dilakukan terhadap fungsi dan kebutuhan aplikasi.

Berdasarkan pelaksanaan pengujian pada P06, diperoleh rekapitulasi berikut:

| Teknik Pengujian | Jumlah Pelaksanaan | Passed | Failed |
| --- | --- | --- | --- |
| Equivalence Partitioning (EP) | 3 | 3 | 0 |
| Boundary Value Analysis (BVA) | 3 | 2 | 1 |
| Decision Table (DT) | 1 | 1 | 0 |
| State Transition (ST) | 4 | 4 | 0 |
| Total | 11 | 10 | 1 |

Persentase hasil pengujian Passed:

10 / 11 × 100% = 90,91%

Persentase hasil pengujian Failed:

10 / 11 × 100% = 90,91%

Hasil tersebut menunjukkan bahwa 90,91% dari pelaksanaan pengujian yang tercatat memperoleh status Passed, sedangkan 9,09% memperoleh status Failed.

Persentase tersebut merupakan tingkat keberhasilan pelaksanaan pengujian P06, bukan persentase seluruh requirement aplikasi yang telah terpenuhi.

Analisis Cakupan Empat Teknik Black-Box

| Teknik | Ketentuan Praktikum | Kondisi Tahap Sebelum nya | Evaluasi |
| --- | --- | --- | --- |
| Equivalence Partitioning | Minimal 3 test case | Terdapat 3 test case | Terpenuhi |
| Boundary Value Analysis | Minimal 3 test case | Terdapat 3 test case | Terpenuhi |
| Decision Table | Minimal 3 test case | Terdapat 1 test case | Belum Terpenuhi |
| State Transition | Minimal 3 test case | Terdapat 4 test case | Terpenuhi |

Walaupun empat teknik telah digunakan, penerapan Decision Table masih perlu ditambah menjadi minimal tiga test case. Selain itu, pengujian BVA perlu memastikan bahwa batas tepat di bawah, pada, dan di atas nilai batas benar-benar diuji sesuai aturan validasi aplikasi.

Identifikasi Blind Spot

Blind spot merupakan bagian dari aplikasi yang belum diuji atau belum memiliki bukti yang cukup untuk memastikan bahwa fungsi berjalan sesuai kebutuhan.

Berdasarkan hasil audit, ditemukan beberapa blind spot sebagai berikut:

| No. | Area Pengujian | Kondisi | Risiko |
| --- | --- | --- | --- |
| 1 | Perhitungan SAW | TC-KEP-001 belum tercatat | Hasil perhitungan normalisasi dan nilai preferensi berpotensi tidak sesuai dengan perhitungan manual. |
| 2 | Perangkingan Guru | TC-KEP-002 belum tercatat | Urutan peringkat Guru berpotensi tidak sesuai dengan nilai preferensi. |
| 3 | Hak akses Guru | TC-GUR-001 dan TC-GUR-002 belum tercatat | Pengguna berpotensi mengakses informasi di luar hak aksesnya. |
| 4 | Validasi panjang username | TC-ADM-002 berstatus Failed. | Username yang melebihi batas maksimum berpotensi diproses atau tersimpan tidak sesuai ketentuan. |
| 5 | Decision Table | Baru terdapat satu test case. | Kombinasi kondisi login lainnya belum memiliki cakupan pengujian yang memadai. |
| 6 | Validasi username duplikat | Belum tercatat sebagai pelaksanaan pengujian | Sistem berpotensi menerima username yang sudah terdaftar. |
| 7 | Validasi total bobot | Belum tercatat sebagai pelaksanaan pengujian P | Konfigurasi bobot yang tidak sesuai ketentuan berpotensi diterima. |

Berdasarkan identifikasi tersebut, fungsi upload dan verifikasi dokumen Guru telah diuji melalui State Transition. Namun, pengujian terhadap perhitungan utama SAW, perangkingan, hak akses, dan beberapa validasi Admin masih perlu dilengkapi.

Evaluasi Exit Criteria, Quality Gate, dan Residual Risk

Evaluasi Exit Criteria

Exit criteria merupakan kriteria yang digunakan untuk menentukan apakah proses pengujian telah mencapai kondisi yang dapat diterima.

| No. | Exit Criteria | Hasil Evaluasi | Status |
| --- | --- | --- | --- |
| 1 | Minimal 3 test scenario dan 12 test case | Mengacu pada rancangan P05. | Perlu pemeriksaan RTM |
| 2 | Pengujian menggunakan empat teknik Black-Box. | EP, BVA, DT, dan ST telah diterapkan. | Terpenuhi Sebagian |
| 3 | Minimal 3 test case untuk setiap teknik sesuai ketentuan praktikum. | DT baru memiliki 1 test case. | Belum terpenuhi |
| 4 | Setiap pengujian yang dieksekusi memiliki actual result, status, dan evidence. | Terdapat 11 pelaksanaan pengujian dengan bukti masing-masing. | Terpenuhi, dengan verifikasi evidence |
| 5 | Tidak terdapat defect yang belum ditangani. | DEF-001 masih Need Verification. | Belum terpenuhi |
| 6 | Perhitungan SAW dan perangkingan telah diuji. | Belum terdapat hasil eksekusi. | Belum terpenuhi |
| 7 | Hak akses pengguna telah diuji | TC-GUR-001 dan TC-GUR-002 belum tercatat | Belum terpenuhi |
| 8 | Evidence konsisten dengan test case dan actual result. | EV-006 dan EV-003 masih memerlukan pemeriksaan. | Belum sepenuhnya terpenuhi |

Evaluasi Quality Gate

Quality gate digunakan sebagai titik pemeriksaan untuk menentukan apakah aplikasi dapat melanjutkan ke tahap berikutnya

| Aspek | Kondisi | Hasil Evaluasi |
| --- | --- | --- |
| Pengujian fungsi dasar | Login, penambahan Guru, dan validasi penilaian telah diuji. | Cukup baik |
| Pengujian batas input | Terdapat satu pengujian Failed pada validasi username. | Perlu tindak lanjut |
| Pengujian kombinasi kondisi | Decision Table baru memiliki satu test case. | Belum memadai |
| Pengujian alur dokumen | Empat transisi status dokumen berstatus Passed. | Baik |
| Penanganan defect | DEF-001 masih Need Verification. | Belum selesai |
| Penanganan defect Pengujian fungsi utama SAW | Perhitungan dan perangkingan belum diuji. | Belum memadai |
| Pengujian hak akses | Belum terdapat hasil eksekusi | Belum memadai |

Analisis Residual Risk

Residual risk merupakan risiko yang masih tersisa setelah proses pengujian dan analisis defect dilakukan.

| No. | Residual Risk | Dampak yang Mungkin Terjadi | Rekomendasi Penanganan |
| --- | --- | --- | --- |
| 1 | Validasi panjang username belum terkonfirmasi. | Data akun dapat tersimpan dengan username yang tidak sesuai ketentuan. | Verifikasi DEF-001 dan lakukan retest TC-ADM-002. |
| 2 | Perhitungan SAW belum diuji. | Nilai akhir Guru berpotensi tidak akurat. | Bandingkan hasil aplikasi dengan perhitungan manual. |
| 3 | Perangkingan belum diuji. | Urutan Guru berprestasi berpotensi tidak sesuai. | Lakukan pengujian TC-KEP-002. |
| 4 | Hak akses Guru belum diuji. | Data penilaian berpotensi diakses oleh pengguna yang tidak berwenang. | Lakukan pengujian TC-GUR-001 dan TC-GUR-002. |
| 5 | Pengujian Decision Table belum mencukupi. | Kombinasi kondisi login belum diuji secara menyeluruh. | Tambahkan minimal dua test case Decision Table. |
| 6 | Evidence tertentu masih memerlukan verifikasi. | Hasil pengujian dapat sulit dibuktikan atau ditelusuri. | Periksa kembali EV-003 dan EV-006. |
| 7 | Validasi username duplikat dan total bobot belum tercatat | Data akun dan konfigurasi bobot berpotensi tidak sesuai aturan. | Laksanakan pengujian yang telah dirancang. |

Rekomendasi Quality Decision

Berdasarkan hasil audit rekomendasi keputusan kualitas aplikasi adalah:

CONDITIONAL GO

Keputusan Conditional Go diberikan karena sebagian besar pelaksanaan pengujian pada P06 memperoleh hasil Passed, yaitu 10 dari 11 pelaksanaan pengujian. Pengujian State Transition juga menunjukkan bahwa proses upload dan verifikasi dokumen Guru berjalan sesuai dengan perubahan status yang diharapkan.

Namun, masih terdapat beberapa hal yang perlu diselesaikan sebelum aplikasi dapat dinyatakan siap digunakan secara resmi.

Pertama, TC-ADM-002 masih berstatus Failed dan DEF-001 masih memerlukan verifikasi. Kedua, pengujian Decision Table belum memenuhi jumlah minimal tiga test case. Ketiga, pengujian perhitungan SAW, perangkingan, dan hak akses Guru belum tercatat sebagai hasil eksekusi.

Oleh karena itu, aplikasi dapat melanjutkan proses pengembangan dan pengujian lanjutan, tetapi belum direkomendasikan untuk digunakan pada lingkungan produksi sebelum tindakan berikut dilakukan:

Melakukan verifikasi terhadap DEF-001 dan memastikan perilaku validasi panjang username.

Melaksanakan retest TC-ADM-002 setelah perbaikan atau verifikasi selesai.

Menambahkan pengujian Decision Table hingga memenuhi minimal tiga test case.

Melaksanakan pengujian perhitungan SAW menggunakan TC-KEP-001.

Melaksanakan pengujian perangkingan menggunakan TC-KEP-002.

Melaksanakan pengujian hak akses menggunakan TC-GUR-001 dan TC-GUR-002.

Memastikan seluruh evidence sesuai dengan test case dan actual result.

Memperbarui RTM berdasarkan hasil pengujian terbaru.

Keputusan Conditional Go dapat dievaluasi kembali menjadi Go apabila seluruh pengujian prioritas telah dilaksanakan, defect telah ditangani, dan exit criteria telah terpenuhi.

Alternatif Tindakan dan Trade-Off

Untuk mengurangi residual risk dan meningkatkan kualitas aplikasi, terdapat beberapa alternatif tindakan yang dapat dilakukan.

| No. | Alternatif Tindakan | Keuntungan | Trade-Off |
| --- | --- | --- | --- |
| 1 | Melakukan verifikasi dan perbaikan DEF-001 pada validasi panjang username. | Mengurangi risiko kesalahan data akun. | Membutuhkan pemeriksaan kode program dan pengujian ulang. |
| 2 | Menambahkan test case Decision Table. | Meningkatkan cakupan kombinasi username dan password. | Membutuhkan waktu tambahan untuk pengujian. |
| 3 | Melakukan pengujian perhitungan SAW. | Memastikan hasil normalisasi dan nilai preferensi sesuai perhitungan manual. | Membutuhkan data uji dan perhitungan pembanding. |
| 4 | Melakukan pengujian perangkingan Guru. | Memastikan urutan peringkat sesuai dengan nilai preferensi. | Membutuhkan beberapa data Guru sebagai pembanding. |
| 5 | Melakukan pengujian hak akses Guru. | Mengurangi risiko akses data yang tidak sesuai kewenangan. | Membutuhkan akun dengan hak akses berbeda. |
| 6 | Memeriksa kembali seluruh evidence. | Meningkatkan konsistensi dokumentasi dan keterlacakan hasil pengujian. | Membutuhkan pemeriksaan ulang screenshot. |
| 7 | Melakukan regression testing setelah perbaikan. | Memastikan perubahan tidak menyebabkan kerusakan pada fungsi lain. | Membutuhkan waktu tambahan untuk mengulang pengujian. |

Trade-Off yang Tersisa

Pelaksanaan seluruh tindakan perbaikan dan pengujian tambahan membutuhkan waktu lebih lama sebelum aplikasi dapat dinyatakan siap digunakan secara resmi.

Namun, apabila aplikasi langsung digunakan tanpa menyelesaikan pengujian yang belum dilakukan, terdapat risiko kesalahan pada validasi data pengguna, perhitungan SAW, perangkingan, dan pengaturan hak akses.

Oleh karena itu, penyelesaian defect dan pengujian fungsi utama menjadi prioritas. Pengujian tambahan perlu dilakukan agar kualitas aplikasi dapat dipastikan berdasarkan hasil aktual, bukan hanya berdasarkan rancangan test case.

Kesimpulan

Berdasarkan hasil Final QA Audit, aplikasi Sistem Pendukung Keputusan Pemilihan Guru Berprestasi Menggunakan Metode Simple Additive Weighting (SAW) telah melalui proses penyusunan test case, pelaksanaan Black-Box Testing menggunakan teknik Equivalence Partitioning, Boundary Value Analysis, Decision Table, dan State Transition, serta identifikasi defect melalui Defect Report dan Root Cause Analysis.

Berdasarkan Analisis terdapat 11 pelaksanaan pengujian dengan rincian 10 Passed dan 1 Failed. Pengujian yang berstatus Failed adalah TC-ADM-002, yaitu pengujian batas maksimum panjang username pada modul Admin. Temuan tersebut telah didokumentasikan sebagai DEF-001, tetapi masih memerlukan verifikasi dan pengujian ulang.

Pengujian State Transition menunjukkan hasil yang baik karena proses upload dokumen, verifikasi oleh Admin, serta penampilan nama Guru pada daftar Tim Penilai telah memperoleh status Passed.

Meskipun demikian, masih terdapat beberapa kekurangan, yaitu jumlah pengujian Decision Table yang belum memenuhi ketentuan minimal, pengujian perhitungan SAW dan perangkingan yang belum dilaksanakan, serta pengujian hak akses Guru yang belum memiliki hasil eksekusi.

Dengan mempertimbangkan seluruh hasil tersebut, rekomendasi keputusan kualitas aplikasi adalah CONDITIONAL GO. Aplikasi dapat melanjutkan proses pengembangan dan pengujian lanjutan, tetapi belum direkomendasikan untuk penggunaan produksi sampai defect, kekurangan pengujian, dan ketidaksesuaian evidence telah diselesaikan.

Setelah seluruh tindakan perbaikan dan pengujian ulang dilaksanakan serta exit criteria terpenuhi, keputusan kualitas aplikasi dapat dievaluasi kembali untuk menentukan apakah aplikasi telah layak memperoleh status Go.
