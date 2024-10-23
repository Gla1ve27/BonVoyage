function toggleOption(optionId) {
    const paymentOptions = document.querySelectorAll('.payment-option');
  
    paymentOptions.forEach(option => {
      const radioButton = option.querySelector('.radio');
  
      if (option.id === optionId) {
        option.classList.add('active');
        option.classList.remove('collapsed');
        radioButton.checked = true;
      } else {
        option.classList.remove('active');
        option.classList.add('collapsed');
        radioButton.checked = false;
      }
    });
  }
  