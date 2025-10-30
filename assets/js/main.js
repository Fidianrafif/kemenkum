// === Jam Digital Real-Time ===
function updateClock() {
  const clock = document.getElementById("clock");
  const now = new Date();

  // Format waktu: HH:MM:SS
  const hours = now.getHours().toString().padStart(2, "0");
  const minutes = now.getMinutes().toString().padStart(2, "0");
  const seconds = now.getSeconds().toString().padStart(2, "0");

  // Format tanggal: Senin, 6 Oktober 2025
  const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
  const months = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
  ];

  const dayName = days[now.getDay()];
  const date = now.getDate();
  const monthName = months[now.getMonth()];
  const year = now.getFullYear();

  clock.innerHTML = `${dayName}, ${date} ${monthName} ${year} — ${hours}:${minutes}:${seconds}`;
}

// Jalankan setiap detik
setInterval(updateClock, 1000);
updateClock();

// === Efek klik tombol menu ===
const buttons = document.querySelectorAll(".menu-btn");
buttons.forEach(btn => {
  btn.addEventListener("touchstart", () => {
    btn.style.transform = "scale(0.97)";
  });
  btn.addEventListener("touchend", () => {
    btn.style.transform = "scale(1)";
  });
});