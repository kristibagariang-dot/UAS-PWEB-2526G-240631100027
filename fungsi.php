<?php
include_once 'koneksi.php';

// Fungsi 1: Menghitung total mahasiswa terdaftar di database
function hitungTotalMahasiswa() {
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM mahasiswa");
    $data = mysqli_fetch_assoc($query);
    return $data['total'];
}

// Fungsi 2: Memformat nama jurusan menjadi huruf kapital di awal kata (Title Case)
function formatJurusan($jurusan) {
    return ucwords(strtolower($jurusan));
}
?>