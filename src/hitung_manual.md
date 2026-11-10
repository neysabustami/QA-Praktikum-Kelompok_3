# Perhitungan Manual SAW Sistem Pendukung Keputusan dalam Pemilihan Guru Berprestasi

## A. Bobot dan Kriteria yang Digunakan

| Kode | Kriteria | Bobot | Desimal |
|---|---|---:|---:|
| C1 | Kompetensi pedagogic | 25% | 0.25 |
| C2 | Kompetensi professional | 25% | 0.25 |
| C3 | Kompetensi kepribadian | 15% | 0.15 |
| C4 | Kompetensi social | 10% | 0.10 |
| C5 | Disiplin dan kinerja | 15% | 0.15 |
| C6 | Inovasi / karya prestasi | 10% | 0.10 |

## B. Misal Nilai yang Didapati dengan Perhitungan Manual

Misalnya Neysa mendapatkan nilai berikut oleh Penilai A dan Penilai B:

| Kode | Penilai A | Nilai A | Penilai B | Nilai B |
|---|---|---:|---|---:|
| C1 | Sangat kurang | 20 | Sangat baik | 100 |
| C2 | Tidak ada sertifikat | 20* | Lebih dari 3 sertifikat | 100* |
| C3 | Sangat kurang | 20 | Sangat baik | 100 |
| C4 | Sangat kurang | 20 | Sangat baik | 100 |
| C5 | Sangat kurang | 20 | Sangat baik | 100 |
| C6 | Tidak ada karya | 20* | Tingkat nasional/internasional | 100* |

## C. Menghitung Rata-rata Kedua Penilai

Cara menghitung rata-rata nilai kedua penilai:

Bobot dan kriteria yang digunakan

Misal nilai yang didapati dengan perhitungan manual

Misalnya Neysa mendapatkan niali berikut oleh penilai A dan penilai B:

Mengitung rata-rata kedua penilai

Cara menghitung rata-rata nilai kedua penilai

Dengan rumus :

![Ilustrasi/perhitungan](assets/image_12.png)

Keterangan:

![Ilustrasi/perhitungan](assets/image_10.png)

Penilaian C1

Penilaian cukup dan cukup

![Ilustrasi/perhitungan](assets/image_05.png)

Penilaian C2

Penilaian masing-masing memiliki 1 sertifikat

![Ilustrasi/perhitungan](assets/image_01.png)

Penilaian C3

Penilai A memberi 80, penilai B memberi 60

![Ilustrasi/perhitungan](assets/image_16.png)

Penilaian C4

Penilai A memberi 80, penilai B memberi 40

![Ilustrasi/perhitungan](assets/image_14.png)

Penilaian C5

Penilai A memberi 80, penilai B memberi 100

![Ilustrasi/perhitungan](assets/image_11.png)

Penilaian C6

Keduanya menyatakan tidak ada karya

![Ilustrasi/perhitungan](assets/image_06.png)

Hasil rata-ratanya adalah sebagai berikut :

| Kriteria | Nilai A | Nilai B | Perhitungan rata-rata | Hasil |
|---|---|---|---|---|
| C1 | 60 | 60 | (60 + 60) / 2 | 60 |
| C2 | 40 | 40 | (40 + 20) / 2 | 40 |
| C3 | 80 | 60 | (80 + 60) / 2 | 70 |
| C4 | 80 | 40 | (80 + 40) / 2 | 60 |
| C5 | 80 | 100 | (80 + 100) / 2 | 90 |
| C6 | 20 | 20 | (20 + 20) / 2 | 20 |

Melakukan normalisasi

Setelah mendapatkan rata-rata, kita mengubah nilai tersebut menjadi nilai normalisasi.

Karena keenam kriteria merupakan kriteria Benefit (semakin tinggi nilai, semakin baik), rumus yang digunakan adalah:

![Ilustrasi/perhitungan](assets/image_02.png)

Penjelasan sederhananya :

Nilai rata-rata Neysa dibagi nilai tertinggi pada kriteria yang sama di antara seluruh guru

Untuk contoh ini, kita mengasumsikan nilai tertinggi setiap kriteria adalah 100

Hasil normalisasi berada pada rentang 0 sampai 1

Berikut perhitungan satu per satu

C1

![Ilustrasi/perhitungan](assets/image_17.png)

C2

![Ilustrasi/perhitungan](assets/image_13.png)

C3

![Ilustrasi/perhitungan](assets/image_08.png)

C4

![Ilustrasi/perhitungan](assets/image_07.png)

C5

![Ilustrasi/perhitungan](assets/image_03.png)

C6

![Ilustrasi/perhitungan](assets/image_15.png)

Hasil normalisasinya :

| Kriteria | Rata-rata | Nilai maksimum asumsi |  | Normalisasi |
|---|---|---|---|---|
| C1 | 60 | 100 | 60 / 100 | 0,60 |
| C2 | 40 | 100 | 40 / 100 | 0,40 |
| C3 | 70 | 100 | 70 / 100 | 0,70 |
| C4 | 60 | 100 | 60 / 100 | 0,60 |
| C5 | 90 | 100 | 90 / 100 | 0,90 |
| C6 | 20 | 100 | 20 / 100 | 0,20 |

