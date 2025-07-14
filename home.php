<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

// Manual format Indonesia
$hariIndo = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
$bulanIndo = [
    1=>'Januari','Februari','Maret','April','Mei','Juni',
    'Juli','Agustus','September','Oktober','November','Desember'
];

$hari = $hariIndo[date('w')];
$tanggal = date('d');
$bulan = $bulanIndo[date('n')];
$tahun = date('Y');

$tanggalHariIni = "$hari, $tanggal $bulan $tahun";



// Inisialisasi data dummy jika session kosong
if (!isset($_SESSION['jadwal'])) $_SESSION['jadwal'] = [];
if (!isset($_SESSION['tugas'])) $_SESSION['tugas'] = [];

// Rekomendasi Jadwal Terdekat (jika ada)
$rekomJadwal = !empty($_SESSION['jadwal']) ? $_SESSION['jadwal'][0] : null;

// Rekomendasi Tugas Deadline Terdekat (jika ada)
$rekomTugas = null;
if (!empty($_SESSION['tugas'])) {
    usort($_SESSION['tugas'], function($a, $b) {
        return strtotime($a['deadline']) - strtotime($b['deadline']);
    });
    $rekomTugas = $_SESSION['tugas'][0];
}

// Statistik
$totalJadwal = count($_SESSION['jadwal']);
$totalTugas = count($_SESSION['tugas']);

// Tugas dengan deadline < 3 hari dari sekarang
$deadlineMepet = [];
$today = strtotime(date('Y-m-d'));
foreach ($_SESSION['tugas'] as $tugas) {
    $deadline = strtotime($tugas['deadline']);
    if ($deadline >= $today && $deadline <= strtotime('+3 days', $today)) {
        $deadlineMepet[] = $tugas;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="home.php">Sistem Kuliah</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Jadwal & Tugas</a></li>
                <li class="nav-item"><a class="nav-link" href="tambah_jadwal.php">Tambah Jadwal</a></li>
                <li class="nav-item"><a class="nav-link" href="tambah_tugas.php">Tambah Tugas</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Konten -->
<div class="container py-5 text-center">
    <h1 class="mb-4">Selamat Datang di Sistem Manajemen Kuliah</h1>
<p>Hari ini: <strong><?= $tanggalHariIni ?></strong></p>


    <a href="index.php" class="btn btn-primary btn-lg m-2">Lihat Jadwal & Tugas</a>
    <a href="tambah_jadwal.php" class="btn btn-success btn-lg m-2">Tambah Jadwal</a>
    <a href="tambah_tugas.php" class="btn btn-warning btn-lg m-2">Tambah Tugas</a>
</div>

<!-- Statistik -->
<div class="container py-4">
    <h3>Statistik Kuliah</h3>
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Total Jadwal</h5>
                    <p class="display-6"><?= $totalJadwal ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Total Tugas</h5>
                    <p class="display-6"><?= $totalTugas ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Tugas Deadline < 3 Hari</h5>
                    <p class="display-6"><?= count($deadlineMepet) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rekomendasi -->
<div class="container py-4">
    <h3>Rekomendasi untuk Anda</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">Mata Kuliah Terdekat</div>
                <div class="card-body">
                    <?php if ($rekomJadwal): ?>
                        <h5><?= htmlspecialchars($rekomJadwal['mata_kuliah']) ?></h5>
                        <p>Hari: <?= htmlspecialchars($rekomJadwal['hari']) ?></p>
                        <p>Jam: <?= htmlspecialchars($rekomJadwal['jam']) ?></p>
                    <?php else: ?>
                        <p>Belum ada jadwal kuliah terdekat.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-warning text-white">Tugas Deadline Terdekat</div>
                <div class="card-body">
                    <?php if ($rekomTugas): ?>
                        <h5><?= htmlspecialchars($rekomTugas['mata_kuliah']) ?></h5>
                        <p><?= htmlspecialchars($rekomTugas['tugas']) ?></p>
                        <p>Deadline: <?= htmlspecialchars($rekomTugas['deadline']) ?></p>
                    <?php else: ?>
                        <p>Tidak ada tugas yang mendekati deadline.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-5">
    <div class="container">
        <small>&copy; <?= date('Y') ?> Sistem Manajemen Kuliah | All Rights Reserved</small>
    </div>
</footer>

</body>
</html>
