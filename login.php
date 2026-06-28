<?php
session_start();

include 'koneksi.php';

$error_message = "";

if(isset($_POST['login'])) {

    // Amankan input data dari karakter aneh
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Mencari data pengguna yang cocok di tabel users
    $data = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($data);

    if($cek > 0) {
        $_SESSION['status'] = "login";
        $_SESSION['username'] = $username; // Menyimpan session username aktif
        header("location:index.php");
        exit;
    } else {
        // Menyimpan pesan error agar bisa dicetak dengan gaya bootstrap di bawah
        $error_message = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Data Mahasiswa</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background: linear-gradient(135deg, #6c5ce7, #a29bfe);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }
        .card-login {
            border: none;
            border-radius: 16px;
            background: #ffffff;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #6c5ce7, #54a0ff);
            border: none;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #54a0ff, #6c5ce7);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(108, 92, 231, 0.3);
        }
        .form-control:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.25);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            
            <div class="card card-login p-4 shadow-lg">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-dark mb-1">SIMAS</h3>
                        <p class="text-muted small">Sistem Informasi Data Mahasiswa</p>
                    </div>

                    <?php if(!empty($error_message)): ?>
                        <div class="alert alert-danger py-2 text-center small mb-3" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Username</label>
                            <input 
                                type="text" 
                                name="username" 
                                class="form-control py-2" 
                                placeholder="Masukkan username" 
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-secondary">Password</label>
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control py-2" 
                                placeholder="Masukkan password" 
                                required>
                        </div>

                        <button type="submit" name="login" class="btn btn-gradient w-100 py-2 mb-3">
                            Masuk Aplikasi
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        <span class="text-muted small">Belum terdaftar?</span>
                        <a href="register.php" class="text-decoration-none small fw-bold ms-1" style="color: #6c5ce7;">Buat Akun Baru</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>