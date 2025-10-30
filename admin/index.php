<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "layanan_kanwil";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika form disubmit
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // cocok dengan yang di DB

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Layanan Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0b2b5b] text-white flex items-center justify-center h-screen">

    <div class="bg-white text-[#0b2b5b] p-8 rounded-2xl shadow-lg w-96">
        <h2 class="text-center font-bold text-2xl mb-6">Login Admin</h2>

        <form method="POST" class="space-y-4">
            <div>
                <label class="font-semibold">Username</label>
                <input type="text" name="username" required
                       class="w-full mt-1 p-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">Password</label>
                <input type="password" name="password" required
                       class="w-full mt-1 p-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <button type="submit" name="login"
                    class="w-full bg-[#0b2b5b] text-white font-semibold py-2 rounded-md hover:bg-[#133e7c] transition">
                Masuk
            </button>
        </form>
    </div>

</body>
</html>
