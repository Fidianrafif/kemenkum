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

if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $conn->query("UPDATE pengaduan SET status='$status' WHERE id=$id");
    echo "<script>window.location.href='pengaduan.php';</script>";
}

$result = $conn->query("SELECT * FROM pengaduan ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pengaduan | Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<link rel="stylesheet" href="style.css">

<body class="bg-[#0b2b5b] text-white min-h-screen">

  <header class="bg-white text-[#0b2b5b] py-4 shadow-md text-center font-bold text-xl">
    Daftar Pengaduan Masyarakat
  </header>

  <main class="p-6">
    <table class="w-full text-left border-collapse bg-white text-[#0b2b5b] rounded-xl overflow-hidden">
    <thead class="bg-[#133e7c] text-white">
  <tr>
    <th class="p-3">ID</th>
    <th class="p-3">Nama</th>
    <th class="p-3">Email</th>
    <th class="p-3">Jenis Pengaduan</th>
    <th class="p-3">Isi Pengaduan</th>
    <th class="p-3">Tanggal</th>
    <th class="p-3">Status</th>
    <th class="p-3 text-center">Aksi</th>
  </tr>
    </thead>

<tbody>
  <?php while($row = $result->fetch_assoc()) { ?>
  <tr class="border-b hover:bg-gray-100 text-center">
    <td class="p-3"><?php echo $row['id']; ?></td>
    <td class="p-3"><?php echo htmlspecialchars($row['nama']); ?></td>
    <td class="p-3"><?php echo htmlspecialchars($row['email']); ?></td>
    <td class="p-3"><?php echo htmlspecialchars($row['jenis_pengaduan']); ?></td>
    <td class="p-3"><?php echo htmlspecialchars($row['isi_pengaduan']); ?></td>
    <td class="p-3"><?php echo $row['tanggal']; ?></td>

    <!-- Status dengan warna -->
    <td class="p-3 font-bold 
      <?php echo ($row['status']=='selesai') ? 'text-green-600' : 
                  (($row['status']=='diproses') ? 'text-yellow-500' : 'text-red-500'); ?>">
      <?php echo ucfirst($row['status']); ?>
    </td>

    <td class="p-3 text-center">
      <form method="POST" style="display:inline;">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <select name="status" class="border rounded p-1 text-sm">
          <option value="baru" <?php if($row['status']=='baru') echo 'selected'; ?>>Baru</option>
          <option value="diproses" <?php if($row['status']=='diproses') echo 'selected'; ?>>Diproses</option>
          <option value="selesai" <?php if($row['status']=='selesai') echo 'selected'; ?>>Selesai</option>
        </select>
        <button type="submit" name="update_status"
          class="bg-blue-600 hover:bg-blue-500 text-white px-2 py-1 rounded text-sm">
          Update
        </button>
      </form>

      <a href="hapus.php?id=<?php echo $row['id']; ?>" 
         onclick="return confirm('Yakin ingin menghapus data ini?')" 
         class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-500 transition text-sm">
         Hapus
      </a>
    </td>
  </tr>
  <?php } ?>
</tbody>
    </table>

    <div class="text-center mt-6">
      <a href="dashboard.php" class="bg-yellow-400 text-[#0b2b5b] px-6 py-2 rounded-md font-bold hover:bg-yellow-300 transition">← Kembali</a>
    </div>
  </main>
</body>
</html>
