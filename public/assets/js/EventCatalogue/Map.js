let map;
const loadMarkers = () => {
  Markers.forEach(e => {
    L.marker([e.x, e.y], { alt: e.alt }).bindPopup(e.popupText).closePopup().addTo(map)
  });
}
const CreateMap = (x, y, zoom) => {
  if (map) {
    map.off();
    map.remove();
  }
  map = L.map("map", {
    center: [x, y],
    zoom: zoom,
  });
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);
  loadMarkers();
};

const success = (position) => {
  CreateMap(position.coords.latitude, position.coords.longitude, 6);
};
/* DEFAULT LOCATION IF USER DENIED GIVING HIS LOCATION */
CreateMap(36.492166, 10.015555, 6);

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(success);
}
