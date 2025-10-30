<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['page'])) {
    die("Halaman tidak ditemukan!");
}

$page = $_GET['page'];

// Bersihkan path agar aman
$page = str_replace('..', '', $page);
$page = "../" . ltrim($page, '/');

// Pastikan file ada
if (!file_exists($page)) {
    die("File tidak ditemukan: " . htmlspecialchars($page));
}

// Jika disimpan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];

    if (file_put_contents($page, $content)) {
        $success = "Perubahan berhasil disimpan!";
    } else {
        $error = "Gagal menyimpan perubahan.";
    }
}

// Ambil isi file
$content = htmlspecialchars(file_get_contents($page));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Halaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tiny.cloud/1/3ab0n3fg51zq58jyahvyrzan9qbnrfo5erc0yuos0zipw9aw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
    tinymce.init({
        selector: 'textarea',
        height: 650,
        menubar: true,
        plugins: 'code link image lists table fullpage',
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',

        /* Aktifkan mode fullpage agar bisa edit HTML penuh */
        fullpage_default_encoding: 'UTF-8',
        fullpage_default_doctype: '<!DOCTYPE html>',

        /* Injeksi Tailwind langsung ke dalam iframe editor */
        setup: (editor) => {
            editor.on('init', () => {
                const iframe = editor.iframeElement;
                const doc = iframe.contentDocument || iframe.contentWindow.document;

                // Tambahkan script Tailwind
                const tw = doc.createElement('script');
                tw.src = "https://cdn.tailwindcss.com";
                doc.head.appendChild(tw);

                // Tambahkan style dasar agar mirip tampilan aslinya
                const style = doc.createElement('style');
                style.textContent = `
                    html, body {
                        background-color: white;
                        color: #0b2b5b;
                        font-family: 'Segoe UI', sans-serif;
                        padding: 20px;
                        overflow-x: hidden;
                    }
                    h1, h2, h3 {
                        color: #0b2b5b;
                        font-weight: bold;
                    }
                    a {
                        color: #eab308;
                        text-decoration: underline;
                    }
                    img {
                        max-width: 100%;
                        height: auto;
                    }
                    button {
                        border-radius: 0.5rem;
                        padding: 0.5rem 1rem;
                    }
                `;
                doc.head.appendChild(style);
            });
        }
    });
    </script>
</head>

<body class="bg-[#0b2b5b] text-white min-h-screen pb-24">
    <header class="bg-white text-[#0b2b5b] py-4 shadow-md text-center font-bold text-2xl">
        ✏️ Edit Halaman
    </header>

    <main class="flex flex-col items-center mt-8 px-4">
        <div class="bg-white p-6 rounded-2xl shadow-lg w-full max-w-5xl text-[#0b2b5b]">
            <h2 class="text-xl font-semibold mb-4">
                Mengedit: <?php echo htmlspecialchars(basename($page)); ?>
            </h2>

            <?php if (isset($success)): ?>
                <p class="bg-green-100 text-green-700 p-2 rounded mb-4"><?php echo $success; ?></p>
            <?php elseif (isset($error)): ?>
                <p class="bg-red-100 text-red-700 p-2 rounded mb-4"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST">
                <textarea name="content"><?php echo $content; ?></textarea>

                <div class="flex justify-between mt-6">
                    <a href="dashboard.php" class="bg-gray-300 text-[#0b2b5b] px-4 py-2 rounded-md font-bold hover:bg-gray-200">⬅️ Kembali</a>
                    
                    <div class="flex gap-3">
                        <button type="button" onclick="window.open('<?php echo $page; ?>', '_blank')" 
                            class="bg-blue-500 text-white px-6 py-2 rounded-md font-bold hover:bg-blue-400 transition">
                            👁️ Preview
                        </button>

                        <button type="submit" 
                            class="bg-yellow-400 text-[#0b2b5b] px-6 py-2 rounded-md font-bold hover:bg-yellow-300 transition">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
