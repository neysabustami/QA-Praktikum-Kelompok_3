# 06 Black Box Design

Black-Box Test Design & Execution (P06)

- Equivalence Partitioning

| Equivalence Partitioning | EP - 001 |
| --- | --- |
| ID Test Case | TC-ADM-001 |
| Actual Result | Pengguna di arahkan ke halaman Dashboard Admin dalam waktu 2 detik |
| Status | PASSED (Lulus) |
| Evidence | EV-001 - Screenshot hasil login Admin |
| Bukti | ![Gambar](../assets/P06_18.jpeg)<br>![Gambar](../assets/P06_14.jpeg) |

| Equivalence Partitioning | EP - 002 |
| --- | --- |
| ID Test Case | TC-ADM-003 |
| Actual Result | Sistem berhasil menyimpan data guru ke dalam database dan data guru yang telah disimpan tampil pada daftar guru sesuai dengan data yang dimasukkan |
| Status | PASSED (Lulus) |
| Evidence | EV-002 - Screenshot data guru berhasil ditambahkan |
| Bukti | ![Gambar](../assets/P06_06.jpeg)<br>![Gambar](../assets/P06_31.jpeg)<br>![Gambar](../assets/P06_25.jpeg)<br>![Gambar](../assets/P06_22.jpeg)<br>![Gambar](../assets/P06_15.jpeg)<br>![Gambar](../assets/P06_07.jpeg) |

| Equivalence Partitioning | EP - 003 |
| --- | --- |
| ID Test Case | TC-TIM-004 |
| Actual Result | Sistem berhasil menolak penyimpanan atau pemrosesan penilaian yang belum lengkap dan menampilkan pemberitahuan mengenai nilai yang belum diisi oleh pengguna |
| Status | PASSED (Lulus) |
| Evidence | EV-003 – Screenshot bukti penilaian yang belum lengkap |
| Bukti | ![Gambar](../assets/P06_01.jpeg) |

- Boundary Value Analysis

| Boundary Value Analysis | BVA-001 |
| --- | --- |
| ID Test Case | TC-TIM-002 |
| Actual Result | Sistem berhasil menerima dan menyimpan seluruh pilihan kategori terendah yang tersedia sesuai dengan pilihan pengguna. |
| Status | PASSED (Lulus) |
| Evidence | EV-004 - Screenshot penerimaan indikator terendah |
| Bukti | ![Gambar](../assets/P06_26.jpeg)<br>![Gambar](../assets/P06_19.jpeg)<br>![Gambar](../assets/P06_11.jpeg) |

| Boundary Value Analysis | BVA-002 |
| --- | --- |
| ID Test Case | TC-TIM-003 |
| Actual Result | Sistem berhasil menerima dan menyimpan seluruh pilihan kategori tertinggi yang tersedia sesuai dengan pilihan pengguna |
| Status | PASSED (Lulus) |
| Evidence | EV-005 - Screenshot penerimaan indikator tertinggi |
| Bukti | ![Gambar](../assets/P06_08.jpeg)<br>![Gambar](../assets/P06_02.jpeg)<br>![Gambar](../assets/P06_23.jpeg) |

| Boundary Value Analysis | BVA-003 |
| --- | --- |
| ID Test Case | TC-ADM-002 |
| Actual Result | Sistem menolak username yang panjangnya berada dalam luar batas maksimum |
| Status | Failed (Gagal) |
| Evidence | EV-006 - Screenshot pengujian valid atas Panjang username |
| Bukti | ![Gambar](../assets/P06_12.jpeg)<br>![Gambar](../assets/P06_04.jpeg)<br>![Gambar](../assets/P06_27.jpeg) |

- Decision Table

| Decision Table | DT-001 |
| --- | --- |
| ID Test Case | TC-ADM-001 |
| Actual Result | Sistem menerima proses login dan menampilkan halaman dashboard admin (Note username=admin , password=123) |
| Status | PASSED (Lulus) |
| Evidence | EV-007 - Screenshot hasil login admin |
| Role | 1. Username dan Password benar, Sistem mengizinkan login<br>2. Username benar tetapi Password salah, Sistem menolak login<br>3. Username salah tetapi Password benar, Sistem menolak login<br>4. Username dan Password salah, Sistem menolak login |
| Hasil Pengujian | ![Gambar](../assets/P06_20.jpeg) |
| Bukti | 1. Username dan Password benar, Sistem mengizinkan login<br><br><br><br>2. Username benar tetapi Password salah, Sistem menolak login<br><br><br><br>3. Username salah tetapi Password benar, Sistem menolak login<br><br><br><br>4. Username dan Password salah, Sistem menolak login<br>![Gambar](../assets/P06_18.jpeg)<br>![Gambar](../assets/P06_14.jpeg)<br>![Gambar](../assets/P06_16.jpeg)<br>![Gambar](../assets/P06_09.jpeg)<br>![Gambar](../assets/P06_03.jpeg)<br>![Gambar](../assets/P06_28.jpeg)<br>![Gambar](../assets/P06_21.jpeg)<br>![Gambar](../assets/P06_13.jpeg) |

