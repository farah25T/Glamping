// // Get the current URL path
// const currentPath = window.location.pathname;

// // Split the path into an array of endpoints
// const endpoints = currentPath.split('/');

// // Get the last endpoint
// const lastEndpoint = endpoints[endpoints.length - 1];

// // Print the last endpoint to the console
// //console.log(lastEndpoint);


// fetch(`http://127.0.0.1:8000/api/${lastEndpoint}`)
//   .then(response => response.json())
//   .then(data => {
   
//     console.log(data);

//     const  lat  = data["latitude"];
//     const  long  = data["longitude"];

//     const name = data["name"];
//     const city = data["city"];
//     const country = data["country"];

//     var map = L.map('map').setView([lat, long], 13);

//     L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
//     }).addTo(map);
    
//     L.marker([lat, long]).addTo(map)
//         .bindPopup(name + ', ' + country + ', ' + city)
//         .openPopup();

//   })
//   .catch(error => {
//     console.error(error);
//   });
