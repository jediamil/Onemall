// sidebar toggle
document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.getElementById('menuBtn');
    const menu = document.getElementById('menu');
    
    // ADD THIS NULL CHECK
    if (!menuBtn || !menu) {
        return; // Exit if elements don't exist
    }
    
    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
});