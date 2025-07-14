<?php
session_start();
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


// Inisialisasi jika kosong
if (!isset($_SESSION['jadwal'])) $_SESSION['jadwal'] = [];
if (!isset($_SESSION['tugas'])) $_SESSION['tugas'] = [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal & Tugas Publik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Jadwal Dan Tugas</a>
    </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4 text-center">Matkul Kelas 03WM03</h2>
    <p>Hari ini: <strong><?= $tanggalHariIni ?></strong></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th><th>Mata Kuliah</th><th>Hari</th><th>Jam</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($_SESSION['jadwal'])): ?>
                <?php foreach ($_SESSION['jadwal'] as $i => $jadwal): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($jadwal['mata_kuliah']) ?></td>
                        <td><?= htmlspecialchars($jadwal['hari']) ?></td>
                        <td><?= htmlspecialchars($jadwal['jam']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center">Belum ada jadwal tersedia.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2 class="mt-5 mb-4 text-center">Daftar Tugas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th><th>Mata Kuliah</th><th>Tugas</th><th>Deadline</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($_SESSION['tugas'])): ?>
                <?php foreach ($_SESSION['tugas'] as $i => $tugas): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($tugas['mata_kuliah']) ?></td>
                        <td><?= htmlspecialchars($tugas['tugas']) ?></td>
                        <td><?= htmlspecialchars($tugas['deadline']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center">Belum ada tugas tersedia.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <small>&copy; <?= date('Y') ?> Sistem Manajemen Kuliah - Publik View</small>
</footer>

</body>
</html>
