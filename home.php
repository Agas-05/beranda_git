<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

// Format hari dan bulan dalam Bahasa Indonesia
$hariIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$bulanIndo = [
    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

$hari = $hariIndo[date('w')];
$tanggal = date('d');
$bulan = $bulanIndo[date('n')];
$tahun = date('Y');
$tanggalHariIni = "$hari, $tanggal $bulan $tahun";

// Inisialisasi session jika belum ada
if (!isset($_SESSION['jadwal'])) $_SESSION['jadwal'] = [];
if (!isset($_SESSION['tugas'])) $_SESSION['tugas'] = [];

// Ambil jadwal terdekat
$rekomJadwal = !empty($_SESSION['jadwal']) ? $_SESSION['jadwal'][0] : null;

// Ambil tugas dengan deadline terdekat
$rekomTugas = null;
if (!empty($_SESSION['tugas'])) {
    usort($_SESSION['tugas'], function ($a, $b) {
        return strtotime($a['deadline']) - strtotime($b['deadline']);
    });
    $rekomTugas = $_SESSION['tugas'][0];
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda</title>
</head>
<body>
    <h1>Selamat Datang</h1>
    <p>Tanggal Hari Ini: <?= $tanggalHariIni ?></p>

    <h2>Rekomendasi Jadwal Terdekat:</h2>
    <?php if ($rekomJadwal): ?>
        <p><?= htmlspecialchars($rekomJadwal['kegiatan']) ?> - <?= htmlspecialchars($rekomJadwal['waktu']) ?></p>
    <?php else: ?>
        <p>Tidak ada jadwal.</p>
    <?php endif; ?>

    <h2>Rekomendasi Tugas Deadline Terdekat:</h2>
    <?php if ($rekomTugas): ?>
        <p><?= htmlspecialchars($rekomTugas['nama']) ?> - Deadline: <?= htmlspecialchars($rekomTugas['deadline']) ?></p>
    <?php else: ?>
        <p>Tidak ada tugas.</p>
    <?php endif; ?>
</body>
</html>
