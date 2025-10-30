<?php
// Konfigurasi koneksi ke database
$host = "localhost";
$user = "root";
$pass = ""; // isi jika MySQL kamu pakai password
$db   = "layanan_kanwil";

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form (pastikan sesuai dengan 'name' di HTML)
$nama  = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$jenis = $_POST['jenis_pengaduan'] ?? '';
$isi   = $_POST['isi_pengaduan'] ?? '';

// Validasi sederhana agar semua kolom diisi
if (empty($nama) || empty($email) || empty($jenis) || empty($isi)) {
    die("⚠️ Semua kolom wajib diisi!");
}

// Query untuk simpan data ke tabel pengaduan
$sql = "INSERT INTO pengaduan (nama, email, jenis_pengaduan, isi_pengaduan)
        VALUES ('$nama', '$email', '$jenis', '$isi')";

// Eksekusi query dan cek hasilnya
if ($conn->query($sql) === TRUE) {
    echo "
    <script>
        alert('✅ Pengaduan Anda berhasil dikirim. Terima kasih!');
        window.location.href = 'aduan.html';
    </script>
    ";
} else {
    echo "❌ Gagal mengirim pengaduan: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
