<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "layanan_kanwil");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus data berdasarkan ID
    $sql = "DELETE FROM pengaduan WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Data pengaduan berhasil dihapus!');
                window.location.href='pengaduan.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data!');
                window.location.href='pengaduan.php';
              </script>";
    }
} else {
    header("Location: pengaduan.php");
    exit();
}
?>
