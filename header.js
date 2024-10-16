// scripts.js
document.addEventListener("DOMContentLoaded", function() {
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            this.querySelector('.dropdown-content').classList.toggle('show');
        });
    });

    // Close dropdowns if clicked outside
    window.addEventListener('click', function() {
        dropdowns.forEach(dropdown => {
            dropdown.querySelector('.dropdown-content').classList.remove('show');
        });
    });
});