Artinya dimana misal nilai normalisasi C5 sebesar 0,90 berarti nilai rata-rata Neysa pada C5 mencapai 90% dari nilai maksimum yang diasumsikan

Menghitung nilai akhir SAW

Sekarang kita kalikan setiap nilai normalisasi dengan bobot kriterianya, lalu jumlahkan semua hasilnya

Rumus umum SAW

![Ilustrasi/perhitungan](assets/image_09.png)

Untuk sistem kami, rumus lengkapnya adalah :

![Ilustrasi/perhitungan](assets/image_04.png)

Masukkan nilai normalisasi Neysa yang teklah dihitung

| Kriteria | Normalisasi | Bobot | Perhitungan |  |
|---|---|---|---|---|
| C1 | 0,60 | 25% | 0,60 x 0,25 | 0,150 |
| C2 | 0,40 | 25% | 0,40 x 0,25 | 0,100 |
| C3 | 0,70 | 15% | 0,70 x 0,15 | 0,105 |
| C4 | 0,60 | 10% | 0,60 x 0,10 | 0,060 |
| C5 | 0,90 | 15% | 0,90 x 0,15 | 0,135 |
| C6 | 0,20 | 10% | 0,20 x 0,010 | 0,020 |
| Total |  |  | 1,00 | 0,570 |

Lalu jumlahkan semua hasil perkaliannya dan didapati lah hasil akhir yaitu

0.570

Jadi nilai akhir SAW Neysa adalah 0,571 berdasarkan bobot, konversi nilai, dan asumsi normalisasi yang digunakan. Dan hasilnya juga sama dengan hasil yang ada pada perhitungan SAW aplikasi.

![Ilustrasi/perhitungan](assets/image_18.png)

### Hasil Rata-rata

| Kriteria | Nilai A | Nilai B | Perhitungan rata-rata | Hasil |
|---|---:|---:|---|---:|
| C1 | 60 | 60 | (60 + 60) / 2 | 60 |
| C2 | 40 | 40 | (40 + 20) / 2 | 40 |
| C3 | 80 | 60 | (80 + 60) / 2 | 70 |
| C4 | 80 | 40 | (80 + 40) / 2 | 60 |
| C5 | 80 | 100 | (80 + 100) / 2 | 90 |
| C6 | 20 | 20 | (20 + 20) / 2 | 20 |

## D. Melakukan Normalisasi

Setelah mendapatkan rata-rata, nilai diubah menjadi nilai normalisasi. Karena keenam kriteria merupakan kriteria **Benefit** (semakin tinggi nilai, semakin baik), rumus yang digunakan ditampilkan pada ilustrasi berikut.

Penjelasan sederhana:
1. Nilai rata-rata Neysa dibagi nilai tertinggi pada kriteria yang sama di antara seluruh guru.
2. Untuk contoh ini, diasumsikan nilai tertinggi setiap kriteria adalah 100.
3. Hasil normalisasi berada pada rentang 0 sampai 1.

### Hasil Normalisasi

| Kriteria | Rata-rata | Nilai maksimum asumsi | Perhitungan | Normalisasi |
|---|---:|---:|---|---:|
| C1 | 60 | 100 | 60 / 100 | 0,60 |
| C2 | 40 | 100 | 40 / 100 | 0,40 |
| C3 | 70 | 100 | 70 / 100 | 0,70 |
| C4 | 60 | 100 | 60 / 100 | 0,60 |
| C5 | 90 | 100 | 90 / 100 | 0,90 |
| C6 | 20 | 100 | 20 / 100 | 0,20 |

Artinya, nilai normalisasi C5 sebesar 0,90 berarti nilai rata-rata Neysa pada C5 mencapai 90% dari nilai maksimum yang diasumsikan.

## E. Menghitung Nilai Akhir SAW

Setiap nilai normalisasi dikalikan dengan bobot kriterianya, kemudian seluruh hasilnya dijumlahkan.

### Perhitungan Nilai Akhir

| Kriteria | Normalisasi | Bobot | Perhitungan | Hasil |
|---|---:|---:|---|---:|
| C1 | 0,60 | 25% | 0,60 × 0,25 | 0,150 |
| C2 | 0,40 | 25% | 0,40 × 0,25 | 0,100 |
| C3 | 0,70 | 15% | 0,70 × 0,15 | 0,105 |
| C4 | 0,60 | 10% | 0,60 × 0,10 | 0,060 |
| C5 | 0,90 | 15% | 0,90 × 0,15 | 0,135 |
| C6 | 0,20 | 10% | 0,20 × 0,10 | 0,020 |
| **Total** | | **100%** | | **0,570** |

Jumlah hasil perkalian menghasilkan nilai akhir **0,570**.

Dokumen sumber juga menyatakan bahwa nilai akhir SAW Neysa adalah **0,571** dan hasilnya sama dengan hasil yang ada pada perhitungan SAW aplikasi.

## Catatan Pemeriksaan

Angka pada tabel perhitungan menghasilkan total 0,570, sedangkan kalimat penutup dokumen sumber menyebutkan 0,571. Perbedaan ini dipertahankan sesuai isi dokumen sumber dan perlu dikonfirmasi sebelum dijadikan hasil final.
