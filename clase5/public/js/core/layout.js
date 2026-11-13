// js/core/layout.js
function toggleSidebar() {
    var sidebar = document.getElementById('mainSidebar');
    var overlay = document.getElementById('sidebarOverlay');
    if (sidebar && overlay) {
        if (sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
            overlay.style.display = 'none';
        } else {
            sidebar.classList.add('open');
            overlay.style.display = 'block';
        }
    }
}
function toggleUserMenu() {
    var userMenu = document.getElementById('userMenu');
    if (userMenu) {
        if (userMenu.style.display === 'none' || userMenu.style.display === '') {
            userMenu.style.display = 'block';
        } else {
            userMenu.style.display = 'none';
        }
    }
}
function toggleTheme() {
    var isDark = document.body.classList.contains('dark-mode');
    if (isDark) {
        document.body.classList.remove('dark-mode');
        localStorage.setItem('theme', 'light');
    } else {
        document.body.classList.add('dark-mode');
        localStorage.setItem('theme', 'dark');
    }
}