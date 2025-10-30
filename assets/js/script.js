function navigateTo(page) {
  window.location.href = page;
}

// Pencarian di halaman utama
const searchInput = document.getElementById('searchInput');
const serviceButtons = document.getElementById('serviceButtons').children;

searchInput.addEventListener('input', () => {
  const query = searchInput.value.toLowerCase();
  for (let btn of serviceButtons) {
    const text = btn.innerText.toLowerCase();
    btn.style.display = text.includes(query) ? '' : 'none';
  }
});
