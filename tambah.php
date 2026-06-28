<?php

session_start();
if($_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}

include 'koneksi.php';

if(isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $jurusan = $_POST['jurusan'];

    mysqli_query($koneksi,
    "INSERT INTO mahasiswa VALUES(
    '',
    '$nama',
    '$nim',
    '$email',
    '$no_hp',
    '$jurusan'
    )");

    header("location:index.php");
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Tambah Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2 class="text-center mb-4">
            Tambah Data Mahasiswa
        </h2>

        <form method="POST">

            <label>Nama</label>
            <input
            type="text"
            name="nama"
            class="form-control mb-3"
            required>

            <label>NIM</label>
            <input
            type="text"
            name="nim"
            class="form-control mb-3"
            required>

            <label>Email</label>
            <input
            type="email"
            name="email"
            class="form-control mb-3"
            required>

            <label>Nomor HP</label>
            <input
            type="text"
            name="no_hp"
            class="form-control mb-3"
            required>

            <label>Jurusan</label>
            <input
            type="text"
            name="jurusan"
            class="form-control mb-3"
            required>

            <button
            type="submit"
            name="submit"
            class="btn btn-success">
                Simpan
            </button>

            <a href="index.php"
            class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

</body>
</html>