- State Transition

| State Transition | ST - 001 |
| --- | --- |
| ID Test Case | TC-GUR-003 |
| Actual Result | Dokumen berhasil diunggah dan status menjadi Pending |
| Status | PASSED (Lulus) |
| Skenario | Guru mengunggah dokumen baru |
| Perubahan Status / Kondisi | Belum Upload -> Pending |
| Hasil yang Diharapkan | Dokumen berhasil diunggah oleh Guru dan status dokumen berubah menjadi pending |
| Evidence | EV-008 - Screenshot halaman upload dokumen Guru |
| Bukti | ![Gambar](../assets/P06_29.jpeg)<br>![Gambar](../assets/P06_24.jpeg) |

| State Transition | ST - 002 |
| --- | --- |
| ID Test Case | TC-ADM-006 |
| Actual Result | Admin Berhasil melakukan verifikasi dokumen guru dan status dokumen berubah dari pending menjadi diverifikasi |
| Status | PASSED (Lulus) |
| Skenario | Admin melakukan verifikasi dokumen |
| Perubahan Status / Kondisi | Pending -> Diverifikasi |
| Hasil yang di Harapkan | Status dokumen Guru berubah menjadi Diverifikasi setelah diverifikasi Admin |
| Evidence | EV-009 - Screenshot halaman upload dokumen Guru |
| Bukti | ![Gambar](../assets/P06_24.jpeg)<br>![Gambar](../assets/P06_17.jpeg) |

| State Transition | ST - 003 |
| --- | --- |
| ID Test Case | TC-TIM-005 |
| Actual Result | Nama Guru berhasil ditampilkan pada daftar Tim penilai setelah dokumennya diverifikasi oleh admin |
| Status | PASSED (Lulus) |
| Skenario | Dokumen Guru telah diverifikasi |
| Perubahan Status / Kondisi | Belum muncul -> muncul pada daftar Tim Penilai |
| Hasil yang di Harapkan | Nama guru muncul pada daftar Tim penilai setelah dokumennya diverifikasi |
| Evidence | EV-010 - Screenshot halaman Penilaian di Tim Penilai |
| Bukti | ![Gambar](../assets/P06_10.jpeg)<br>![Gambar](../assets/P06_05.jpeg) |

| State Transition | ST - 004 |
| --- | --- |
| ID Test Case | TC-TIM-006 |
| Actual Result | Nama guru tidak di tampilkan pada daftar tim penilai karena dokumen nya masih berstatus pending dan belum diverifikasi |
| Status | PASSED (Lulus) |
| Skenario | Dokumen guru belum diverifikasi |
| Perubahan Status / Kondisi | Pending -> Belum muncul pada daftar Tim Penilai |
| Hasil yang di Harapkan | Nama guru tidak muncul pada daftar Tim Penilai selama dokumen belum diverifikasi |
| Evidence | EV-011 - Screenshot Upload Dokumen Guru |
| Bukti | ![Gambar](../assets/P06_24.jpeg)<br>![Gambar](../assets/P06_30.jpeg) |

## Lampiran gambar dari dokumen Word

![Gambar pendukung](../assets/P06_01.jpeg)

![Gambar pendukung](../assets/P06_02.jpeg)

![Gambar pendukung](../assets/P06_03.jpeg)

![Gambar pendukung](../assets/P06_04.jpeg)

![Gambar pendukung](../assets/P06_05.jpeg)

![Gambar pendukung](../assets/P06_06.jpeg)

![Gambar pendukung](../assets/P06_07.jpeg)

![Gambar pendukung](../assets/P06_08.jpeg)

![Gambar pendukung](../assets/P06_09.jpeg)

![Gambar pendukung](../assets/P06_10.jpeg)

![Gambar pendukung](../assets/P06_11.jpeg)

![Gambar pendukung](../assets/P06_12.jpeg)

![Gambar pendukung](../assets/P06_13.jpeg)

![Gambar pendukung](../assets/P06_14.jpeg)

![Gambar pendukung](../assets/P06_15.jpeg)

![Gambar pendukung](../assets/P06_16.jpeg)

![Gambar pendukung](../assets/P06_17.jpeg)

![Gambar pendukung](../assets/P06_18.jpeg)

![Gambar pendukung](../assets/P06_19.jpeg)

![Gambar pendukung](../assets/P06_20.jpeg)

![Gambar pendukung](../assets/P06_21.jpeg)

![Gambar pendukung](../assets/P06_22.jpeg)

![Gambar pendukung](../assets/P06_23.jpeg)

![Gambar pendukung](../assets/P06_24.jpeg)

![Gambar pendukung](../assets/P06_25.jpeg)

![Gambar pendukung](../assets/P06_26.jpeg)

![Gambar pendukung](../assets/P06_27.jpeg)

![Gambar pendukung](../assets/P06_28.jpeg)

![Gambar pendukung](../assets/P06_29.jpeg)

![Gambar pendukung](../assets/P06_30.jpeg)

![Gambar pendukung](../assets/P06_31.jpeg)

