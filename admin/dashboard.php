<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

// Fungsi ambil daftar file HTML dari folder tertentu
function getHtmlFiles($folder) {
    $files = glob("../$folder/*.html");
    $result = [];
    foreach ($files as $file) {
        $result[] = basename($file);
    }
    return $result;
}

$ahu_files = getHtmlFiles("ahumenu");
$ki_files = getHtmlFiles("kimenu");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0b2b5b] text-white min-h-screen pb-32">

  <header class="bg-white text-[#0b2b5b] py-4 shadow-md text-center font-bold text-2xl">
    Dashboard Admin
  </header>

  <main class="flex flex-col items-center mt-10 space-y-8">
    <h2 class="text-yellow-400 text-xl font-semibold">
      Selamat datang, <?php echo htmlspecialchars($_SESSION['admin']); ?> 👋
    </h2>

    <div class="flex flex-col space-y-6 w-11/12 max-w-3xl">

      <!-- Halaman Utama -->
      <div class="bg-white p-5 rounded-xl text-[#0b2b5b] shadow-md">
        <h3 class="font-bold text-lg mb-4">Halaman Utama</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
          <a href="pengaduan.php" 
             class="bg-yellow-400 text-center font-bold py-2 rounded-md hover:bg-yellow-300 transition">
            📋 Lihat Data Pengaduan
          </a>
          <a href="edit_page.php?page=index.html" 
             class="bg-yellow-400 text-center font-bold py-2 rounded-md hover:bg-yellow-300 transition">
            🏠 Edit Beranda
          </a>
        </div>
      </div>

      <!-- Halaman AHU -->
      <div class="bg-white p-5 rounded-xl text-[#0b2b5b] shadow-md">
        <h3 class="font-bold text-lg mb-4">Halaman AHU</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
          <?php foreach ($ahu_files as $file): ?>
            <a href="edit_page.php?page=ahumenu/<?php echo $file; ?>" 
               class="bg-yellow-400 text-center font-bold py-2 rounded-md hover:bg-yellow-300 transition">
              ✏️ <?php echo ucfirst(pathinfo($file, PATHINFO_FILENAME)); ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Halaman KI -->
      <div class="bg-white p-5 rounded-xl text-[#0b2b5b] shadow-md">
        <h3 class="font-bold text-lg mb-4">Halaman KI</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
          <?php foreach ($ki_files as $file): ?>
            <a href="edit_page.php?page=kimenu/<?php echo $file; ?>" 
               class="bg-yellow-400 text-center font-bold py-2 rounded-md hover:bg-yellow-300 transition">
              ✏️ <?php echo ucfirst(pathinfo($file, PATHINFO_FILENAME)); ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <a href="logout.php" 
         class="bg-red-600 text-white font-bold text-center py-3 rounded-md hover:bg-red-500 transition mt-8">
        🚪 Logout
      </a>
    </div>
  </main>

</body>
</html>
