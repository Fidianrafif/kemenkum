<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

$baseDir = realpath(__DIR__ . '/..'); // root folder project

if (isset($_POST['page']) && isset($_POST['content'])) {
    $page = $_POST['page'];
    $filePath = realpath($baseDir . '/' . $page);

    if (!$filePath || strpos($filePath, $baseDir) !== 0) {
        die("Akses ditolak!");
    }

    if (file_exists($filePath)) {
        file_put_contents($filePath, $_POST['content']);
        header("Location: dashboard.php");
        exit();
    } else {
        echo "File tidak ditemukan.";
    }
}
?>
