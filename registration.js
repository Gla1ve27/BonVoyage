document.getElementById('nextButton').addEventListener('click', function() {
    document.getElementById('registrationForm').classList.add('hidden');
    document.getElementById('nextForm').classList.remove('hidden');
});

// function calculateAge(birthDate) {
//     const today = new Date();
//     const birthDateObj = new Date(birthDate);
//     let age = today.getFullYear() - birthDateObj.getFullYear();
//     const monthDifference = today.getMonth() - birthDateObj.getMonth();

//     // Adjust age if birth date hasn't occurred yet this year
//     if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDateObj.getDate())) {
//         age--;
//     }

//     return age;
// }

// document.getElementById('birthday').addEventListener('change', function() {
//     const birthdayValue = this.value;
//     if (birthdayValue) {
//         const age = calculateAge(birthdayValue);
//         document.getElementById('age').value = age;
//     } else {
//         document.getElementById('age').value = '';
//     }
// });
