<?php
include 'koneksi.php';

if(isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    mysqli_query($koneksi,
    "INSERT INTO users VALUES(
    '',
    '$username',
    '$password'
    )");

    echo "Registrasi berhasil";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="container mt-5">

<div class="card p-4">

<h3>Register</h3>

<form method="POST">

<input type="text"
name="username"
class="form-control mb-3"
placeholder="Masukkan Username">

<input type="password"
name="password"
class="form-control mb-3"
placeholder="Masukkan Password">

<button type="submit"
name="register"
class="btn btn-success">
Daftar
</button>

</form>

<br>

<a href="login.php">
Sudah punya akun? Login
</a>

</div>
</div>

</body>
</html>