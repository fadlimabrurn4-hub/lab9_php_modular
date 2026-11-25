# Praktikum 9: PHP Modular - Lab9Web   

Nama : Fadli Mabrur Nahari  
NIM : 312510294  
Kelas : I251A  
Mata Kuliah : Pemrograman Web

## J. Latihan Terstruktur

### Latihan 1: Template Multi-Halaman
Dibuat tiga halaman (Home, Profil, Kontak) yang memakai satu header dan footer yang sama. Setiap halaman hanya berisi kontennya sendiri, lalu memanggil template dengan `require_once __DIR__ . '/header.php'` di awal dan `footer.php` di akhir. Dengan begitu tidak ada salinan kode header atau footer di file halaman, dan mengubah menu cukup dilakukan di `header.php`.

| File | Tanggung jawab |
|------|----------------|
| `header.php` | Awal dokumen HTML, judul, link CSS, dan navigasi |
| `footer.php` | Penutup halaman dan tahun otomatis dengan `date('Y')` |
| `home.php`, `profil.php`, `kontak.php` | Konten khusus tiap halaman |
| `style.css` | Tampilan yang dipakai bersama |

<img src="Foto/kode1.png">  
<img src="Foto/kode1L.png">  
<img src="Foto/kode1L1.png">  
<img src="Foto/kode1L2.png">  
<img src="Foto/kode1L3.png">  
<img src="Foto/css1.png">  
<img src="Foto/css2.png">    

Hasil: ketiga halaman menampilkan header, navigasi, dan footer yang sama, hanya kontennya yang berbeda.

<img src="Foto/hasil1.png">  
<img src="Foto/hasil1L.png">  
<img src="Foto/hasil1L1.png">  

### Latihan 2: Library Function
Semua function dikumpulkan di `helpers/functions.php` dan dipakai oleh dua halaman (`produk.php` dan `daftar.php`).

| Function | Fungsi |
|----------|--------|
| `formatRupiah(float $angka): string` | Mengubah angka menjadi format `Rp 7.500.000` |
| `hitungDiskon(float $harga, float $persen = 10): float` | Menghitung nilai potongan harga (default 10%) |
| `validasiEmail(string $email): bool` | Memeriksa format email dengan `filter_var()` |
| `ringkasTeks(string $teks, int $batas = 50): string` | Memotong teks panjang dan menambahkan `...` |
| `e(string $nilai): string` | Escaping output dengan `htmlspecialchars()` |

- **`produk.php`** menampilkan tabel produk. Setiap harga diformat dengan `formatRupiah()`, diskon 10% dihitung dengan `hitungDiskon()`, dan deskripsi dipotong 40 karakter dengan `ringkasTeks()`. Contohnya Laptop Rp 7.500.000 mendapat diskon Rp 750.000 sehingga harga akhirnya Rp 6.750.000.
- **`daftar.php`** berisi form email yang divalidasi dengan `validasiEmail()`. Input `raihan` menghasilkan pesan "Format email tidak valid", sedangkan `raihan@gmail.com` menghasilkan "Email valid".

<img src="Foto/kode2.png">  
<img src="Foto/kode2L.png">  
<img src="Foto/Kode2L1.png">  
<img src="Foto/css1.png">  
<img src="Foto/css2.png">    
<img src="Foto/hasil2.png">  
<img src="Foto/hasil2L.png">  
<img src="Foto/hasil2L1.png">  

### Latihan 3: Router Aman
Dibuat `index.php` sebagai pintu masuk tunggal. Halaman dipilih lewat parameter `?page=...` dan hanya rute yang terdaftar di array `$routes` (whitelist) yang boleh dimuat. Nilai `page` tidak pernah dipakai langsung sebagai path file. Jika `page` tidak terdaftar atau bukan string, aplikasi mengirim status **404** dan memuat `views/404.php`.

Daftar rute:

