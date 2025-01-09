import config from "../../config/config.js";

// Function updates every 10000ms to keep time updated,
// from getTime.php.
function updateTime() {
  fetch(`${config.base_url}/include/getTime.php`)
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("time").innerText = data;
    })
    .catch((error) => {
      console.error("Error fetching time:", error);
    });
}

setInterval(updateTime, 10000);
