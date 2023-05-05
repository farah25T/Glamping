var map = L.map("map").setView([36.8002068, 10.1857757], 7);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

L.marker([36.8002068, 10.1857757]).addTo(map) .openPopup();
L.marker([36.206, 10.1857757]) .addTo(map) .openPopup();
L.marker([36.206, 9.1857757]) .addTo(map) .openPopup();
L.marker([36.5, 10.5857757]) .addTo(map) .openPopup();

