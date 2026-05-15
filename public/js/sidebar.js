const toggle  = document.getElementById('sidebar-toggle');
const drawer  = document.getElementById('sidebar-drawer');
const overlay = document.getElementById('sidebar-overlay');
const close   = document.getElementById('sidebar-close');

function openSidebar() {
    drawer.classList.add('sidebar-drawer--open');
    overlay.classList.add('sidebar-overlay--visible');
}

function closeSidebar() {
    drawer.classList.remove('sidebar-drawer--open');
    overlay.classList.remove('sidebar-overlay--visible');
}

toggle?.addEventListener('click', openSidebar);
close?.addEventListener('click', closeSidebar);
overlay?.addEventListener('click', closeSidebar);