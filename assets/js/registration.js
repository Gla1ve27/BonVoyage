document.addEventListener('DOMContentLoaded', function() {
    const nextButtons = document.querySelectorAll('.nextButton');
    const prevButton = document.getElementById('prevButton');
    const createAccountBtn = document.getElementById('createAccountBtn');
    const nextButton = document.getElementById('nextButton1');
    let currentSectionIndex = 0;

    const sections = [
        document.querySelector('.personalInformation'),
        document.querySelector('.addressInformation'),
        document.querySelector('.createAccount')
    ];

    // Function to validate the current section
    function validateCurrentSection() {
        const currentSection = sections[currentSectionIndex];
        const fields = currentSection.querySelectorAll('input[required], select[required]');
        let isValid = true;

        fields.forEach(field => {
            if (field.value.trim() === '') {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
            }
        });

        // Check gender radio buttons if in the first section
        if (currentSectionIndex === 0) {
            const genderRadios = currentSection.querySelectorAll('input[name="gender"]');
            const genderValid = Array.from(genderRadios).some(radio => radio.checked);
            if (!genderValid) {
                genderRadios.forEach(radio => radio.classList.add('is-invalid'));
                isValid = false;
            } else {
                genderRadios.forEach(radio => radio.classList.remove('is-invalid'));
            }
        }

        return isValid;
    }

    // Function to validate the Create Account section
    function validateCreateAccount() {
        const password = document.getElementById('password');
        const reenterPassword = document.getElementById('reenterpassword');
        let isValid = true;

        // Validate password fields
        if (password.value.trim() === '') {
            password.classList.add('is-invalid');
            isValid = false;
        } else {
            password.classList.remove('is-invalid');
            password.classList.add('is-valid');
        }

        // Check if passwords match
        if (reenterPassword.value.trim() === '') {
            reenterPassword.classList.add('is-invalid');
            isValid = false;
        } else if (reenterPassword.value !== password.value) {
            reenterPassword.classList.add('is-invalid');
            isValid = false;
        } else {
            reenterPassword.classList.remove('is-invalid');
            reenterPassword.classList.add('is-valid');
        }

        return isValid;
    }

    // Event listeners for the next buttons
    nextButtons.forEach((button) => {
        button.addEventListener('click', function() {
            // Validate current section
            if (validateCurrentSection()) {
                sections[currentSectionIndex].classList.add('d-none');
                currentSectionIndex++;
                sections[currentSectionIndex].classList.remove('d-none');
                document.querySelector('.stepCounter').innerText = `${currentSectionIndex + 1}/3`; // Update step counter

                // Manage button visibility
                if (currentSectionIndex === 2) {
                    createAccountBtn.classList.remove('d-none');
                    nextButton.classList.add('d-none');
                }
                if (currentSectionIndex === 0) {
                    prevButton.classList.add('d-none'); // Hide prev button on Personal Information
                } else {
                    prevButton.classList.remove('d-none'); // Show prev button otherwise
                }
            }
        });
    });

    // Event listener for the previous button
    prevButton.addEventListener('click', function() {
        if (currentSectionIndex > 0) {
            sections[currentSectionIndex].classList.add('d-none');
            currentSectionIndex--;
            sections[currentSectionIndex].classList.remove('d-none');
            document.querySelector('.stepCounter').innerText = `${currentSectionIndex + 1}/3`; // Update step counter

            // Manage button visibility
            if (currentSectionIndex === 1) {
                createAccountBtn.classList.add('d-none');
                nextButton.classList.remove('d-none');
            } else if (currentSectionIndex === 0) {
                nextButton.classList.remove('d-none');
                prevButton.classList.add('d-none'); // Hide prev button on Personal Information
            }
        }
    });

    // Validate passwords on input
    const passwordField = document.getElementById('password');
    const reenterPasswordField = document.getElementById('reenterpassword');

    reenterPasswordField.addEventListener('input', function() {
        if (reenterPasswordField.value === passwordField.value) {
            reenterPasswordField.classList.remove('is-invalid');
            reenterPasswordField.classList.add('is-valid');
        } else {
            reenterPasswordField.classList.add('is-invalid');
        }
    });

createAccountBtn.addEventListener('click', function(event) {
    event.preventDefault();

    if (validateCreateAccount() && validateCurrentSection()) {
        Swal.fire({
            title: 'Success!',
            text: 'Account created successfully!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('registrationForm').submit();
            }
        });
    }
});

    sections[currentSectionIndex].querySelectorAll('input[required], select[required]').forEach(input => {
        input.addEventListener('blur', function() {
            if (input.value.trim() === '') {
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        });
    });
});
var daysElement = document.getElementById('days');
var monthDisplay = document.getElementById('month-display');
var yearInput = document.getElementById('year-input');
var CalendarPrevButton = document.getElementById('prevmonth'); //
var CalendarNextButton = document.getElementById('nextmonth');
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

CalendarPrevButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    event.preventDefault();
    renderCalendar(currentDate);
});

CalendarNextButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    event.preventDefault();
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
