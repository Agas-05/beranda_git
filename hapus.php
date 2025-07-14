<?php
session_start();

if (isset($_GET['tipe']) && isset($_GET['index'])) {
    $tipe = $_GET['tipe'];
    $index = $_GET['index'];

    if ($tipe === 'jadwal' && isset($_SESSION['jadwal'][$index])) {
        unset($_SESSION['jadwal'][$index]);
        $_SESSION['jadwal'] = array_values($_SESSION['jadwal']);
    }
    if ($tipe === 'tugas' && isset($_SESSION['tugas'][$index])) {
        unset($_SESSION['tugas'][$index]);
        $_SESSION['tugas'] = array_values($_SESSION['tugas']);
    }
}

header("Location: index.php");
exit;
?>
