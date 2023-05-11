const logJSONData = async (lat, lon) => {
  const apiKey = "afd601e5785c4a6c912155303232604";

  const weathericon = document.getElementById("weather-icon");
  const cityelement = document.getElementById("city");
  const countryelement = document.getElementById("country");
  const textelement = document.getElementById("text");
  const tempelement = document.getElementById("temp");
  const humidityelement = document.getElementById("humidity");
  const windelement = document.getElementById("wind");

  try {
    const response = await fetch(
      `${prot}://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${lat},${lon}`
    );
    const jsonData = await response.json();

    const { name, region, country } = jsonData["location"];

    const { temp_c, wind_kph, humidity, cloud } = jsonData["current"];

    const { text, icon } = jsonData["current"]["condition"];

    weathericon.src = icon;
    cityelement.innerText += " " + name;
    countryelement.innerText = country;
    textelement.innerText = text;
    tempelement.innerText = temp_c + "°C";
    humidityelement.innerText += " " + humidity + "%";
    windelement.innerText += " " + wind_kph + " km/h";

    return [name, region, country, text, temp_c, wind_kph, humidity, cloud];
  } catch (error) {
    console.log("error" + error);
  }
};

// Get the current URL path
const currentPath = window.location.pathname;

// Split the path into an array of endpoints
const endpoints = currentPath.split("/");

// Get the last endpoint
const lastEndpoint = endpoints[endpoints.length - 1];
const prot = window.location.origin.split('/')[0].slice(0,-1);

fetch(`${prot}://127.0.0.1:8000/api/${lastEndpoint}`)
  .then((response) => response.json())
  .then((data) => {
    const lat = data["latitude"];
    const lon = data["longitude"];

    const name = data["name"];
    const city = data["city"];
    const country = data["country"];

    var map = L.map("map").setView([lat, lon], 13);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    L.marker([lat, lon])
      .addTo(map)
      .bindPopup(name + ", " + country + ", " + city)
      .openPopup();
    logJSONData(lat, lon);
  })
  .catch((error) => {
    console.log(error);
  });
