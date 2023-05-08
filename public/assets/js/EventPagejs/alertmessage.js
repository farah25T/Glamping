const guestsInput = document.getElementById('guests');
const bookBtn = document.getElementById('btn');
const errorBox = document.getElementById('errorBox');
const errorMsg = document.getElementById('errorMsg');

bookBtn.addEventListener('click', (event) => {
    const guestsInput = document.getElementById('guests');
    const maxGuests = parseInt(guestsInput.dataset.maxGuests);
    const numGuests = parseInt(guestsInput.value);
    if (numGuests===0) {
        event.preventDefault();
        errorMsg.innerHTML = `Sorry.This event is full!`;
        errorBox.style.display = 'block';
    }
    if (numGuests < 1 || isNaN(numGuests)) {
        event.preventDefault();
        errorMsg.innerHTML = `You didn't specify a correct number of guests`;
        errorBox.style.display = 'block';
    }
    if (numGuests > maxGuests) {
        event.preventDefault();
        errorMsg.innerHTML = `The remaining places for this event are ${maxGuests}.`;
        errorBox.style.display = 'block';
    }
});
