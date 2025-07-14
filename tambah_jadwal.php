<?php
session_start();

if (isset($_POST['submit'])) {
    $_SESSION['jadwal'][] = [
        'mata_kuliah' => $_POST['mata_kuliah'],
        'hari' => $_POST['hari'],
        'jam' => $_POST['jam'],
    ];
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2>Tambah Jadwal</h2>
    <form method="post">
        <div class="mb-3">
            <label>Mata Kuliah</label>
            <input type="text" name="mata_kuliah" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jam</label>
            <input type="text" name="jam" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
