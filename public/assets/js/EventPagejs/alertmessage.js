const guestsInput = document.getElementById('guests');
const bookBtn = document.getElementById('btn');
const errorBox = document.getElementById('errorBox');
const errorMsg = document.getElementById('errorMsg');

bookBtn.addEventListener('click', (event) => {
  const maxGuests = parseInt(guestsInput.dataset.maxGuests);
  const numGuests = parseInt(guestsInput.value);
  if (numGuests === 0 || numGuests < 0 || isNaN(numGuests)) {
    event.preventDefault();
} else if (maxGuests === 0) {
    event.preventDefault();
    errorMsg.innerHTML = 'Sorry, this event is full.';
    errorBox.style.display = 'block';
  
  } else if (numGuests > maxGuests) {
    event.preventDefault();
    errorMsg.innerHTML = `The maximum number of guests for this event is ${maxGuests}.`;
    errorBox.style.display = 'block';
  }
});



