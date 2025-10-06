const themeToggleBtn = document.getElementById('themeToggle');
const themeIcon = document.querySelector('.theme-icon');
const themeText = document.querySelector('.theme-text');
const modeStatus = document.querySelector('footer p');
const body = document.body;

const pegawaiForm = document.getElementById('pegawaiForm');
const pegawaiTableBody = document.getElementById('pegawaiTableBody');
const loadDataBtn = document.getElementById('loadDataBtn');

let isDarkMode = false;

themeToggleBtn.addEventListener('click', () => {
  isDarkMode = !isDarkMode;

  if (isDarkMode) {
    body.classList.add('dark-theme');
    themeIcon.innerHTML = '<i class="fas fa-sun"></i>';
    themeText.textContent = 'Light Mode';
  } else {
    body.classList.remove('dark-theme');
    themeIcon.innerHTML = '<i class="fas fa-moon"></i>';
    themeText.textContent = 'Dark Mode';
  }

  modeStatus.textContent = `Mode Saat Ini: ${isDarkMode ? 'Dark' : 'Light'} Mode`;
  localStorage.setItem('darkModeEnabled', isDarkMode);
});

document.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('darkModeEnabled');
  if (savedTheme === 'true') {
    isDarkMode = true;
    body.classList.add('dark-theme');
    themeIcon.innerHTML = '<i class="fas fa-sun"></i>';
    themeText.textContent = 'Light Mode';
    modeStatus.textContent = 'Mode Saat Ini: Dark Mode';
  }
});

pegawaiForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const id = document.getElementById('ID').value;
  const nama = document.getElementById('nama').value;
  const jabatan = document.getElementById('jabatan').value;

  const row = document.createElement('tr');
  row.innerHTML = `
    <td>${id}</td>
    <td>${nama}</td>
    <td>${jabatan}</td>
    <td><button class="deleteBtn">Hapus</button></td>
  `;
  pegawaiTableBody.appendChild(row);

  pegawaiForm.reset();

  row.querySelector('.deleteBtn').addEventListener('click', () => {
    row.remove();
  });
});

loadDataBtn.addEventListener('click', async () => {
  try {
    const response = await fetch('https://jsonplaceholder.typicode.com/users');
    const data = await response.json();

    pegawaiTableBody.innerHTML = '';

    data.slice(0, 5).forEach(user => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${user.id}</td>
        <td>${user.name}</td>
        <td>${user.company.bs}</td>
        <td><button class="deleteBtn">Hapus</button></td>
      `;
      pegawaiTableBody.appendChild(row);

      row.querySelector('.deleteBtn').addEventListener('click', () => {
        row.remove();
      });
    });
  } catch (err) {
    console.error('Gagal ambil data:', err);
  }
});
