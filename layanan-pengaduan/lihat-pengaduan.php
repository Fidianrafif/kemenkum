<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "layanan_kanwil";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil semua data dari tabel pengaduan
$sql = "SELECT * FROM pengaduan ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pengaduan | Kanwil Kemenkumham DIY</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Arial', sans-serif;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #002B5B;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body class="p-6">
  <h1 class="text-2xl font-bold text-[#002B5B] mb-6 text-center">
    📋 Daftar Pengaduan Masyarakat
  </h1>

  <div class="overflow-x-auto bg-white rounded-lg shadow-lg p-4">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Jenis Pengaduan</th>
          <th>Isi Pengaduan</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['jenis_pengaduan']}</td>
                        <td>{$row['isi_pengaduan']}</td>
                        <td>{$row['tanggal']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center text-gray-500 py-4'>Belum ada pengaduan.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="mt-6 flex justify-center">
    <button onclick="window.location.href='aduan.html'"
      class="bg-[#002B5B] text-white font-semibold px-6 py-2 rounded-full shadow-md hover:bg-[#01427c] transition">
      ← Kembali ke Form Pengaduan
    </button>
  </div>
</body>
</html>

<?php
$conn->close();
?>
