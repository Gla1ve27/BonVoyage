var daysElement = document.getElementById('days');
var monthDisplay = document.getElementById('month-display'); // Display current month
var yearInput = document.getElementById('year-input'); // Year input
var prevButton = document.getElementById('prevmonth');
var nextButton = document.getElementById('nextmonth');
var birthday = document.getElementById('birthday');
var ageInput = document.getElementById('age'); 
let currentDate = new Date();

// Render the calendar
function renderCalendar(date) {
    var startDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
    var lastDate = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    daysElement.innerHTML = '';
    
    // Update the month display and year input
    monthDisplay.textContent = date.toLocaleString('default', { month: 'long' });
    yearInput.value = date.getFullYear(); // Set the year input

    for (let i = 0; i < startDay; i++) {
        daysElement.innerHTML += '<div class="calendar-day"></div>';
    }
    
    for (let day = 1; day <= lastDate; day++) {
        daysElement.innerHTML += `<div class="calendar-day" data-date="${day}">${day}</div>`;
    }
}

// Event listeners for month and year changes
prevButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
});

nextButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
});

// Year input change event
yearInput.addEventListener('change', (event) => {
    const newYear = parseInt(event.target.value, 10);
    if (newYear >= 1900 && newYear <= 2100) { // Validate year range
        currentDate.setFullYear(newYear);
        renderCalendar(currentDate);
    } else {
        alert('Please enter a valid year (1900-2100).');
        yearInput.value = currentDate.getFullYear(); // Reset to current year if invalid
    }
});

// Date selection event
daysElement.addEventListener('click', (event) => {
    if (event.target.classList.contains('calendar-day') && event.target.dataset.date) {
        var selectedDay = event.target.dataset.date;
        var selectedDate = new Date(Date.UTC(currentDate.getFullYear(), currentDate.getMonth(), selectedDay));
        var dateformat = selectedDate.toISOString().split('T')[0];

        // Update the birthday input
        birthday.value = dateformat;

        // Calculate and update age
        const age = calculateAge(dateformat);
        ageInput.value = age; 
    }
});

// Initial setup
renderCalendar(currentDate);

// Function to calculate age
function calculateAge(birthDate) {
    const today = new Date();
    const birthDateObj = new Date(birthDate);
    let age = today.getFullYear() - birthDateObj.getFullYear();
    const monthDifference = today.getMonth() - birthDateObj.getMonth();

    // Adjust age if birth date hasn't occurred yet this year
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDateObj.getDate())) {
        age--;
    }

    return age;
}