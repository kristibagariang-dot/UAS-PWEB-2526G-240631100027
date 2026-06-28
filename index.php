<?php

session_start();

if($_SESSION['status'] != "login") {
    header("location:login.php");
    exit; 
}

include 'koneksi.php';
include 'fungsi.php'; 

$cari = "";

if(isset($_GET['cari'])) {
    $cari = $_GET['cari'];
    $data = mysqli_query($koneksi,
    "SELECT * FROM mahasiswa
    WHERE nama LIKE '%$cari%'
    OR nim LIKE '%$cari%'");
} else {
    $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAS - Sistem Informasi Manajemen Akademik Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #2f3542;
        }
        
        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR PANEL */
        .sidebar-panel {
            width: 280px;
            background-color: #0c2417; 
            color: #f1f2f6;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            border-right: 3px solid #d4af37; 
        }
        .sidebar-brand {
            font-weight: 700;
            font-size: 22px;
            color: #d4af37 !important;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .sidebar-brand span {
            font-size: 11px;
            display: block;
            color: #a4b0be;
            font-weight: 400;
            margin-top: 4px;
        }
        .nav-menu-link {
            color: #ced6e0;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 8px;
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .nav-menu-link:hover, .nav-menu-link.active {
            background-color: #163e28;
            color: #d4af37;
            padding-left: 24px;
        }

        /* CONTENT PANEL */
        .content-panel {
            flex: 1;
            padding: 40px;
        }
        .welcome-title-panel {
            color: #0c2417;
            font-weight: 700;
        }

        /* STATISTIK GRID KOTAK */
        .stat-grid-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .stat-title {
            font-size: 12px;
            font-weight: 700;
            color: #747d8c;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #0c2417;
        }

        /* DATA TABEL CARD */
        .data-table-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 25px;
        }
        .search-input-pill {
            border-radius: 30px;
            padding: 10px 20px 10px 45px;
            border: 1px solid #ced4da;
            background-color: #f8f9fa;
        }
        .search-box-wrapper {
            position: relative;
        }
        .search-box-wrapper .bi-search {
            position: absolute;
            left: 18px;
            top: 13px;
            color: #a4b0be;
        }
        .badge-jurusan-custom {
            background-color: #e8f4ee;
            color: #0c2417;
            border: 1px solid #b7dcce;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="main-wrapper">
    
    <div class="sidebar-panel">
        <div class="sidebar-brand">
            <i class="bi bi-mortarboard-fill me-2"></i>SIMAS
            <span>SISTEM INFORMASI MAHASISWA</span>
        </div>
        
        <nav class="flex-column">
            <a class="nav-menu-link active" href="index.php">
                <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard Utama
            </a>
            <a class="nav-menu-link" href="tambah.php">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah Data
            </a>
        </nav>
    </div>

    <div class="content-panel">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="welcome-title-panel mb-1">Selamat Datang Kembali di SIMAS</h2>
                <p class="text-muted small mb-0">Halaman pengelolaan data akademik dan administrasi mahasiswa universitas.</p>
            </div>
            <div class="d-flex align-items-center">
                <span class="text-muted small me-3">
                    <i class="bi bi-shield-check text-success me-1"></i> Peran: <span class="badge bg-dark text-warning">Staf Administrasi</span>
                </span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('Apakah anda ingin keluar?')">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </a>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-grid-card border-start border-4 border-primary">
                    <div class="stat-title mb-1"><i class="bi bi-people me-1"></i> Total Mahasiswa</div>
                    <div class="stat-value"><?php echo hitungTotalMahasiswa(); ?> <span class="fs-6 fw-normal text-muted">Orang</span></div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-grid-card border-start border-4 border-success">
                    <div class="stat-title mb-1"><i class="bi bi-database-check me-1"></i> Status Basisdata</div>
                    <div class="stat-value text-success fs-5 mt-2 fw-bold">TERHUBUNG</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-grid-card border-start border-4 border-warning">
                    <div class="stat-title mb-1"><i class="bi bi-shield-lock me-1"></i> Sesi Akses</div>
                    <div class="stat-value text-warning fs-5 mt-2 fw-bold">TERAMANKAN</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="stat-grid-card border-start border-4 border-info">
                    <div class="stat-title mb-1"><i class="bi bi-journal-bookmark me-1"></i> Validasi UAS</div>
                    <div class="stat-value text-info fs-5 mt-2 fw-bold">SIAP DINILAI</div>
                </div>
            </div>
        </div>

        <div class="data-table-card">
            <div class="row mb-4 align-items-center">
                <div class="col-12 col-md-6">
                    <h5 class="fw-bold m-0 text-dark"><i class="bi bi-table me-2 text-secondary"></i>Master Data Registrasi Mahasiswa</h5>
                </div>
                <div class="col-12 col-md-6 mt-3 mt-md-0">
                    <form method="GET">
                        <div class="search-box-wrapper">
                            <i class="bi bi-search"></i>
                            <input type="text" name="cari" class="form-control search-input-pill" value="<?php echo htmlspecialchars($cari); ?>" placeholder="Cari mahasiswa berdasarkan nama atau NIM...">
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom">
                        <tr>
                            <th class="text-center text-muted small fw-bold py-3" width="6%">NO</th>
                            <th class="text-muted small fw-bold py-3">NAMA LENGKAP</th>
                            <th class="text-muted small fw-bold py-3">NIM</th>
                            <th class="text-muted small fw-bold py-3">EMAIL</th>
                            <th class="text-muted small fw-bold py-3">NO. HANDPHONE</th>
                            <th class="text-muted small fw-bold py-3">PROGRAM STUDI</th>
                            <th class="text-center text-muted small fw-bold py-3" width="15%">AKSI MANAJEMEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if(mysqli_num_rows($data) > 0) {
                            while($d = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <td class="text-center text-secondary fw-bold"><?php echo $no++; ?></td>
                            <td><span class="fw-bold text-dark"><?php echo $d['nama']; ?></span></td>
                            <td><code class="text-dark bg-light px-2 py-1 rounded fw-bold"><?php echo $d['nim']; ?></code></td>
                            <td><span class="text-muted fs-7"><?php echo $d['email']; ?></span></td>
                            <td><span class="text-muted fs-7"><?php echo $d['no_hp']; ?></span></td>
                            <td>
                                <span class="badge badge-jurusan-custom px-3 py-2 rounded-pill fs-7">
                                    <i class="bi bi-mortarboard me-1"></i><?php echo formatJurusan($d['jurusan']); ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group gap-2">
                                    <a href="edit.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-outline-warning rounded px-2">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="hapus.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-outline-danger rounded px-2" onclick="return confirm('Hapus record data mahasiswa ini?')">
                                        <i class="bi bi-trash3-fill"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            } 
                        } else {
                            echo "<tr><td colspan='7' class='text-center py-5 text-muted'><i class='bi bi-patch-question fs-3 mb-2 d-block'></i>Data tidak ditemukan dalam catatan database.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</body>
</html>