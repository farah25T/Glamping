var map = L.map('map').setView([42.781220, 3.023980], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([42.781220, 3.023980]).addTo(map)
    .bindPopup('Camping Pré Fixe <br> France, Occitanie')
    .openPopup();