document.addEventListener("DOMContentLoaded", () => {
  // Read from the hidden inputs
  const lat = document.querySelector("#lat").value;
  const lng = document.querySelector("#lng").value;
  const zoom = document.querySelector("#zoom").value;
  const address = document.querySelector("#address").value;

  if (lat && lng) {
    // Add them into the map
    let map = L.map("map").setView([lat, lng], zoom);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    L.marker([lat, lng]).addTo(map).bindPopup(address).openPopup();
  }
});
