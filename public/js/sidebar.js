const sidebar = document.getElementById('sidebar');
const collapseBtn = document.getElementById('collapseBtn');
const html = document.documentElement;

collapseBtn.addEventListener('click', () => {
    sidebar.classList.toggle('sidebar-collapsed');
    if (sidebar.classList.contains('sidebar-collapsed')) {
        sidebar.style.width = '4rem';
    } else {
        sidebar.style.width = '16rem';
    }
});