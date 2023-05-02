const logJSONData = async () => {
  const apiKey = "afd601e5785c4a6c912155303232604";
  const lat = "42.781219";
  const lon = "3.023980";


  const weathericon = document.getElementById("weather-icon");
  const cityelement = document.getElementById("city");
  const countryelement = document.getElementById("country");
  const textelement = document.getElementById("text");
  const tempelement = document.getElementById("temp");
  const humidityelement = document.getElementById("humidity");
  const windelement = document.getElementById("wind");

  try {
    const response = await fetch(
      `http://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${lat},${lon}`
    );
    const jsonData = await response.json();

    const { name, region, country } = jsonData["location"];

    const { temp_c, wind_kph, humidity, cloud } = jsonData["current"];

    const { text, icon } = jsonData["current"]["condition"];

    // console.log(jsonData);
    // console.log(name, region, country);
    // console.log(temp_c, wind_kph, humidity, cloud);

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

logJSONData()
  .then((res) => console.log(res))
  .catch((error) => {});
