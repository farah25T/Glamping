window.addEventListener('DOMContentLoaded', (event) => {
    setTimeout(() => {
        document.querySelector('.choice').classList.add('show-choice');
    }, 2000);
});

const booked = document.querySelector('#booked');
const booked_bouton = document.querySelector('#booked_bouton');
const saved = document.querySelector('#saved');
const saved_bouton = document.querySelector('#saved_bouton');
const liked = document.querySelector('#liked');
const liked_bouton = document.querySelector('#liked_bouton');

saved_bouton.addEventListener('click', (event) => {
    if (!liked.hasAttribute('hidden'))
        liked.toggleAttribute('hidden');
    if (!booked.hasAttribute('hidden'))
        booked.toggleAttribute('hidden');
    saved.toggleAttribute('hidden');
});

liked_bouton.addEventListener('click', (event) => {
    if (!saved.hasAttribute('hidden'))
        saved.toggleAttribute('hidden');
    if (!booked.hasAttribute('hidden'))
        booked.toggleAttribute('hidden');
    liked.toggleAttribute('hidden');
});

booked_bouton.addEventListener('click', (event) => {
    if (!liked.hasAttribute('hidden'))
        liked.toggleAttribute('hidden');
    if (!saved.hasAttribute('hidden'))
        saved.toggleAttribute('hidden');
    booked.toggleAttribute('hidden');
});

var type = new Typed(".textlin", {
    strings: ["Check  !", "Book  !", "Like  !"],
    typeSpeed: 100,
    backSpeed: 100,
    backDelay: 1000,
    loop: true,
});
