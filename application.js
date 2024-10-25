document.addEventListener("DOMContentLoaded", function() {
    const customBoxes = document.querySelectorAll('.custombox');
    let activeIndex = 0;

    function updateActiveBox() {
        customBoxes.forEach(box => {
            box.classList.remove('active');
            const icon = box.querySelector('box-icon');
            if (icon) {
                icon.setAttribute('color', '#cac9c9');
            }
        });

        const activeBox = customBoxes[activeIndex];
        activeBox.classList.add('active');

        const activeIcon = activeBox.querySelector('box-icon');
        if (activeIcon) {
            activeIcon.setAttribute('color', '#ffffff');
        }

        activeIndex = (activeIndex + 1) % customBoxes.length;
    }

    setInterval(updateActiveBox, 1000);

    updateActiveBox();
});