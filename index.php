<?php
session_start();

if (!isset($_SESSION['jadwal'])) $_SESSION['jadwal'] = [];
if (!isset($_SESSION['tugas'])) $_SESSION['tugas'] = [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Informasi Perkuliahan Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="text-center mb-4">Dashboard Kuliah</h1>

    <div class="mb-4">
        <a href="tambah_jadwal.php" class="btn btn-primary">Tambah Jadwal</a>
    </div>
    <h3>Jadwal Kuliah</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th><th>Mata Kuliah</th><th>Hari</th><th>Jam</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['jadwal'] as $i => $jadwal): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($jadwal['mata_kuliah']) ?></td>
                <td><?= htmlspecialchars($jadwal['hari']) ?></td>
                <td><?= htmlspecialchars($jadwal['jam']) ?></td>
                <td><a href="hapus.php?tipe=jadwal&index=<?= $i ?>" class="btn btn-danger btn-sm">Hapus</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mb-4 mt-5">
        <a href="tambah_tugas.php" class="btn btn-success">Tambah Tugas</a>
    </div>
    <h3>Daftar Tugas</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th><th>Mata Kuliah</th><th>Deskripsi</th><th>Deadline</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['tugas'] as $i => $tugas): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($tugas['mata_kuliah']) ?></td>
                <td><?= htmlspecialchars($tugas['tugas']) ?></td>
                <td><?= htmlspecialchars($tugas['deadline']) ?></td>
                <td><a href="hapus.php?tipe=tugas&index=<?= $i ?>" class="btn btn-danger btn-sm">Hapus</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
