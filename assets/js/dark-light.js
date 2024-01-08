
document.addEventListener('DOMContentLoaded', function () {
const darkModeCheckbox = document.getElementById('dark');
const lightModeCheckbox = document.getElementById('light');
const themeStyle = document.getElementById('theme-style');

// Verifica o valor armazenado no localStorage
const savedTheme = localStorage.getItem('theme');

// Aplica o tema salvo ou o tema padrão
if (savedTheme) {
themeStyle.href = `${savedTheme}.css`;
if (savedTheme === 'dark') {
  darkModeCheckbox.checked = true;
} else {
  lightModeCheckbox.checked = true;
}
}

// Adiciona listeners para os checkboxes
darkModeCheckbox.addEventListener('change', function () {
if (darkModeCheckbox.checked) {
  themeStyle.href = 'dark.css';
  localStorage.setItem('theme', 'dark');
  lightModeCheckbox.checked = false;
} else {
  themeStyle.href = '';
  localStorage.removeItem('theme');
}
});

lightModeCheckbox.addEventListener('change', function () {
if (lightModeCheckbox.checked) {
  themeStyle.href = 'light.css';
  localStorage.setItem('theme', 'light');
  darkModeCheckbox.checked = false;
} else {
  themeStyle.href = '';
  localStorage.removeItem('theme');
}
});
});
 