| Rute | File |
|------|------|
| `home` (default) | `views/home.php` |
| `profil` | `views/profil.php` |
| `kontak` | `views/kontak.php` |
| `produk` | `views/produk.php` |
| `tentang` | `views/tentang.php` |
| selain di atas | `views/404.php` (status 404) |

<img src="Foto/kode2.png">  
<img src="Foto/kode3.png">  
<img src="Foto/kode3L.png">  
<img src="Foto/kode3L1.png">  
<img src="Foto/Kode3L2.png">  
<img src="Foto/kode3L3.png">  
<img src="Foto/kode3L4.png">  
<img src="Foto/kode3L5.png">  
<img src="Foto/kode3L6.png">  
<img src="Foto/Kode3L7.png">  
<img src="Foto/css1.png">  
<img src="Foto/css2.png">  

Hasil pengujian rute `index.php`, `?page=profil`, `?page=kontak`, `?page=produk`, dan `?page=tentang`:

<img src="Foto/hasil3.png">  
<img src="Foto/hasil3L.png">  
<img src="Foto/hasil3L1.png">  
<img src="Foto/hasil3L2.png">  
<img src="Foto/hasil3L3.png">   

### Latihan 4: Refactoring CRUD
Aplikasi CRUD data barang dari Praktikum 8 disalin sebagai project baru lalu disusun ulang mengikuti struktur direktori modul.

```
latihan4/
├── index.php              # router (titik masuk)
├── config/database.php    # satu-satunya file koneksi database
├── helpers/functions.php  # function umum (is_select)
├── views/                 # header, footer, dashboard, 404
├── modules/user/          # list, add, edit, delete
└── assets/css/style.css
```

Hal yang dilakukan pada refactoring:
- Koneksi database dipindah ke `config/database.php` dan dimuat dengan `require_once`, sehingga hanya dikelola di satu file.
- Header, navigasi, dan footer dipindah ke `views/header.php` dan `views/footer.php`, dipanggil oleh router agar semua halaman memakai template yang sama.
- Halaman CRUD dikelompokkan di `modules/user/` dan semua tautan memakai pola `index.php?page=...`.
- Penghapusan dilakukan lewat form **POST** disertai konfirmasi `confirm()`, bukan lewat tautan GET, sesuai saran di modul.
- Output ke HTML diamankan dengan `htmlspecialchars()`, dan `ob_start()` ditambahkan di router agar `header('Location: ...')` pada modul tetap bisa dipakai setelah header HTML dicetak.

Daftar rute:

| Rute | File | Fungsi |
|------|------|--------|
| `dashboard` (default) | `views/dashboard.php` | Halaman awal |
| `user/list` | `modules/user/list.php` | Menampilkan data barang (Read) |
| `user/add` | `modules/user/add.php` | Menambah barang (Create) |
| `user/edit` | `modules/user/edit.php` | Mengubah barang (Update), memakai `&id=` |
| `user/delete` | `modules/user/delete.php` | Menghapus barang (Delete), hanya lewat POST |
| selain di atas | `views/404.php` | Halaman tidak ditemukan (status 404) |

Struktur direktori dan kode:

<img src="Foto/kode4.png">  
<img src="Foto/kode4L.png">  
<img src="Foto/kode4L1.png">
<img src="Foto/kode4L1.png">  
<img src="Foto/kode4L13.png">  
<img src="Foto/kode4L14.png">  
<img src="Foto/kode4L12.png">  
<img src="Foto/kode4L11.png">  
<img src="Foto/kode4L3.png">  
<img src="Foto/kode4L4.png">  
<img src="Foto/kode4L5.png">  
<img src="Foto/kode4L6.png">  
<img src="Foto/kode4L7.png">  
<img src="Foto/kode4L8.png">  
<img src="Foto/kode4L9.png">  
<img src="Foto/kode4L10.png">    

Hasil pengujian CRUD melalui router:

