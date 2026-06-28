# UAS Pemrograman Web - SIMAS

### Identitas Mahasiswa
* **Nama:** Kristivera Sibagariang
* **NIM:** 24063110027
* **Kelas:** PWEB-2526G

### Deskripsi Aplikasi
**SIMAS (Sistem Informasi Manajemen Akademik Siswa)** adalah aplikasi berbasis web dinamis yang dirancang untuk mengelola data registrasi mahasiswa. Aplikasi ini dibangun menggunakan PHP Native, basis data MySQL, dan framework Bootstrap 5 untuk tampilan antarmuka yang responsif.

### Struktur Database
Aplikasi ini menggunakan database `db_kampus` dengan tabel utama:
1. `users` (id, username, password) - Untuk autentikasi login.
2. `mahasiswa` (id, nama, nim, email, no_hp, jurusan) - Untuk data administrasi.

### Cara Menjalankan Aplikasi
1. Clone repositori ini atau unduh file ZIP-nya.
2. Pindahkan folder project ke direktori server lokal (`xampp/htdocs/`).
3. Buka `phpMyAdmin`, buat database baru bernama `db_kampus`.
4. Import file `database.sql` yang tersedia di dalam repositori ini ke dalam database baru tersebut.
5. Jalankan web browser dan akses URL: `http://localhost/uas_kristipem/login.php`.

### Pernyataan Penggunaan GenAI
Proyek aplikasi web SIMAS ini dikembangkan dengan asistensi perangkat Kecerdasan Artifisial (GenAI) Gemini secara bertanggung jawab. AI dimanfaatkan sebagai alat bantu (co-pilot) untuk mengoptimasi struktur layout CSS Flexbox dan memvalidasi logika keamanan session PHP. Seluruh penulisan fungsi kustom, query database, dan pengujian alur program tetap ditinjau, dipelajari, dan diuji secara mandiri oleh mahasiswa untuk memastikan orisinalitas kode.
