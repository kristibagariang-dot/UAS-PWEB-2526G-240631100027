<?php

session_start();

if($_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}

include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi,
"SELECT * FROM mahasiswa WHERE id='$id'");

$d = mysqli_fetch_array($data);

if(isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $jurusan = $_POST['jurusan'];

    mysqli_query($koneksi,
    "UPDATE mahasiswa SET

    nama='$nama',
    nim='$nim',
    email='$email',
    no_hp='$no_hp',
    jurusan='$jurusan'

    WHERE id='$id'");

    header("location:index.php");
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2 class="text-center mb-4">
            Edit Data Mahasiswa
        </h2>

        <form method="POST">

            <label>Nama</label>

            <input
            type="text"
            name="nama"
            class="form-control mb-3"
            value="<?php echo $d['nama']; ?>"
            required>

            <label>NIM</label>

            <input
            type="text"
            name="nim"
            class="form-control mb-3"
            value="<?php echo $d['nim']; ?>"
            required>

            <label>Email</label>

            <input
            type="email"
            name="email"
            class="form-control mb-3"
            value="<?php echo $d['email']; ?>"
            required>

            <label>Nomor HP</label>

            <input
            type="text"
            name="no_hp"
            class="form-control mb-3"
            value="<?php echo $d['no_hp']; ?>"
            required>

            <label>Jurusan</label>

            <input
            type="text"
            name="jurusan"
            class="form-control mb-3"
            value="<?php echo $d['jurusan']; ?>"
            required>

            <button
            type="submit"
            name="submit"
            class="btn btn-warning">
                Update
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