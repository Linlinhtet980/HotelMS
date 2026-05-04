document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const body = document.body;

    if (!sidebarToggle) return;

    // Load state from localStorage if exists
    if (localStorage.getItem('sidebar-collapsed') === 'true') {
        body.classList.add('sidebar-collapsed');
    }

    sidebarToggle.addEventListener('click', function() {
        body.classList.toggle('sidebar-collapsed');
        
        // Save state so it remembers between page loads
        localStorage.setItem('sidebar-collapsed', body.classList.contains('sidebar-collapsed'));
    });
});
