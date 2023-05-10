// Load the Google Transliterate API
$(function() {
    $('input[name="daterange"]').daterangepicker(
        {
            ssingleDatePicker: 'true',
            showShortcuts: 'false',
            showTopbar: 'false'
        }
    );
});
//character validation
$('input[name="location"]').on('keydown paste', function (e) {
    if (!/^[A-Za-z]+$/.test(e.key)) {
    e.preventDefault();
    }
    });

//alert message
const guestsInput = document.getElementById('guests');
const bookBtn = document.getElementById('btn');

bookBtn.addEventListener('click', (event) => {
  const maxGuests = parseInt(guestsInput.dataset.maxGuests);
  const numGuests = parseInt(guestsInput.value);
  if (numGuests === 0 || numGuests < 0 || isNaN(numGuests) || numGuests > maxGuests) {
    event.preventDefault();
  }
});