// Get references to the sections and buttons
const form = document.getElementById('registrationForm');
const personalInfoSection = document.querySelector('.personalInformation');
const addressInfoSection = document.querySelector('.addressInformation');
const createAccountSection = document.querySelector('.createAccount');
const nextButton1 = document.getElementById('nextButton1'); // Personal info -> Address info
const nextButton2 = document.getElementById('nextButton2'); // Address info -> Create account
const prevButton = document.getElementById('prevButton');
const createAccountBtn = document.getElementById('createAccountBtn');

// Function to show and hide sections
function showSection(sectionToShow, sectionToHide) {
    sectionToShow.classList.remove('d-none');
    sectionToHide.classList.add('d-none');
}

// Function to handle validation
function validateFormSection(section) {
    let isValid = true;

    // Get all inputs in the section
    const inputs = section.querySelectorAll('input');
    inputs.forEach(input => {
        // Check validity of each input field
        if (!input.checkValidity()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });

    return isValid;
}

// Show next section and validate the personal information section
nextButton1.addEventListener('click', function() {
    // Validate only personal information section
    if (validateFormSection(personalInfoSection)) {
        showSection(addressInfoSection, personalInfoSection);
    }
});

// Show next section and validate the address information section
nextButton2.addEventListener('click', function() {
    // Validate only address information section
    if (validateFormSection(addressInfoSection)) {
        showSection(createAccountSection, addressInfoSection);
    }
});

// Show previous section (skip validation)
prevButton.addEventListener('click', function() {
    showSection(personalInfoSection, addressInfoSection);
});

// Validate both the address and create account sections on final submit
createAccountBtn.addEventListener('click', function() {
    // Validate address info and create account section
    if (validateFormSection(addressInfoSection) && validateFormSection(createAccountSection)) {
        const password = document.getElementById('password');
        const reenterpassword = document.getElementById('reenterpassword');
        
        // Check password match
        if (password.value !== reenterpassword.value) {
            reenterpassword.classList.add('is-invalid');
            alert("Passwords do not match!");
        } else {
            form.submit(); // If all sections are valid, submit the form
        }
    }
});



var daysElement = document.getElementById('days');
var monthDisplay = document.getElementById('month-display');
var yearInput = document.getElementById('year-input');
var prevButtons = document.getElementById('prevmonth'); //
var nextButton = document.getElementById('nextmonth');
var birthday = document.getElementById('birthday');
var ageInput = document.getElementById('age');
var currentDate = new Date();
var selectedDayElement = null;

function renderCalendar(date) {
    var startDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
    var lastDate = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    daysElement.innerHTML = '';
    monthDisplay.textContent = date.toLocaleString('default', { month: 'long' });
    yearInput.value = date.getFullYear();

    for (let i = 0; i < startDay; i++) {
        daysElement.innerHTML += '<div class="calendar-day"></div>';
    }
    for (let day = 1; day <= lastDate; day++) {
        daysElement.innerHTML += `<div class="calendar-day" data-date="${day}">${day}</div>`;
    }
}

prevButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
});

nextButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
});

yearInput.addEventListener('change', (event) => {
    const newYear = parseInt(event.target.value, 10);
    if (newYear >= 1900 && newYear <= 2006) {
        currentDate.setFullYear(newYear);
        renderCalendar(currentDate);
    } else {
        alert('Please enter a valid year (1900-2006).');
        yearInput.value = currentDate.getFullYear();
    }
});

daysElement.addEventListener('click', (event) => {
    if (event.target.classList.contains('calendar-day') && event.target.dataset.date) {
        var selectedDay = event.target.dataset.date;

        if (selectedDayElement === event.target) {
            selectedDayElement.classList.remove('selected-day');
            selectedDayElement = null;
            birthday.value = '';
            ageInput.value = '';
        } else {
            if (selectedDayElement) {
                selectedDayElement.classList.remove('selected-day');
            }
            selectedDayElement = event.target;
            selectedDayElement.classList.add('selected-day');

            var selectedDate = new Date(Date.UTC(currentDate.getFullYear(), currentDate.getMonth(), selectedDay));
            var dateformat = selectedDate.toISOString().split('T')[0];
            birthday.value = dateformat;
            var age = calculateAge(dateformat);
            if (age < 18) {
                alert("You must be 18 years old and above.");
            } else {
                ageInput.value = age + ' Y.O.';
            }
        }
    }
});

renderCalendar(currentDate);

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
