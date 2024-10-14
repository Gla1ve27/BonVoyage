document.getElementById('nextButton').addEventListener('click', function() {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'flex';
});

var daysElement = document.getElementById('days');
var monthDisplay = document.getElementById('month-display');
var yearInput = document.getElementById('year-input');
var prevButton = document.getElementById('prevmonth');
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
    if (newYear >= 1900 && newYear <= 2100) {
        currentDate.setFullYear(newYear);
        renderCalendar(currentDate);
    } else {
        alert('Please enter a valid year (1900-2100).');
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
            ageInput.value = age + ' Y.O.'; 
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


document.addEventListener('DOMContentLoaded', function () {
    const uploadContainer = document.getElementById('uploadContainer');
    const fileInput = document.getElementById('uploadId');

    uploadContainer.addEventListener('dragover', function (e) {
        e.preventDefault(); 
        e.stopPropagation(); 
        uploadContainer.classList.add('drag-over'); 
    });

    uploadContainer.addEventListener('dragleave', function () {
        uploadContainer.classList.remove('drag-over'); 
    });

    uploadContainer.addEventListener('drop', function (e) {
        e.preventDefault(); 
        e.stopPropagation();
        uploadContainer.classList.remove('drag-over'); 

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            console.log(files[0].name);
            alert(`Uploaded: ${files[0].name}`);
        }
    });

    fileInput.addEventListener('change', function () {
        const fileName = fileInput.files[0].name; 
        console.log(fileName); 
        alert(`Selected: ${fileName}`); 
    });
});

document.getElementById('nextButton1').addEventListener('click', function() {
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step3').style.display = 'flex';
});

document.getElementById('terms').addEventListener('click', function() {
    document.getElementById('step3').style.display = 'none';
    document.getElementById('termsandcondition').style.display = 'flex';
});