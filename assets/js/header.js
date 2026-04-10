// scripts.js
document.addEventListener("DOMContentLoaded", function () {
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function (e) {
            const dropdownContent = this.querySelector('.dropdown-content');
            if (dropdownContent) {
                e.stopPropagation();
                dropdownContent.classList.toggle('show');
            }
        });
    });

    // Close dropdowns if clicked outside
    window.addEventListener('click', function () {
        dropdowns.forEach(dropdown => {
            const dropdownContent = dropdown.querySelector('.dropdown-content');
            if (dropdownContent) {
                dropdownContent.classList.remove('show');
            }
        });
    });
});