| Operasi | Hasil |
|---------|-------|
| Dashboard | Halaman awal tampil dengan template bersama |
| Read | Daftar tiga barang awal tampil di `?page=user/list` |
| Create | Barang baru (PC Asus) ditambahkan lewat form, lalu muncul di tabel bersama TV Sharp |
| Update | Barang HP Samsung Android diubah menjadi kategori Hand Phone dengan harga jual 2.500.000 |
| Delete | Muncul konfirmasi "Yakin ingin menghapus data ini?", lalu HP Oppo Android hilang dari tabel |

<img src="Foto/hasil4.png">  
<img src="Foto/hasil4L.png">  
<img src="Foto/hasil4L1.png">  
<img src="Foto/hasil4L2.png">  
<img src="Foto/hasil4L3.png">  
<img src="Foto/hasil4L4.png">  
<img src="Foto/hasil4L5.png">  
<img src="Foto/hasil4L6.png">  
<img src="Foto/hasil4L7.png">

## K. Debugging dan Permasalahan Umum

Berikut gejala yang umum terjadi pada praktikum ini beserta penyebab dan cara mengatasinya:

| Gejala | Kemungkinan penyebab | Perbaikan |
|--------|----------------------|-----------|
| `Failed opening required` | Path file salah atau file tidak ada | Periksa struktur folder dan bentuk path dengan `__DIR__` |
| `Function already declared` | File function dimuat lebih dari sekali | Gunakan `require_once` atau `include_once` |
| CSS tidak tampil | Path aset keliru | Periksa path CSS, misalnya `assets/css/style.css` pada Latihan 4 |
| Halaman 404 dari router | Nilai `page` tidak ada di whitelist | Periksa ejaan parameter dan daftar `$routes` |
| URL rewrite tidak bekerja | `mod_rewrite` atau `AllowOverride` belum aktif | Periksa konfigurasi Apache dan lokasi `.htaccess` |
| Konten tampil ganda | Header atau footer dipanggil dari lebih dari satu tempat | Pusatkan pemanggilan layout di router |

Kendala yang ditemui pada praktikum ini dan penanganannya:
- **Redirect setelah simpan, ubah, atau hapus.** Pada router, header HTML sudah dicetak sebelum file modul dijalankan, sehingga `header('Location: ...')` di modul berisiko gagal karena output sudah terkirim. Ini diatasi dengan menambahkan `ob_start()` di `index.php` dan memakai `exit;` setelah setiap redirect.
- **Pilihan kategori pada form ubah.** Function `is_select()` harus membandingkan nilai kategori dengan masing-masing opsi (`Komputer`, `Elektronik`, `Hand Phone`) agar kategori lama otomatis terpilih.
- **Penghapusan lewat URL.** Menghapus data hanya karena membuka URL GET berbahaya. Solusinya, tombol Hapus dibuat sebagai form POST dengan konfirmasi.
- **Gambar barang tampil sebagai ikon rusak.** File gambar tidak tersedia di folder proyek, sehingga browser tidak menemukan gambarnya. Data barang lainnya tetap berjalan normal.

## L. Pertanyaan Pemahaman

1. **Jelaskan pengertian modularisasi program dan minimal tiga manfaatnya.**
   * *Jawaban:* Modularisasi adalah teknik membagi aplikasi menjadi bagian-bagian kecil berdasarkan fungsi atau tanggung jawabnya, misalnya header, footer, koneksi database, dan function. Manfaatnya:
     * kode tidak perlu ditulis berulang karena modul dapat dipakai ulang;
     * perubahan tampilan atau konfigurasi cukup dilakukan di satu file;
     * aplikasi lebih mudah dipahami dan dirawat saat membesar;
     * pekerjaan dapat dibagi per modul sehingga mengurangi konflik dalam tim.

2. **Apa perbedaan `include` dan `require` ketika file yang dipanggil tidak ditemukan?**
   * *Jawaban:* `include` hanya menghasilkan peringatan (*warning*) dan eksekusi program tetap berlanjut. `require` menghasilkan error fatal sehingga eksekusi dihentikan. Karena itu `include` cocok untuk file tambahan yang tidak kritis, sedangkan `require` untuk file wajib.

