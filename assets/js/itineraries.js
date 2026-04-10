document.addEventListener('DOMContentLoaded', function () {
    const budgetRange = document.getElementById('budgetRange');
    const budgetValue = document.getElementById('budgetValue');
    const budgetInput = document.querySelector('.budget-input-field');

    function updateSlider() {
        if (!budgetRange) return;

        const value = budgetRange.value;
        const min = budgetRange.min;
        const max = budgetRange.max;
        const percentage = (value - min) / (max - min) * 100;

        // Update CSS variable for the track background
        budgetRange.style.setProperty('--range-progress', `${percentage}%`);

        // Update text displays
        if (budgetValue) budgetValue.textContent = parseInt(value).toLocaleString();
        if (budgetInput) budgetInput.value = `P ${parseInt(value).toLocaleString()}`;
    }

    if (budgetRange) {
        budgetRange.addEventListener('input', updateSlider);
        // Initial set
        updateSlider();
    }

    // Handle Radio Item Clicks (Visual only for now)
    const radioItems = document.querySelectorAll('.radio-item');
    radioItems.forEach(item => {
        item.addEventListener('click', function () {
            // Only toggle within the same selection-group
            const group = this.closest('.selection-group');
            group.querySelectorAll('.radio-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
