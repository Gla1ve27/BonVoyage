// CAT BUTTONS
// CAT BUTTONS
// CAT BUTTONS
// CAT BUTTONS
document.getElementById('scroll-left').addEventListener('click', function() {
    document.querySelector('.icon-menu-wrapper').scrollBy({
        left: -200, // Scroll left by 200px
        behavior: 'smooth' // Smooth scroll
    });
});

document.getElementById('scroll-right').addEventListener('click', function() {
    document.querySelector('.icon-menu-wrapper').scrollBy({
        left: 200, // Scroll right by 200px
        behavior: 'smooth' // Smooth scroll
    });
});

// Drag scroll functionality
const iconMenuWrapper = document.querySelector('.icon-menu-wrapper');
let isDown = false;
let startX;
let scrollLeft;

// Mouse down event
iconMenuWrapper.addEventListener('mousedown', (e) => {
    isDown = true;
    iconMenuWrapper.classList.add('grabbing');
    startX = e.pageX - iconMenuWrapper.offsetLeft;
    scrollLeft = iconMenuWrapper.scrollLeft;
});

// Mouse leave event (stops dragging)
iconMenuWrapper.addEventListener('mouseleave', () => {
    isDown = false;
    iconMenuWrapper.classList.remove('grabbing');
});

// Mouse up event (stops dragging)
iconMenuWrapper.addEventListener('mouseup', () => {
    isDown = false;
    iconMenuWrapper.classList.remove('grabbing');
});

// Mouse move event (scrolls while dragging)
iconMenuWrapper.addEventListener('mousemove', (e) => {
    if (!isDown) return; // Stop function if not holding mouse down
    e.preventDefault();
    const x = e.pageX - iconMenuWrapper.offsetLeft;
    const walk = (x - startX) * 2; // Multiply by 2 for faster scrolling
    iconMenuWrapper.scrollLeft = scrollLeft - walk;
});



// END OF CAT BUTTONS
// END OF CAT BUTTONS
// END OF CAT BUTTONS
// END OF CAT BUTTONS

// DASHBOARD BTNS
// DASHBOARD BTNS
// DASHBOARD BTNS

// Get all the trip rows (each containing the row buttons and cards-row)
const tripRows = document.querySelectorAll('.trip-row-wrapper');

// Define the amount to scroll (in pixels)
const scrollAmount = 300; // You can adjust this value

// Loop through each trip row and attach the event listeners
tripRows.forEach((tripRow) => {
    const rowBtnLeft = tripRow.querySelector('#row-btn-left'); // Left button for this row
    const rowBtnRight = tripRow.querySelector('#row-btn-right'); // Right button for this row
    const cardsRow = tripRow.querySelector('.cards-row'); // The row of cards for this trip row

    // Attach event listener for the left button
    rowBtnLeft.addEventListener('click', () => {
        cardsRow.scrollBy({
            left: -scrollAmount, // Scroll left
            behavior: 'smooth'   // Smooth scrolling
        });
    });

    // Attach event listener for the right button
    rowBtnRight.addEventListener('click', () => {
        cardsRow.scrollBy({
            left: scrollAmount,  // Scroll right
            behavior: 'smooth'   // Smooth scrolling
        });
    });

    // Get the left and right card buttons within this trip row
    const cardBtnsLeft = tripRow.querySelectorAll('#card-btn-left');
    const cardBtnsRight = tripRow.querySelectorAll('#card-btn-right');

    // Add event listeners to each left and right card button to navigate between carousel items
    cardBtnsLeft.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const carousel = e.target.closest('.card').querySelector('.carousel');
            const carouselInstance = bootstrap.Carousel.getInstance(carousel);
            carouselInstance.prev(); // Move to previous carousel item
        });
    });

    cardBtnsRight.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const carousel = e.target.closest('.card').querySelector('.carousel');
            const carouselInstance = bootstrap.Carousel.getInstance(carousel);
            carouselInstance.next(); // Move to next carousel item
        });
    });
});

// Initialize the carousels when the page loads
document.querySelectorAll('.carousel').forEach((carouselElement) => {
    new bootstrap.Carousel(carouselElement);
});