3. **Mengapa `require_once` sesuai digunakan untuk memuat konfigurasi database?**
   * *Jawaban:* Konfigurasi database wajib tersedia, sehingga jika file tidak ada program sebaiknya berhenti (sifat `require`). Akhiran `_once` memastikan file hanya dimuat satu kali meskipun dipanggil dari beberapa tempat, sehingga koneksi tidak dibuat berulang dan tidak terjadi deklarasi ganda.

4. **Jelaskan perbedaan parameter, argumen, dan nilai return pada function.**
   * *Jawaban:* Parameter adalah variabel yang didefinisikan pada deklarasi function. Argumen adalah nilai yang dikirim saat function dipanggil. Nilai return adalah hasil yang dikembalikan function kepada pemanggilnya dan bisa disimpan atau dihitung lagi.
     ```php
     function hitungDiskon(float $harga, float $persen = 10): float  // $harga, $persen = parameter
     {
         return $harga * ($persen / 100);                              // nilai yang di-return
     }
     $diskon = hitungDiskon(7500000, 10);                             // 7500000 dan 10 = argumen
     ```

5. **Mengapa header dan footer sebaiknya dipisahkan dari konten halaman?**
   * *Jawaban:* Header dan footer dipakai oleh semua halaman. Jika dipisahkan, bagian itu cukup ditulis satu kali dan perubahan (misalnya menu) langsung berlaku di seluruh halaman. Tampilan menjadi konsisten, kode tidak berulang, dan konten tiap halaman lebih ringkas.

6. **Apa fungsi `index.php` pada pola routing yang dipraktikkan?**
   * *Jawaban:* `index.php` adalah titik masuk aplikasi sekaligus router. File ini membaca parameter `page`, memeriksanya terhadap daftar rute yang diizinkan, memilih file konten yang sesuai (atau halaman 404), lalu memuat header, konten, dan footer secara berurutan.

7. **Mengapa router sebaiknya menggunakan whitelist rute?**
   * *Jawaban:* Whitelist hanya mengizinkan halaman yang memang didaftarkan aplikasi. Permintaan di luar daftar otomatis ditolak dengan 404, sehingga pengguna tidak bisa memanggil file sembarangan lewat URL. Dengan begitu aplikasi lebih aman dan daftar halaman mudah dikelola.

8. **Apa risiko jika input `page` langsung digabungkan menjadi path file yang di-`require`?**
   * *Jawaban:* Penyerang bisa memanipulasi nilai `page` (misalnya dengan `../`) untuk membuka file di luar folder aplikasi atau memanggil file yang tidak dimaksudkan (*path traversal* atau *Local File Inclusion*). Akibatnya file konfigurasi atau kode sensitif bisa terbaca atau dieksekusi.

9. **Apa fungsi aturan `RewriteCond` dan `RewriteRule` pada `.htaccess`?**
   * *Jawaban:* `RewriteCond` menetapkan syarat yang harus terpenuhi sebelum aturan dijalankan. Pada modul, syaratnya adalah permintaan bukan file fisik (`!-f`) dan bukan direktori (`!-d`). `RewriteRule` mengubah atau meneruskan URL yang cocok ke tujuan lain, misalnya `/user/list` diteruskan ke `index.php?page=user/list`, sehingga URL tampak lebih ringkas.

10. **Sebutkan bagian aplikasi CRUD yang paling tepat dipindahkan ke `config`, `views`, `helpers`, dan `modules`.**
    * *Jawaban:*
      * **config/**: konfigurasi dan koneksi database (`database.php`).
      * **views/**: tampilan bersama seperti `header.php`, `footer.php`, `dashboard.php`, dan `404.php`.
      * **helpers/**: function umum yang dipakai banyak modul, misalnya `is_select()`, `formatRupiah()`, dan `e()`.
      * **modules/**: halaman fitur CRUD yang dikelompokkan per domain, yaitu `list.php`, `add.php`, `edit.php`, dan `delete.php` di `modules/user/`.
